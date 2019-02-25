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
 * - ANCHR
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'YYYY.DD.MM',
    ],
    'months' => ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['КӀиранан де', 'Оршотан де', 'Шинарин де', 'Кхаарин де', 'Еарин де', 'ПӀераскан де', 'Шот де'],
    'weekdays_short' => ['КӀ', 'Ор', 'Ши', 'Кх', 'Еа', 'ПӀ', 'Шо'],
    'weekdays_min' => ['КӀ', 'Ор', 'Ши', 'Кх', 'Еа', 'ПӀ', 'Шо'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
]);
