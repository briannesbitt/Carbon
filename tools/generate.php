<?php

include_once __DIR__.'/config.php';

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en');
ini_set('html_errors', 0);
if (function_exists('xdebug_disable')) {
    ini_set('xdebug.overload_var_dump', 0);
    xdebug_disable();
}

chdir(__DIR__.'/..');
require 'vendor/autoload.php';
require 'tools/methods.php';

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use Carbon\Factory;
use Carbon\FactoryImmutable;
use Carbon\Language;
use Carbon\Translator;

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
    echo "Your history.json is not up to date. You should first run:\nphp tools/api-history.php\n";
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
        $classes = trim(implode(' ', [
            strpos($description, '@deprecated') !== false ? 'deprecated' : '',
        ]));

        if (method_exists($dateTimeObject, $method)) {
            $dateClass = get_class($dateTimeObject);
            $rcCarbon = new ReflectionMethod($className, $method);
            $rcDate = new ReflectionMethod($dateClass, $method);
            if ($rcCarbon == $rcDate) {
                $dateClass = trim($dateClass, '/\\');

                yield [
                    'name' => $method,
                    'classes' => $classes,
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
            $ref = implode(', ', reset($globalHistory[$key]) ?: ['']);
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
            'classes' => $classes,
            'prototype' => empty($parameters) ? '<em>no arguments</em>' : "<code>$parameters</code>",
            'className' => preg_replace('/^Carbon\\\\/', '', $className),
            'description' => preg_replace('/\n *\n/', '<br><br>', preg_replace('/@deprecated\s(([^\n]+)(\n [^\n])*)/', '<div class="alert alert-warning">$1</div>', $description)),
            'history' => "<table class='info-table method-history'>$history</table>",
        ];
    }
});

