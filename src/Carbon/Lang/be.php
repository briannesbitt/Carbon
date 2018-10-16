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
    'year' => ':count год|:count гады|:count гадоў',
    'y' => ':count год|:count гады|:count гадоў',
    'month' => ':count месяц|:count месяцы|:count месяцаў',
    'm' => ':count месяц|:count месяцы|:count месяцаў',
    'week' => ':count тыдзень|:count тыдні|:count тыдняў',
    'w' => ':count тыдзень|:count тыдні|:count тыдняў',
    'day' => ':count дзень|:count ні|:count дзён',
    'd' => ':count дзень|:count ні|:count дзён',
    'hour' => ':count гадзіну|:count гадзіны|:count гадзін',
    'h' => ':count гадзіну|:count гадзіны|:count гадзін',
    'minute' => ':count хвіліну|:count хвіліны|:count хвілін',
    'min' => ':count хвіліну|:count хвіліны|:count хвілін',
    'second' => ':count секунду|:count секунды|:count секунд',
    's' => ':count секунду|:count секунды|:count секунд',
    'ago' => ':time таму',
    'from_now' => 'праз :time',
    'after' => ':time пасля',
    'before' => ':time да',
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
        'nextWeek' => '[У] dddd [ў] LT',
        'lastDay' => '[Учора ў] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            switch ($current->dayOfWeek) {
                case 1:
                case 2:
                case 4:
                    return '[У мінулы] dddd [ў] LT';
                default:
                    return '[У мінулую] dddd [ў] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'M':
            case 'd':
            case 'DDD':
            case 'w':
            case 'W':
                return ($number % 10 === 2 || $number % 10 === 3) && ($number % 100 !== 12 && $number % 100 !== 13) ? $number.'-і' : $number.'-ы';
            case 'D':
                return $number.'-га';
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'ночы';
        }
        if ($hour < 12) {
            return 'раніцы';
        }
        if ($hour < 17) {
            return 'дня';
        }

        return 'вечара';
    },
    'months' => ['студзеня', 'лютага', 'сакавіка', 'красавіка', 'траўня', 'чэрвеня', 'ліпеня', 'жніўня', 'верасня', 'кастрычніка', 'лістапада', 'снежня'],
    'months_standalone' => ['студзень', 'люты', 'сакавік', 'красавік', 'травень', 'чэрвень', 'ліпень', 'жнівень', 'верасень', 'кастрычнік', 'лістапад', 'снежань'],
    'months_short' => ['студ', 'лют', 'сак', 'крас', 'трав', 'чэрв', 'ліп', 'жнів', 'вер', 'каст', 'ліст', 'снеж'],
    'months_regexp' => '/D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/',
    'weekdays' => ['нядзелю', 'панядзелак', 'аўторак', 'сераду', 'чацвер', 'пятніцу', 'суботу'],
    'weekdays_standalone' => ['нядзеля', 'панядзелак', 'аўторак', 'серада', 'чацвер', 'пятніца', 'субота'],
    'weekdays_short' => ['нд', 'пн', 'ат', 'ср', 'чц', 'пт', 'сб'],
    'weekdays_min' => ['нд', 'пн', 'ат', 'ср', 'чц', 'пт', 'сб'],
    'weekdays_regexp' => '/\[ ?[Ууў] ?(?:мінулую|наступную)? ?\] ?dddd/',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
