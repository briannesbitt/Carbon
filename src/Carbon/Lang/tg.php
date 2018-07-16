<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => 'як сол|:count сол',
    'month' => 'як моҳ|:count моҳ',
    'day' => 'як рӯз|:count рӯз',
    'hour' => 'як соат|:count соат',
    'minute' => 'як дақиқа|:count дақиқа',
    'second' => 'якчанд сония|',
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
    'months' => ['январ', 'феврал', 'март', 'апрел', 'май', 'июн', 'июл', 'август', 'сентябр', 'октябр', 'ноябр', 'декабр'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['якшанбе', 'душанбе', 'сешанбе', 'чоршанбе', 'панҷшанбе', 'ҷумъа', 'шанбе'],
    'weekdays_short' => ['яшб', 'дшб', 'сшб', 'чшб', 'пшб', 'ҷум', 'шнб'],
    'weekdays_min' => ['яш', 'дш', 'сш', 'чш', 'пш', 'ҷм', 'шб'],
];
