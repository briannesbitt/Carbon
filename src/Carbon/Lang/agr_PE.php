<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - somosazucar.org    libc-alpha@sourceware.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['Petsatin', 'Kupitin', 'Uyaitin', 'Tayutin', 'Kegketin', 'Tegmatin', 'Kuntutin', 'Yagkujutin', 'Daiktatin', 'Ipamtatin', 'Shinutin', 'Sakamtin'],
    'months_short' => ['Pet', 'Kup', 'Uya', 'Tay', 'Keg', 'Teg', 'Kun', 'Yag', 'Dait', 'Ipam', 'Shin', 'Sak'],
    'weekdays' => ['Tuntuamtin', 'Achutin', 'Kugkuktin', 'Saketin', 'Shimpitin', 'Imaptin', 'Bataetin'],
    'weekdays_short' => ['Tun', 'Ach', 'Kug', 'Sak', 'Shim', 'Im', 'Bat'],
    'weekdays_min' => ['Tun', 'Ach', 'Kug', 'Sak', 'Shim', 'Im', 'Bat'],
    'first_day_of_week' => 0,
    'day_of_first_week_of_year' => 7,
    'meridiem' => ['VM', 'NM'],
]);
