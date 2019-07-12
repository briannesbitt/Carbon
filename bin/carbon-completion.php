<?php

$dir = __DIR__.'/..';

if (!file_exists($dir.'/autoload.php')) {
    $dir = __DIR__.'/../vendor';
}

if (!file_exists($dir.'/autoload.php')) {
    $dir = __DIR__.'/../../..';
}

if (!file_exists($dir.'/autoload.php')) {
    echo 'Autoload not found.';
    exit(1);
}

include $dir.'/autoload.php';

$className = \Carbon\Cli::class;

echo class_exists($className)
    ? implode(' ', $argv)
    : 'install';
