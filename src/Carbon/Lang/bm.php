<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'bm');

return [
    'year' => 'san kelen|san :count',
    'month' => 'kalo kelen|kalo :count',
    'week' => 'dɔgɔkun :count',
    'day' => 'tile kelen|tile :count',
    'hour' => 'lɛrɛ kelen|lɛrɛ :count',
    'minute' => 'miniti kelen|miniti :count',
    'second' => 'sanga dama dama|sekondi :count',
    'ago' => 'a bɛ :time bɔ',
    'from_now' => ':time kɔnɔ',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'MMMM [tile] D [san] YYYY',
        'LLL' => 'MMMM [tile] D [san] YYYY [lɛrɛ] HH:mm',
        'LLLL' => 'dddd MMMM [tile] D [san] YYYY [lɛrɛ] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Bi lɛrɛ] LT',
        'nextDay' => '[Sini lɛrɛ] LT',
        'nextWeek' => 'dddd [don lɛrɛ] LT',
        'lastDay' => '[Kunu lɛrɛ] LT',
        'lastWeek' => 'dddd [tɛmɛnen lɛrɛ] LT',
        'sameElse' => 'L',
    ],
    'months' => ['Zanwuyekalo', 'Fewuruyekalo', 'Marisikalo', 'Awirilikalo', 'Mɛkalo', 'Zuwɛnkalo', 'Zuluyekalo', 'Utikalo', 'Sɛtanburukalo', 'ɔkutɔburukalo', 'Nowanburukalo', 'Desanburukalo'],
    'months_short' => ['Zan', 'Few', 'Mar', 'Awi', 'Mɛ', 'Zuw', 'Zul', 'Uti', 'Sɛt', 'ɔku', 'Now', 'Des'],
    'weekdays' => ['Kari', 'Ntɛnɛn', 'Tarata', 'Araba', 'Alamisa', 'Juma', 'Sibiri'],
    'weekdays_short' => ['Kar', 'Ntɛ', 'Tar', 'Ara', 'Ala', 'Jum', 'Sib'],
    'weekdays_min' => ['Ka', 'Nt', 'Ta', 'Ar', 'Al', 'Ju', 'Si'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' ni '],
];
