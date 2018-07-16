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
    'year' => 'бир жыл|:count жыл',
    'month' => 'бир ай|:count ай',
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
    'months' => ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'],
    'months_short' => ['янв', 'фев', 'март', 'апр', 'май', 'июнь', 'июль', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['Жекшемби', 'Дүйшөмбү', 'Шейшемби', 'Шаршемби', 'Бейшемби', 'Жума', 'Ишемби'],
    'weekdays_short' => ['Жек', 'Дүй', 'Шей', 'Шар', 'Бей', 'Жум', 'Ише'],
    'weekdays_min' => ['Жк', 'Дй', 'Шй', 'Шр', 'Бй', 'Жм', 'Иш'],
];