Carbon::macro('describeIsoFormat', function ($code) {
    return [
        'D' => 'Day of month number (from 1 to 31)',
        'DD' => 'Day of month number with trailing zero (from 01 to 31)',
        'Do' => 'Day of month with ordinal suffix (from 1st to 31th), translatable',
        'd' => 'Day of week number (from 0 (Sunday) to 6 (Saturday))',
        'dd' => 'Minified day name (from Su to Sa), transatable',
        'ddd' => 'Short day name (from Sun to Sat), transatable',
        'dddd' => 'Day name (from Sunday to Saturday), transatable',
        'DDD' => 'Day of year number (from 1 to 366)',
        'DDDD' => 'Day of year number with trailing zeros (3 digits, from 001 to 366)',
        'DDDo' => 'Day of year number with ordinal suffix (from 1st to 366th), translatable',
        'e' => 'Day of week number (from 0 (Sunday) to 6 (Saturday)), similar to "d" but this one is translatable (takes first day of week of the current locale)',
        'E' => 'Day of week number (from 1 (Monday) to 7 (Sunday))',
        'H' => 'Hour from 0 to 23',
        'HH' => 'Hour with trailing zero from 00 to 23',
        'h' => 'Hour from 0 to 12',
        'hh' => 'Hour with trailing zero from 00 to 12',
        'k' => 'Hour from 1 to 24',
        'kk' => 'Hour with trailing zero from 01 to 24',
        'm' => 'Minute from 0 to 59',
        'mm' => 'Minute with trailing zero from 00 to 59',
        'a' => 'Meridiem am/pm',
        'A' => 'Meridiem AM/PM',
        's' => 'Second from 0 to 59',
        'ss' => 'Second with trailing zero from 00 to 59',
        'S' => 'Second tenth',
        'SS' => 'Second hundredth (on 2 digits with trailing zero)',
        'SSS' => 'Millisecond (on 3 digits with trailing zeros)',
        'SSSS' => 'Second ten thousandth (on 4 digits with trailing zeros)',
        'SSSSS' => 'Second hundred thousandth (on 5 digits with trailing zeros)',
        'SSSSSS' => 'Microsecond (on 6 digits with trailing zeros)',
        'SSSSSSS' => 'Second ten millionth (on 7 digits with trailing zeros)',
        'SSSSSSSS' => 'Second hundred millionth (on 8 digits with trailing zeros)',
        'SSSSSSSSS' => 'Nanosecond (on 9 digits with trailing zeros)',
        'M' => 'Month from 1 to 12',
        'MM' => 'Month with trailing zero from 01 to 12',
        'MMM' => 'Short month name, translatable',
        'MMMM' => 'Month name, translatable',
        'Mo' => 'Month with ordinal suffix from 1st to 12th, translatable',
        'Q' => 'Quarter from 1 to 4',
        'Qo' => 'Quarter with ordinal suffix from 1st to 4th, translatable',
        'G' => 'ISO week year (see <a href="https://en.wikipedia.org/wiki/ISO_week_date" target="_blank">ISO week date</a>)',
        'GG' => 'ISO week year (on 2 digits with trailing zero)',
        'GGG' => 'ISO week year (on 3 digits with trailing zeros)',
        'GGGG' => 'ISO week year (on 4 digits with trailing zeros)',
        'GGGGG' => 'ISO week year (on 5 digits with trailing zeros)',
        'g' => 'Week year according to locale settings, translatable',
        'gg' => 'Week year according to locale settings (on 2 digits with trailing zero), translatable',
        'ggg' => 'Week year according to locale settings (on 3 digits with trailing zeros), translatable',
        'gggg' => 'Week year according to locale settings (on 4 digits with trailing zeros), translatable',
        'ggggg' => 'Week year according to locale settings (on 5 digits with trailing zeros), translatable',
        'W' => 'ISO week number in the year (see <a href="https://en.wikipedia.org/wiki/ISO_week_date" target="_blank">ISO week date</a>)',
        'WW' => 'ISO week number in the year (on 2 digits with trailing zero)',
        'Wo' => 'ISO week number in the year with ordinal suffix, translatable',
        'w' => 'Week number in the year according to locale settings, translatable',
        'ww' => 'Week number in the year according to locale settings (on 2 digits with trailing zero)',
        'wo' => 'Week number in the year according to locale settings with ordinal suffix, translatable',
        'x' => 'Millisecond-precision timestamp (same as <code>date.getTime()</code> in JavaScript)',
        'X' => 'Timestamp (number of seconds since 1970-01-01)',
        'Y' => 'Full year from -9999 to 9999',
        'YY' => 'Year on 2 digits from 00 to 99',
        'YYYY' => 'Year on 4 digits from 0000 to 9999',
        'YYYYY' => 'Year on 5 digits from 00000 to 09999',
        'YYYYYY' => 'Year on 5 digits with sign from -09999 to +09999',
        'z' => 'Abbreviated time zone name',
        'zz' => 'Time zone name',
        'Z' => 'Time zone offset HH:mm',
        'ZZ' => 'Time zone offset HHmm',
    ][$code] ?? '';
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
    $scripts = '';
    $page = preg_replace_callback('/<script>([\s\S]*?)<\/script>/', function ($match) use (&$scripts) {
        $scripts = $match[0];

        return '';
    }, $page);
    $pageWidth = empty($menu) ? 12 : 9;
    $page = preg_replace_callback('/<page-width>([\s\S]*?)<\/page-width>/', function ($match) use (&$pageWidth) {
        $pageWidth = $match[1];

        return '';
    }, $page);
    $html = $template;
    $html = str_replace('#{page}', $page, $html);
    $html = str_replace('#{pageWidth}', $pageWidth, $html);
    $html = str_replace('#{jumbotron}', $jumbotron, $html);
    $html = str_replace('#{menu}', $menu, $html);
    $html = str_replace('#{scripts}', $scripts, $html);
    file_put_contents($out, $html);
}

function evaluateCode(&$__state, $__code)
{
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

    static $imports = null;
    if (is_null($imports)) {
        $imports = implode('', array_map(function ($import) {
            return "use $import; ";
        }, [
            Carbon::class,
            CarbonImmutable::class,
            CarbonInterface::class,
            CarbonInterval::class,
            CarbonTimeZone::class,
            CarbonPeriod::class,
            Factory::class,
            FactoryImmutable::class,
            Translator::class,
        ]));
    }

    $__state = [];
    $lastCode = '';
    $codes = [];
    $oldCode = null;

    while ($oldCode !== $code) {
        $namesCache = [];
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

file_put_contents('languages.json', json_encode(Language::all()));

genHtml(file_get_contents('index.src.html'), 'index.o.html', compile('jumbotron.src.html'));
genHtml(file_get_contents('docs/index.src.html'), 'docs/index.o.html');
genHtml(file_get_contents('history/index.src.html'), 'history/index.html');
genHtml(file_get_contents('contribute/index.src.html'), 'contribute/index.html');
genHtml(file_get_contents('contribute/translate/index.src.html'), 'contribute/translate/index.html');
genHtml(file_get_contents('contribute/docs/index.src.html'), 'contribute/docs/index.html');
compile('reference/index.src.html', 'reference/index.html');

compile('index.o.html', 'index.html');
unlink('index.o.html');

CarbonInterval::setLocale('en');
compile('docs/index.o.html', 'docs/index.html');
unlink('docs/index.o.html');
