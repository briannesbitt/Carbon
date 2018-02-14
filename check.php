<?php

define('MAXIMUM_MISSING_METHODS_THRESHOLD', 58);

require 'vendor/autoload.php';

$documentation = file_get_contents('docs/index.src.html');

$methodsCount = 0;
$missingMethodsCount = 0;

function display($message) {
    if (substr(PHP_OS, 0, 3) === 'WIN') {
        $message = preg_replace("/\033\\[0(;\d+)?m/", '', $message);
    }

    echo $message;
}

$dateTimeMethods = get_class_methods(new \DateTime());

foreach (get_class_methods(new \Carbon\Carbon()) as $method) {
    if (in_array($method, $dateTimeMethods)) {
        continue;
    }

    $methodsCount++;
    $documented = strpos($documentation, $method) !== false;
    if (!$documented) {
        $missingMethodsCount++;
    }
    $color = $documented ? 31 : 32;
    $message = $documented ? 'documented' : 'missing';
    $method = str_pad($method, 25);

    if (!$documented || !isset($argv[1]) || $argv[1] !== 'missing') {
        display("- $method \033[0;{$color}m{$message}\033[0m\n");
    }
}

display($missingMethodsCount ?
    "\033[0;32m$missingMethodsCount missing / $methodsCount (threshold: " . MAXIMUM_MISSING_METHODS_THRESHOLD . ")\033[0m\n" :
    "\033[0;31mEvery method documented\033[0m\n"
);

exit($missingMethodsCount > MAXIMUM_MISSING_METHODS_THRESHOLD ? 1 : 0);
