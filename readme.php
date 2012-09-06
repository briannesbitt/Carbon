<?php
/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require 'Carbon/Carbon.php';

use Carbon\Carbon;

date_default_timezone_set('America/Toronto');

$readme = file_get_contents('readme.src.md');

$pre_src = 'use Carbon\Carbon; ';

//   {{intro::exec(echo Carbon::now()->subMinutes(2)->diffForHumans();)}}
preg_match_all('@{{(\w*)::(\w+)\((.+)\)}}@sU', $readme, $matches, PREG_SET_ORDER);

foreach ($matches as $match) {

    list($orig, $name, $cmd, $src) = $match;

    $src = trim($src, "\n\r");

    ob_start();
    $result = eval($pre_src . $src);
    $ob = ob_get_clean();

    if ($result === false) {
        echo "Failed lint check.";

        echo $src;

        $error = error_get_last();
        if ($error != null) {
            var_dump($error);
        }

        exit(1);
    }

    // If something was just returned get that and remove the 'return' statement
    //  since its probably not relevant to the sample
    if ($result !== null) {
        $ob .= $result;
        if (strpos($src, 'return ') === 0) {
            $src = str_replace('return ', '', $src);
        }
    }

    // remove the extra newline from a var_dump
    if (strpos($src, 'var_dump(') === 0) {
        $ob = trim($ob);
    }

    // Add any necessary padding to lineup comments
    if (preg_match('@/\*pad\(([0-9]+)\)\*/@', $src, $matches)) {
        $src = str_pad($src, intval($matches[1]));
        $src = preg_replace('@/\*pad\(([0-9]+)\)\*/@', '', $src);
    }

    // Inject the source code
    $readme = str_replace($orig, $src, $readme);

    // Inject the eval'd result
    if ($cmd == 'exec') {
        $readme = str_replace('{{'.$name.'_eval}}', $ob, $readme);
    }
}

file_put_contents('readme.md', $readme);
