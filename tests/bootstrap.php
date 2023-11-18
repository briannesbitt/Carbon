<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/PHPUnit/AssertObjectHasPropertyTrait.php';

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

    throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
});
