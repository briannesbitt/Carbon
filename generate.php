<?php

date_default_timezone_set('America/Toronto');

require 'vendor/autoload.php';
use Carbon\Carbon;
use Carbon\CarbonInterval;

$template = file_get_contents('template.src.html');

function genHtml($page, $out, $jumbotron = '') {
  global $template;
  $html = $template;
  $html = str_replace('#{page}', $page, $html);
  $html = str_replace('#{jumbotron}', $jumbotron, $html);
  file_put_contents($out, $html);
}

function compile($src, $dest) {
    $code = file_get_contents($src);

    $pre_src = 'use Carbon\Carbon; use Carbon\CarbonInterval; ';

    // {{intro::exec(echo Carbon::now()->subMinutes(2)->diffForHumans();)}}
    preg_match_all('@{{(\w*)::(\w+)\((.+)\)}}@sU', $code, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        list($orig, $name, $cmd, $src) = $match;
        $src = trim($src, "\n\r");

        ob_start();
        $result = eval($pre_src . $src);
        $ob = ob_get_clean();

        if ($result === false) {
            echo "Failed lint check.". PHP_EOL . PHP_EOL;
            $error = error_get_last();

            if ($error != null) {
                echo $error['message'] . ' on line ' . $error['line'] . PHP_EOL . PHP_EOL;
            }

            echo "---- eval'd source ---- " . PHP_EOL . PHP_EOL;
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

        // Inject the source code
        $code = str_replace($orig, $src, $code);

        // Inject the eval'd result
        if ($cmd == 'exec') {
            $code = str_replace('{{'.$name.'_eval}}', $ob, $code);
        }
    }

    // allow for escaping a command
    $code = str_replace('\{\{', '{{', $code);

    file_put_contents($dest, $code);
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