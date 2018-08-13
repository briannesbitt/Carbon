<?php

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en');
ini_set('html_errors', 0);
if (function_exists('xdebug_disable')) {
    ini_set('xdebug.overload_var_dump', 0);
    xdebug_disable();
}

require 'vendor/autoload.php';
require 'tools/methods.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

function isHistoryUpToDate()
{
    if (!file_exists('history.json')) {
        return false;
    }

    $versions = json_decode(file_get_contents('https://packagist.org/p/nesbot/carbon.json'), true)['packages']['nesbot/carbon'];
    $maxVersion = '1.0.0';
    foreach ($versions as $version => $data) {
        if (version_compare($version, $maxVersion) > 0) {
            $maxVersion = $version;
        }
    }
    $versionData = $versions[$maxVersion];

    return Carbon::parse($versionData['time'])->timestamp < filemtime('history.json');
}

function historyLine($event, $version, $ref)
{
    $ref = empty($ref) ? '<em>no arguments</em>' : "<code>$ref</code>";

    return "<tr><td>$event</td><td>$version</td><td>$ref</td></tr>";
}

if (!isHistoryUpToDate()) {
    echo "Your history.json is not up to date. You should first run:\nphp api-history.php\n";
    exit(1);
}

$globalHistory = @json_decode(file_get_contents('history.json'), JSON_OBJECT_AS_ARRAY);

Carbon::macro('getAvailableMacroLocales', function () {
    $locales = [];

    foreach (Carbon::getAvailableLocales() as $locale) {
        $locales[explode('_', $locale)[0]] = 1;
    }

    return array_keys($locales);
});

Carbon::macro('getAllMethods', function () use ($globalHistory) {
    foreach (@methods(false) as list($carbonObject, $className, $method, $parameters, $description, $dateTimeObject)) {

        if (method_exists($dateTimeObject, $method)) {
            $dateClass = get_class($dateTimeObject);
            $rcCarbon = new ReflectionMethod($className, $method);
            $rcDate = new ReflectionMethod($dateClass, $method);
            if ($rcCarbon == $rcDate) {
                $dateClass = trim($dateClass, '/\\');

                yield [
                    'name'      => $method,
                    'prototype' => '<em>Native PHP method</em>',
                    'className' => preg_replace('/^Carbon\\\\/', '', $className),
                    'description' => 'See <a href="http://php.net/manual/en/'.strtolower($dateClass.'.'.$method).'.php">PHP documentation for '.$dateClass.'::'.$method.'</a>',
                    'history' => '',
                ];

                continue;
            }
        }
        $history = '';
        $key = "$className::$method";
        $parameters = implode(', ', $parameters ?: []);
        if (is_array($globalHistory) && isset($globalHistory[$key])) {
            $ref = implode(', ', reset($globalHistory[$key]));
            $parameters = $ref;
            $version = key($globalHistory[$key]);

            while (($prototype = next($globalHistory[$key])) !== false) {
                $prototype = implode(', ', $prototype);
                if ($prototype !== $ref) {
                    $history .= historyLine('Prototype changed', $version, $ref);
                    $ref = $prototype;
                }
                $version = key($globalHistory[$key]);
            }

            $history .= historyLine('Method added', $version, $ref);
        }

        yield [
            'name' => $method,
            'classes' => trim(implode(' ', [
                strpos($description, '@deprecated') !== false ? 'deprecated' : '',
            ])),
            'prototype' => empty($parameters) ? '<em>no arguments</em>' : "<code>$parameters</code>",
            'className' => preg_replace('/^Carbon\\\\/', '', $className),
            'description' => preg_replace('/\n *\n/', '<br><br>', preg_replace('/@deprecated\s(([^\n]+)(\n [^\n])*)/', '<div class="alert alert-warning">$1</div>', $description)),
            'history' => "<table class='info-table method-history'>$history</table>",
        ];
    }
});

$template = file_get_contents('template.src.html');

function genHtml($page, $out, $jumbotron = '')
{
    global $template;
    $menu = '';
    $page = preg_replace_callback('/<nav>([\s\S]*?)<\/nav>/', function ($match) use (&$menu) {
        $menu = $match[1];

        return '';
    }, $page);
    $html = $template;
    $html = str_replace('#{page}', $page, $html);
    $html = str_replace('#{jumbotron}', $jumbotron, $html);
    $html = str_replace('#{menu}', $menu, $html);
    file_put_contents($out, $html);
}

