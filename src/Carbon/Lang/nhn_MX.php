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
 * - RAP    libc-alpha@sourceware.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
    'months_short' => ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
    'weekdays' => ['teoilhuitl', 'ceilhuitl', 'omeilhuitl', 'yeilhuitl', 'nahuilhuitl', 'macuililhuitl', 'chicuaceilhuitl'],
    'weekdays_short' => ['teo', 'cei', 'ome', 'yei', 'nau', 'mac', 'chi'],
    'weekdays_min' => ['teo', 'cei', 'ome', 'yei', 'nau', 'mac', 'chi'],
    'day_of_first_week_of_year' => 1,
]);
