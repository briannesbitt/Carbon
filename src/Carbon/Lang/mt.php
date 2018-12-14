<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => 'sena|:count sni',
    'month' => 'xahar|:count xhur',
    'week' => 'gimgħa|:count ġimgħat',
    'day' => 'ġurnata|:count ġranet',
    'hour' => 'siegħa|:count siegħat',
    'minute' => 'minuta|:count minuti',
    'second' => 'ftit sekondi|:count sekondi',
    'ago' => ':time ilu',
    'from_now' => 'f’ :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Illum fil-]LT',
        'nextDay' => '[Għada fil-]LT',
        'nextWeek' => 'dddd [fil-]LT',
        'lastDay' => '[Il-bieraħ fil-]LT',
        'lastWeek' => 'dddd [li għadda] [fil-]LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberº',
    'months' => ['Jannar', 'Frar', 'Marzu', 'April', 'Mejju', 'Ġunju', 'Lulju', 'Awwissu', 'Settembru', 'Ottubru', 'Novembru', 'Diċembru'],
    'months_short' => ['Jan', 'Fra', 'Mar', 'Apr', 'Mej', 'Ġun', 'Lul', 'Aww', 'Set', 'Ott', 'Nov', 'Diċ'],
    'weekdays' => ['Il-Ħadd', 'It-Tnejn', 'It-Tlieta', 'L-Erbgħa', 'Il-Ħamis', 'Il-Ġimgħa', 'Is-Sibt'],
    'weekdays_short' => ['Ħad', 'Tne', 'Tli', 'Erb', 'Ħam', 'Ġim', 'Sib'],
    'weekdays_min' => ['Ħa', 'Tn', 'Tl', 'Er', 'Ħa', 'Ġi', 'Si'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
