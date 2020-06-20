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
    'diff_tomorrow' => 'sjutra',
    'calendar' => [
        'nextDay' => '[sjutra u] LT',
        'nextWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[u nedjelju u] LT';
                case 3:
                    return '[u srijedu u] LT';
                case 6:
                    return '[u subotu u] LT';
                default:
                    return '[u] dddd [u] LT';
            }
        },
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[prošle nedjelje u] LT';
                case 1:
                    return '[prošle nedjelje u] LT';
                case 2:
                    return '[prošlog utorka u] LT';
                case 3:
                    return '[prošle srijede u] LT';
                case 4:
                    return '[prošlog četvrtka u] LT';
                case 5:
                    return '[prošlog petka u] LT';
                default:
                    return '[prošle subote u] LT';
            }
        },
    ],
    'weekdays' => ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'],
    'weekdays_short' => ['ned.', 'pon.', 'uto.', 'sri.', 'čet.', 'pet.', 'sub.'],
]);
