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
}, 'tg');

/*
 * Authors:
 * - Orif N. Jr
 */
return [
    'year' => 'як сол|:count сол',
    'month' => 'як моҳ|:count моҳ',
    'week' => 'як ҳафта|:count ҳафта',
    'day' => 'як рӯз|:count рӯз',
    'hour' => 'як соат|:count соат',
    'minute' => 'як дақиқа|:count дақиқа',
    'second' => 'якчанд сония|:count сония',
    'ago' => ':time пеш',
    'from_now' => 'баъди :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Имрӯз соати] LT',
        'nextDay' => '[Пагоҳ соати] LT',
        'nextWeek' => 'dddd[и] [ҳафтаи оянда соати] LT',
        'lastDay' => '[Дирӯз соати] LT',
        'lastWeek' => 'dddd[и] [ҳафтаи гузашта соати] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        if ($number === 0) { // special case for zero
            return "$number-ıncı";
        }

        static $suffixes = [
            0 => '-ум',
            1 => '-ум',
            2 => '-юм',
            3 => '-юм',
            4 => '-ум',
            5 => '-ум',
            6 => '-ум',
            7 => '-ум',
            8 => '-ум',
            9 => '-ум',
            10 => '-ум',
            12 => '-ум',
            13 => '-ум',
            20 => '-ум',
            30 => '-юм',
            40 => '-ум',
            50 => '-ум',
            60 => '-ум',
            70 => '-ум',
            80 => '-ум',
            90 => '-ум',
            100 => '-ум',
        ];

        return $number.($suffixes[$number] ?? $suffixes[$number % 10] ?? $suffixes[$number >= 100 ? 100 : -1] ?? '');
    },
    'meridiem' => function ($hour) {
        if ($hour < 4) {
            return 'шаб';
        }
        if ($hour < 11) {
            return 'субҳ';
        }
        if ($hour < 16) {
            return 'рӯз';
        }
        if ($hour < 19) {
            return 'бегоҳ';
        }

        return 'шаб';
    },
    'months' => ['январ', 'феврал', 'март', 'апрел', 'май', 'июн', 'июл', 'август', 'сентябр', 'октябр', 'ноябр', 'декабр'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['якшанбе', 'душанбе', 'сешанбе', 'чоршанбе', 'панҷшанбе', 'ҷумъа', 'шанбе'],
    'weekdays_short' => ['яшб', 'дшб', 'сшб', 'чшб', 'пшб', 'ҷум', 'шнб'],
    'weekdays_min' => ['яш', 'дш', 'сш', 'чш', 'пш', 'ҷм', 'шб'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' ва '],
];
