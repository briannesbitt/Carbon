<?php

date_default_timezone_set('America/Toronto');
setlocale(LC_ALL, 'en');
ini_set('html_errors', 0);
if (function_exists('xdebug_disable')) {
    ini_set('xdebug.overload_var_dump', 0);
    xdebug_disable();
}

require 'vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

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

function compile($src, $dest)
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
        $code = preg_replace_callback('@{{(?:(\w*)::(\w+)\((.+)\)|((?:(\w+)_)?eval))}}@sU', function ($matches) use ($imports, &$lastCode, &$codes, &$namesCache, &$__state) {
            list($orig, $name, $cmd, $src, $eval, $evalName) = array_pad($matches, 6, null);

            $src = trim($src, "\n\r");

            if (strlen($name) > 0) {
                if (in_array($name, $namesCache)) {
                    echo "$name cmd name used twice !!";
                    exit(1);
                }

                $namesCache[] = $name;
            }

            ob_start();
            $__code = $imports.$src;
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

            // remove the extra newline from a var_dump
            if (strpos($src, 'var_dump(') === 0) {
                $ob = trim($ob);
            }

            // Add any necessary padding to lineup comments
            if (preg_match('@/\*pad\(([0-9]+)\)\*/@', $src, $matches)) {
                $src = preg_replace('@/\*pad\(([0-9]+)\)\*/@', '', $src);
                $src = str_pad($src, intval($matches[1]));
            }

            if (!empty($eval)) {
                return empty($evalName) ? $lastCode : (isset($codes[$evalName]) ? $codes[$evalName] : $orig);
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
    $code = str_replace('\{\{', '{{', $code);

    file_put_contents($dest, trim($code)."\n");
}

genHtml(file_get_contents('index.src.html'), 'index.o.html', file_get_contents('jumbotron.src.html'));
genHtml(file_get_contents('docs/index.src.html'), 'docs/index.o.html');
genHtml(file_get_contents('history/index.src.html'), 'history/index.html');
genHtml(file_get_contents('contribute/index.src.html'), 'contribute/index.html');

compile('index.o.html', 'index.html');
unlink('index.o.html');

CarbonInterval::setLocale('en');
compile('docs/index.o.html', 'docs/index.html');
unlink('docs/index.o.html');
