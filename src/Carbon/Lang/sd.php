<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$months = [
    'جنوري',
    'فيبروري',
    'مارچ',
    'اپريل',
    'مئي',
    'جون',
    'جولاءِ',
    'آگسٽ',
    'سيپٽمبر',
    'آڪٽوبر',
    'نومبر',
    'ڊسمبر',
];

$weekdays = [
    'آچر',
    'سومر',
    'اڱارو',
    'اربع',
    'خميس',
    'جمع',
    'ڇنڇر',
];

\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'sd');

return [
    'year' => 'هڪ سال|:count سال',
    'month' => 'هڪ مهينو|:count مهينا',
    'week' => 'ھڪ ھفتو|:count هفتا',
    'day' => 'هڪ ڏينهن|:count ڏينهن',
    'hour' => 'هڪ ڪلاڪ|:count ڪلاڪ',
    'minute' => 'هڪ منٽ|:count منٽ',
    'second' => 'چند سيڪنڊ|:count سيڪنڊ',
    'ago' => ':time اڳ',
    'from_now' => ':time پوء',
    'diff_yesterday' => 'ڪالهه',
    'diff_tomorrow' => 'سڀاڻي',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd، D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[اڄ] LT',
        'nextDay' => '[سڀاڻي] LT',
        'nextWeek' => 'dddd [اڳين هفتي تي] LT',
        'lastDay' => '[ڪالهه] LT',
        'lastWeek' => '[گزريل هفتي] dddd [تي] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'صبح' : 'شام';
    },
    'months' => $months,
    'months_short' => $months,
    'weekdays' => $weekdays,
    'weekdays_short' => $weekdays,
    'weekdays_min' => $weekdays,
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => ['، ', ' ۽ '],
];
