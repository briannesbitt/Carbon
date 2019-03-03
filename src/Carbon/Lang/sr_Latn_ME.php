<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Glavić
 * - Milos Sakovic
 */
return array_replace_recursive(require __DIR__.'/sr.php', [
    'ago' => 'prije :time',
    'from_now' => 'za :time',
    'after' => ':time nakon',
    'before' => ':time prije',
]);
