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
}, 'ky');

return [
    'year' => 'бир жыл|:count жыл',
    'month' => 'бир ай|:count ай',
    'week' => 'бир жума|:count жума',
    'day' => 'бир күн|:count күн',
    'hour' => 'бир саат|:count саат',
    'minute' => 'бир мүнөт|:count мүнөт',
    'second' => 'бирнече секунд|:count секунд',
    'ago' => ':time мурун',
    'from_now' => ':time ичинде',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Бүгүн саат] LT',
        'nextDay' => '[Эртең саат] LT',
        'nextWeek' => 'dddd [саат] LT',
        'lastDay' => '[Кече саат] LT',
        'lastWeek' => '[Өткен аптанын] dddd [күнү] [саат] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        static $suffixes = [
            0 => '-чү',
            1 => '-чи',
            2 => '-чи',
            3 => '-чү',
            4 => '-чү',
            5 => '-чи',
            6 => '-чы',
            7 => '-чи',
            8 => '-чи',
            9 => '-чу',
            10 => '-чу',
            20 => '-чы',
            30 => '-чу',
            40 => '-чы',
            50 => '-чү',
            60 => '-чы',
            70 => '-чи',
            80 => '-чи',
            90 => '-чу',
            100 => '-чү',
        ];

        return $number.($suffixes[$number] ?? $suffixes[$number % 10] ?? $suffixes[$number >= 100 ? 100 : -1] ?? '');
    },
    'months' => ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'],
    'months_short' => ['янв', 'фев', 'март', 'апр', 'май', 'июнь', 'июль', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['Жекшемби', 'Дүйшөмбү', 'Шейшемби', 'Шаршемби', 'Бейшемби', 'Жума', 'Ишемби'],
    'weekdays_short' => ['Жек', 'Дүй', 'Шей', 'Шар', 'Бей', 'Жум', 'Ише'],
    'weekdays_min' => ['Жк', 'Дй', 'Шй', 'Шр', 'Бй', 'Жм', 'Иш'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => ' ',
];
