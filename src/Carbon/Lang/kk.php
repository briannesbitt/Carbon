<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'kk');

/*
 * Authors:
 * - Josh Soref
 * - François B
 * - Talat Uspanov
 * - Нурлан Рахимжанов
 * - Toleugazy Kali
 */
return [
    'year' => ':count жыл',
    'a_year' => 'бір жыл|:count жыл',
    'y' => ':count ж.',
    'month' => ':count ай',
    'a_month' => 'бір ай|:count ай',
    'm' => ':count ай',
    'week' => ':count апта',
    'a_week' => 'бір апта',
    'w' => ':count ап.',
    'day' => ':count күн',
    'a_day' => 'бір күн|:count күн',
    'd' => ':count к.',
    'hour' => ':count сағат',
    'a_hour' => 'бір сағат|:count сағат',
    'h' => ':count са.',
    'minute' => ':count минут',
    'a_minute' => 'бір минут|:count минут',
    'min' => ':count м.',
    'second' => ':count секунд',
    'a_second' => 'бірнеше секунд|:count секунд',
    's' => ':count се.',
    'ago' => ':time бұрын',
    'from_now' => ':time ішінде',
    'after' => ':time кейін',
    'before' => ':time бұрын',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Бүгін сағат] LT',
        'nextDay' => '[Ертең сағат] LT',
        'nextWeek' => 'dddd [сағат] LT',
        'lastDay' => '[Кеше сағат] LT',
        'lastWeek' => '[Өткен аптаның] dddd [сағат] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        static $suffixes = [
            0 => '-ші',
            1 => '-ші',
            2 => '-ші',
            3 => '-ші',
            4 => '-ші',
            5 => '-ші',
            6 => '-шы',
            7 => '-ші',
            8 => '-ші',
            9 => '-шы',
            10 => '-шы',
            20 => '-шы',
            30 => '-шы',
            40 => '-шы',
            50 => '-ші',
            60 => '-шы',
            70 => '-ші',
            80 => '-ші',
            90 => '-шы',
            100 => '-ші',
        ];

        return $number.($suffixes[$number] ?? $suffixes[$number % 10] ?? $suffixes[$number >= 100 ? 100 : -1] ?? '');
    },
    'months' => ['қаңтар', 'ақпан', 'наурыз', 'сәуір', 'мамыр', 'маусым', 'шілде', 'тамыз', 'қыркүйек', 'қазан', 'қараша', 'желтоқсан'],
    'months_short' => ['қаң', 'ақп', 'нау', 'сәу', 'мам', 'мау', 'шіл', 'там', 'қыр', 'қаз', 'қар', 'жел'],
    'weekdays' => ['жексенбі', 'дүйсенбі', 'сейсенбі', 'сәрсенбі', 'бейсенбі', 'жұма', 'сенбі'],
    'weekdays_short' => ['жек', 'дүй', 'сей', 'сәр', 'бей', 'жұм', 'сен'],
    'weekdays_min' => ['жк', 'дй', 'сй', 'ср', 'бй', 'жм', 'сн'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' және '],
];
