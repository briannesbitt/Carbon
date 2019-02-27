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
 * - Alastair McKinstry    bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['mis Genver', 'mis Hwevrer', 'mis Meurth', 'mis Ebrel', 'mis Me', 'mis Metheven', 'mis Gortheren', 'mis Est', 'mis Gwynngala', 'mis Hedra', 'mis Du', 'mis Kevardhu'],
    'months_short' => ['Gen', 'Hwe', 'Meu', 'Ebr', 'Me', 'Met', 'Gor', 'Est', 'Gwn', 'Hed', 'Du', 'Kev'],
    'weekdays' => ['De Sul', 'De Lun', 'De Merth', 'De Merher', 'De Yow', 'De Gwener', 'De Sadorn'],
    'weekdays_short' => ['Sul', 'Lun', 'Mth', 'Mhr', 'Yow', 'Gwe', 'Sad'],
    'weekdays_min' => ['Sul', 'Lun', 'Mth', 'Mhr', 'Yow', 'Gwe', 'Sad'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
