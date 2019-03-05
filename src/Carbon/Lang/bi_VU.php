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
 * - Samsung Electronics Co., Ltd.    akhilesh.k@samsung.com & maninder1.s@samsung.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'dddd DD MMM YYYY',
    ],
    'months' => ['jenuware', 'febwari', 'maj', 'epril', 'mei', 'jun', 'julae', 'ogis', 'septemba', 'oktoba', 'novemba', 'disemba'],
    'months_short' => ['jen', 'feb', 'maj', 'epr', 'mei', 'jun', 'jul', 'ogi', 'sep', 'okt', 'nov', 'dis'],
    'weekdays' => ['sande', 'mande', 'maj', 'wota', 'fraede', 'sarede'],
    'weekdays_short' => ['san', 'man', 'maj', 'wot', 'fra', 'sar'],
    'weekdays_min' => ['san', 'man', 'maj', 'wot', 'fra', 'sar'],

    'year' => ':count seven',
    'y' => ':count seven',
    'a_year' => ':count seven',

    'month' => ':count mi',
    'm' => ':count mi',
    'a_month' => ':count mi',

    'week' => ':count sarede',
    'w' => ':count sarede',
    'a_week' => ':count sarede',

    'day' => ':count betde',
    'd' => ':count betde',
    'a_day' => ':count betde',

    'hour' => ':count klok',
    'h' => ':count klok',
    'a_hour' => ':count klok',

    'minute' => ':count smol',
    'min' => ':count smol',
    'a_minute' => ':count smol',

    'second' => ':count tu',
    's' => ':count tu',
    'a_second' => ':count tu',
]);
