<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'meridiem' => ['ТО', 'ТК'],
    'weekdays' => ['якшанба', 'душанба', 'сешанба', 'чоршанба', 'пайшанба', 'жума', 'шанба'],
    'weekdays_short' => ['якш', 'душ', 'сеш', 'чор', 'пай', 'жум', 'шан'],
    'weekdays_min' => ['Як', 'Ду', 'Се', 'Чо', 'Па', 'Жу', 'Ша'],
    'weekdays_standalone' => ['Якшанба', 'Душанба', 'Сешанба', 'Чоршанба', 'Пайшанба', 'Жума', 'Шанба'],
    'weekdays_short_standalone' => ['Якш', 'Душ', 'Сеш', 'Чор', 'Пай', 'Жум', 'Шан'],
    'months' => ['январ', 'феврал', 'март', 'апрел', 'май', 'июн', 'июл', 'август', 'сентябр', 'октябр', 'ноябр', 'декабр'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'months_standalone' => ['Январ', 'Феврал', 'Март', 'Апрел', 'Май', 'Июн', 'Июл', 'Август', 'Сентябр', 'Октябр', 'Ноябр', 'Декабр'],
    'months_short_standalone' => ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/yy',
        'LL' => 'D MMM, YYYY',
        'LLL' => 'D MMMM, YYYY HH:mm',
        'LLLL' => 'dddd, DD MMMM, YYYY HH:mm',
    ],
]);
