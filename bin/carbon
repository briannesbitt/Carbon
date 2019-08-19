#!/usr/bin/env php
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

require $dir.'/autoload.php';

exit((new \Carbon\Cli\Invoker())(...$argv) ? 0 : 1);
