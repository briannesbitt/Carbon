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
 * - Christopher Dell
 * - Akira Matsuda
 * - Enrique Vidal
 * - Simone Carletti
 * - Henning Kiel
 * - Aaron Patterson
 * - Florian Hanke
 */
return [
  'formats' => [
    'L' => 'DD.MM.YYYY',
    'LL' => 'Do MMMM YYYY',
    'LLLL' => 'dddd, Do MMMM YYYY, HH:MM Uhr',
    'LLL' => 'Do MMMM, HH:MM Uhr',
  ],
  'year' => ':count Johr',
  'month' => ':count Monet',
  'week' => ':count Woche',
  'day' => ':count Tag',
  'minute' => ':count Minute',
  'second' => ':count Sekunde',
  'weekdays' => ['Sunntig', 'Mäntig', 'Ziischtig', 'Mittwuch', 'Dunschtig', 'Friitig', 'Samschtig'],
  'weekdays_short' => ['Su', 'Mä', 'Zi', 'Mi', 'Du', 'Fr', 'Sa'],
  'weekdays_min' => ['Su', 'Mä', 'Zi', 'Mi', 'Du', 'Fr', 'Sa'],
  'months' => ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'Auguscht', 'September', 'Oktober', 'November', 'Dezember'],
  'months_short' => ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
  'meridiem' => ['vormittags', 'nachmittags'],
  'ordinal' => ':number.',
  'list' => [', ', ' und '],
];
