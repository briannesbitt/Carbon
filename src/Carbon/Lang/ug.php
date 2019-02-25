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
}, 'ug');

/*
 * Authors:
 * - Philippe Vaucher
 * - Tsutomu Kuroda
 * - yasinn
 */
return [
    'year' => 'بىر يىل|:count يىل',
    'month' => 'بىر ئاي|:count ئاي',
    'week' => 'بىر ھەپتە|:count ھەپتە',
    'day' => 'بىر كۈن|:count كۈن',
    'hour' => 'بىر سائەت|:count سائەت',
    'minute' => 'بىر مىنۇت|:count مىنۇت',
    'second' => 'نەچچە سېكونت|:count سېكونت',
    'ago' => ':time بۇرۇن',
    'from_now' => ':time كېيىن',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'YYYY-يىلىM-ئاينىڭD-كۈنى',
        'LLL' => 'YYYY-يىلىM-ئاينىڭD-كۈنى، HH:mm',
        'LLLL' => 'dddd، YYYY-يىلىM-ئاينىڭD-كۈنى، HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[بۈگۈن سائەت] LT',
        'nextDay' => '[ئەتە سائەت] LT',
        'nextWeek' => '[كېلەركى] dddd [سائەت] LT',
        'lastDay' => '[تۆنۈگۈن] LT',
        'lastWeek' => '[ئالدىنقى] dddd [سائەت] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'd':
            case 'D':
            case 'DDD':
                return $number.'-كۈنى';
            case 'w':
            case 'W':
                return $number.'-ھەپتە';
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute) {
        $time = $hour * 100 + $minute;
        if ($time < 600) {
            return 'يېرىم كېچە';
        }
        if ($time < 900) {
            return 'سەھەر';
        }
        if ($time < 1130) {
            return 'چۈشتىن بۇرۇن';
        }
        if ($time < 1230) {
            return 'چۈش';
        }
        if ($time < 1800) {
            return 'چۈشتىن كېيىن';
        }

        return 'كەچ';
    },
    'months' => ['يانۋار', 'فېۋرال', 'مارت', 'ئاپرېل', 'ماي', 'ئىيۇن', 'ئىيۇل', 'ئاۋغۇست', 'سېنتەبىر', 'ئۆكتەبىر', 'نويابىر', 'دېكابىر'],
    'months_short' => ['يانۋار', 'فېۋرال', 'مارت', 'ئاپرېل', 'ماي', 'ئىيۇن', 'ئىيۇل', 'ئاۋغۇست', 'سېنتەبىر', 'ئۆكتەبىر', 'نويابىر', 'دېكابىر'],
    'weekdays' => ['يەكشەنبە', 'دۈشەنبە', 'سەيشەنبە', 'چارشەنبە', 'پەيشەنبە', 'جۈمە', 'شەنبە'],
    'weekdays_short' => ['يە', 'دۈ', 'سە', 'چا', 'پە', 'جۈ', 'شە'],
    'weekdays_min' => ['يە', 'دۈ', 'سە', 'چا', 'پە', 'جۈ', 'شە'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' ۋە '],
];
