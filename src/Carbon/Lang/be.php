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
    'year' => 'год|',
    'month' => 'месяц|',
    'day' => 'дзень|',
    'hour' => '|',
    'minute' => '|',
    'second' => 'некалькі секунд|',
    'ago' => ':time таму',
    'from_now' => 'праз :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY г.',
        'LLL' => 'D MMMM YYYY г., HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY г., HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Сёння ў] LT',
        'nextDay' => '[Заўтра ў] LT',
        'nextWeek' => '',
        'lastDay' => '[Учора ў] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        return $number.(($number === 1 || $number === 8 || $number >= 20) ? 'ste' : 'de');
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        $meridiem = $hour < 12 ? 'VM' : 'NM';

        return $isLower ? strtolower($meridiem) : $meridiem;
    },
    'months' => ['студзеня', 'лютага', 'сакавіка', 'красавіка', 'траўня', 'чэрвеня', 'ліпеня', 'жніўня', 'верасня', 'кастрычніка', 'лістапада', 'снежня'],
    'months_standalone' => ['студзень', 'люты', 'сакавік', 'красавік', 'травень', 'чэрвень', 'ліпень', 'жнівень', 'верасень', 'кастрычнік', 'лістапад', 'снежань'],
    'months_short' => ['студ', 'лют', 'сак', 'крас', 'трав', 'чэрв', 'ліп', 'жнів', 'вер', 'каст', 'ліст', 'снеж'],
    'weekdays' => ['нядзелю', 'панядзелак', 'аўторак', 'сераду', 'чацвер', 'пятніцу', 'суботу'],
    'weekdays_standalone' => ['нядзеля', 'панядзелак', 'аўторак', 'серада', 'чацвер', 'пятніца', 'субота'],
    'weekdays_short' => ['нд', 'пн', 'ат', 'ср', 'чц', 'пт', 'сб'],
    'weekdays_min' => ['нд', 'пн', 'ат', 'ср', 'чц', 'пт', 'сб'],
];
