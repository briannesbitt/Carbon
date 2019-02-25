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
 * - RFC 2319    bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/ru.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
    'months_short' => ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
    'weekdays' => ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
    'weekdays_short' => ['Вск', 'Пнд', 'Вто', 'Срд', 'Чтв', 'Птн', 'Суб'],
    'weekdays_min' => ['Вск', 'Пнд', 'Вто', 'Срд', 'Чтв', 'Птн', 'Суб'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
]);