function evaluateCode(&$__state, $__code) {
    ob_start();
    $result = call_user_func(function () use (&$__state, $__code) {
        foreach ($__state as $__key => &$__value) {
            $$__key = &$__value;
        }
        unset($__key);
        unset($__value);
        try {
            $lastResult = eval($__code);
        } catch (Throwable $e) {
            echo "$__code\n\n";

            throw $e;
        }
        foreach (get_defined_vars() as $__key => $__value) {
            $__state[$__key] = &$$__key;
        }
        unset($__state['__state']);
        unset($__state['__code']);

        return $lastResult;
    });
    $ob = ob_get_clean();

    if ($result === false) {
        echo 'Failed lint check.'.PHP_EOL.PHP_EOL;
        $error = error_get_last();

        if ($error != null) {
            echo $error['message'].' on line '.$error['line'].PHP_EOL.PHP_EOL;
        }

        echo "---- eval'd source ---- ".PHP_EOL.PHP_EOL;
        $i = 1;
        foreach (preg_split("/$[\n\r]^/m", $src) as $ln) {
            printf('%3s : %s%s', $i++, $ln, PHP_EOL);
        }

        exit(1);
    }

    return $ob;
}

function compile($src, $dest = null)
{
    $code = file_get_contents($src);

    $imports = 'use Carbon\Carbon; use Carbon\CarbonInterval; use Carbon\CarbonPeriod; ';

    $__state = array();
    $lastCode = '';
    $codes = array();
    $oldCode = null;

    while ($oldCode !== $code) {
        $namesCache = array();
        $oldCode = $code;
        $code = preg_replace_callback('@{{(\w*)::each\((.+)\)}}([\s\S]+){{::endEach}}@isU', function ($matches) use ($imports, &$__state) {
            list(, $name, $items, $contents) = $matches;

            return evaluateCode($__state, "$imports foreach ($items as \$item) { ?>{{eval(\$$name = <?php var_export(\$item); ?>;)}}$contents<?php }");
        }, $code);
        $code = preg_replace_callback('@{{(?:(\w*)::(\w+)\((.+)\)|((?:(\w+)_)?eval(?:\((.+)\))?))}}@sU', function ($matches) use ($imports, &$lastCode, &$codes, &$namesCache, &$__state) {
            list($orig, $name, $cmd, $src, $eval, $evalName, $evalContent) = array_pad($matches, 7, null);

            $src = trim($src, "\n\r");
            $code = empty($evalContent) ? $src : $evalContent;
            $code = trim($code, "\n\r");

            if (strlen($name) > 0) {
                if (in_array($name, $namesCache)) {
                    echo "$name cmd name used twice !!";
                    exit(1);
                }

                $namesCache[] = $name;
            }

            $ob = evaluateCode($__state, $imports.$code);

            // remove the extra newline from a var_dump
            if (strpos($src, 'var_dump(') === 0) {
                $ob = trim($ob);
            }

            if (!empty($eval)) {
                if (!empty($evalContent)) {
                    return $ob;
                }

                return empty($evalName) ? $lastCode : (isset($codes[$evalName]) ? $codes[$evalName] : $orig);
            }

            // Add any necessary padding to lineup comments
            if (preg_match('@/\*pad\(([0-9]+)\)\*/@', $src, $matches)) {
                $src = preg_replace('@/\*pad\(([0-9]+)\)\*/@', '', $src);
                $src = str_pad($src, intval($matches[1]));
            }

            // Inject the eval'd result
            if ($cmd == 'exec') {
                $codes[$name] = $ob;
                $lastCode = $ob;
            }

            return $src;
        }, $code);
    }

    // allow for escaping a command
    $code = trim(str_replace('\{\{', '{{', $code))."\n";

    return $dest ? file_put_contents($dest, $code) : $code;
}

genHtml(file_get_contents('index.src.html'), 'index.o.html', compile('jumbotron.src.html'));
genHtml(file_get_contents('docs/index.src.html'), 'docs/index.o.html');
genHtml(file_get_contents('history/index.src.html'), 'history/index.html');
genHtml(file_get_contents('contribute/index.src.html'), 'contribute/index.html');
compile('reference/index.src.html', 'reference/index.html');

compile('index.o.html', 'index.html');
unlink('index.o.html');

CarbonInterval::setLocale('en');
compile('docs/index.o.html', 'docs/index.html');
unlink('docs/index.o.html');
