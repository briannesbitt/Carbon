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
 * - Gastaldi    alessio.gastaldi@libero.it
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['zenâ', 'fevrâ', 'marzo', 'avrî', 'mazzo', 'zûgno', 'lûggio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dixembre'],
    'months_short' => ['zen', 'fev', 'mar', 'arv', 'maz', 'zûg', 'lûg', 'ago', 'set', 'ött', 'nov', 'dix'],
    'weekdays' => ['domenega', 'lûnedì', 'martedì', 'mercUrdì', 'zêggia', 'venardì', 'sabbo'],
    'weekdays_short' => ['dom', 'lûn', 'mar', 'mer', 'zêu', 'ven', 'sab'],
    'weekdays_min' => ['dom', 'lûn', 'mar', 'mer', 'zêu', 'ven', 'sab'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
