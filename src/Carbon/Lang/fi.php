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
 * - Philippe Vaucher
 * - Janne Warén
 * - digitalfrost
 * - Tsutomu Kuroda
 * - Roope Salmi
 * - tjku
 * - Max Melentiev
 * - Sami Haahtinen
 * - Teemu Leisti
 * - Artem Ignatyev
 * - Akira Matsuda
 * - Christopher Dell
 * - Enrique Vidal
 * - Simone Carletti
 * - Robert Bjarnason
 * - Aaron Patterson
 * - Nicolás Hock Isaza
 * - Tom Hughes
 * - Sven Fuchs
 * - Petri Kivikangas
 * - Nizar Jouini
 * - Marko Seppae
 */
return [
    'year' => ':count vuosi|:count vuotta',
    'y' => ':count vuosi|:count vuotta',
    'month' => ':count kuukausi|:count kuukautta',
    'm' => ':count kuukausi|:count kuukautta',
    'week' => ':count viikko|:count viikkoa',
    'w' => ':count viikko|:count viikkoa',
    'day' => ':count päivä|:count päivää',
    'd' => ':count päivä|:count päivää',
    'hour' => ':count tunti|:count tuntia',
    'h' => ':count tunti|:count tuntia',
    'minute' => ':count minuutti|:count minuuttia',
    'min' => ':count minuutti|:count minuuttia',
    'second' => ':count sekunti|:count sekuntia',
    's' => ':count sekunti|:count sekuntia',
    'ago' => ':time sitten',
    'from_now' => ':time tästä hetkestä',
    'after' => ':time sen jälkeen',
    'before' => ':time ennen',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' ja '],
    'formats' => [
        'LT' => 'HH.mm',
        'LTS' => 'HH.mm:ss',
        'L' => 'D.M.YYYY',
        'LL' => 'dddd D. MMMM[ta] YYYY',
        'LLL' => 'D.MM. HH.mm',
        'LLLL' => 'D. MMMM[ta] YYYY HH.mm',
    ],
    'weekdays' => ['sunnuntai', 'maanantai', 'tiistai', 'keskiviikko', 'torstai', 'perjantai', 'lauantai'],
    'weekdays_short' => ['su', 'ma', 'ti', 'ke', 'to', 'pe', 'la'],
    'weekdays_min' => ['su', 'ma', 'ti', 'ke', 'to', 'pe', 'la'],
    'months' => ['tammikuu', 'helmikuu', 'maaliskuu', 'huhtikuu', 'toukokuu', 'kesäkuu', 'heinäkuu', 'elokuu', 'syyskuu', 'lokakuu', 'marraskuu', 'joulukuu'],
    'months_short' => ['tammi', 'helmi', 'maalis', 'huhti', 'touko', 'kesä', 'heinä', 'elo', 'syys', 'loka', 'marras', 'joulu'],
    'meridiem' => ['aamupäivä', 'iltapäivä'],
];
