<?php

require_once __DIR__ . '/../vendor/autoload.php';

set_error_handler(static function (
    int $errno,
    string $errstr,
    string $errfile = '',
    int $errline = 0,
    array $errcontext = []
): bool {
    if (!(error_reporting() & $errno)) {
        return false;
    }

    throw new ErrorException($errstr . "\n" . json_encode($errcontext), $errno, $errno, $errfile, $errline);
});
