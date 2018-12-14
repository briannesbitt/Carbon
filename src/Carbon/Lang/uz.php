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
}, 'uz');

return [
    'year' => 'бир йил|:count йил',
    'y' => ':count yil',
    'month' => 'бир ой|:count ой',
    'm' => ':count oy',
    'week' => 'бир ҳафта|:count ҳафта',
    'w' => ':count ҳафта',
    'day' => 'бир кун|:count кун',
    'd' => ':count kun',
    'hour' => 'бир соат|:count соат',
    'h' => ':count soat',
    'minute' => 'бир дакика|:count дакика',
    'min' => ':count daq',
    'second' => 'фурсат|:count фурсат',
    's' => ':count s',
    'ago' => 'Бир неча :time олдин',
    'from_now' => 'Якин :time ичида',
    'after' => ':time keyin',
    'before' => ':time oldin',
    'diff_yesterday' => 'Кеча',
    'diff_tomorrow' => 'Эртага',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'D MMMM YYYY, dddd HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Бугун соат] LT [да]',
        'nextDay' => '[Эртага] LT [да]',
        'nextWeek' => 'dddd [куни соат] LT [да]',
        'lastDay' => '[Кеча соат] LT [да]',
        'lastWeek' => '[Утган] dddd [куни соат] LT [да]',
        'sameElse' => 'L',
    ],
    'months' => ['январ', 'феврал', 'март', 'апрел', 'май', 'июн', 'июл', 'август', 'сентябр', 'октябр', 'ноябр', 'декабр'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['Якшанба', 'Душанба', 'Сешанба', 'Чоршанба', 'Пайшанба', 'Жума', 'Шанба'],
    'weekdays_short' => ['Якш', 'Душ', 'Сеш', 'Чор', 'Пай', 'Жум', 'Шан'],
    'weekdays_min' => ['Як', 'Ду', 'Се', 'Чо', 'Па', 'Жу', 'Ша'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
