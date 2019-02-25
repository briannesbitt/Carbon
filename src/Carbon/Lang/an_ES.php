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
 * - Softaragones Jordi Mallach Pérez, Juan Pablo Martínez bug-glibc-locales@gnu.org, softaragones@softaragones.org
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['chinero', 'febrero', 'marzo', 'abril', 'mayo', 'chunyo', 'chuliol', 'agosto', 'setiembre', 'octubre', 'noviembre', 'aviento'],
    'months_short' => ['chi', 'feb', 'mar', 'abr', 'may', 'chn', 'chl', 'ago', 'set', 'oct', 'nov', 'avi'],
    'weekdays' => ['domingo', 'luns', 'martes', 'mierques', 'chueves', 'viernes', 'sabado'],
    'weekdays_short' => ['dom', 'lun', 'mar', 'mie', 'chu', 'vie', 'sab'],
    'weekdays_min' => ['dom', 'lun', 'mar', 'mie', 'chu', 'vie', 'sab'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
