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
    'year' => 'jaro|:count jaroj',
    'y' => ':count jaro|:count jaroj',
    'month' => 'monato|:count monatoj',
    'm' => ':count monato|:count monatoj',
    'week' => ':count semajno|:count semajnoj',
    'w' => ':count semajno|:count semajnoj',
    'day' => 'tago|:count tagoj',
    'd' => ':count tago|:count tagoj',
    'hour' => 'horo|:count horoj',
    'h' => ':count horo|:count horoj',
    'minute' => 'minuto|:count minutoj',
    'min' => ':count minuto|:count minutoj',
    'second' => 'sekundoj|:count sekundoj',
    's' => ':count sekundo|:count sekundoj',
    'ago' => 'antaŭ :time',
    'from_now' => 'post :time',
    'after' => ':time poste',
    'before' => ':time antaŭe',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'D[-a de] MMMM, YYYY',
        'LLL' => 'D[-a de] MMMM, YYYY HH:mm',
        'LLLL' => 'dddd, [la] D[-a de] MMMM, YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Hodiaŭ je] LT',
        'nextDay' => '[Morgaŭ je] LT',
        'nextWeek' => 'dddd [je] LT',
        'lastDay' => '[Hieraŭ je] LT',
        'lastWeek' => '[pasinta] dddd [je] LT',
        'sameElse' => 'L',
    ],
    'months' => ['januaro', 'februaro', 'marto', 'aprilo', 'majo', 'junio', 'julio', 'aŭgusto', 'septembro', 'oktobro', 'novembro', 'decembro'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'aŭg', 'sep', 'okt', 'nov', 'dec'],
    'weekdays' => ['dimanĉo', 'lundo', 'mardo', 'merkredo', 'ĵaŭdo', 'vendredo', 'sabato'],
    'weekdays_short' => ['dim', 'lun', 'mard', 'merk', 'ĵaŭ', 'ven', 'sab'],
    'weekdays_min' => ['di', 'lu', 'ma', 'me', 'ĵa', 've', 'sa'],
];
