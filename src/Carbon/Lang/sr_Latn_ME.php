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
    'month' => ':count mjesec|:count mjeseca|:count mjeseci',
    'week' => ':count nedjelja|:count nedjelje|:count nedjelja',
    'second' => ':count sekund|:count sekunde|:count sekundi',
    'ago' => 'prije :time',
    'from_now' => 'za :time',
    'after' => ':time nakon',
    'before' => ':time prije',
    'week_from_now' => ':count nedjelju|:count nedjelje|:count nedjelja',
    'week_ago' => ':count nedjelju|:count nedjelje|:count nedjelja',
]);
