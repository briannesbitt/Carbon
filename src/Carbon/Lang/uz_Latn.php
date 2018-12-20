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
    'year' => 'bir yil|:count yil',
    'month' => 'bir oy|:count oy',
    'week' => 'bir hafta|:count hafta',
    'day' => 'bir kun|:count kun',
    'hour' => 'bir soat|:count soat',
    'minute' => 'bir daqiqa|:count daqiqa',
    'second' => 'soniya|:count soniya',
    'ago' => 'Bir necha :time oldin',
    'from_now' => 'Yaqin :time ichida',
    'diff_yesterday' => 'Kecha',
    'diff_tomorrow' => 'Ertaga',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'D MMMM YYYY, dddd HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Bugun soat] LT [da]',
        'nextDay' => '[Ertaga] LT [da]',
        'nextWeek' => 'dddd [kuni soat] LT [da]',
        'lastDay' => '[Kecha soat] LT [da]',
        'lastWeek' => '[O\'tgan] dddd [kuni soat] LT [da]',
        'sameElse' => 'L',
    ],
    'months' => ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'Iyun', 'Iyul', 'Avgust', 'Sentabr', 'Oktabr', 'Noyabr', 'Dekabr'],
    'months_short' => ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'Iyun', 'Iyul', 'Avg', 'Sen', 'Okt', 'Noy', 'Dek'],
    'weekdays' => ['Yakshanba', 'Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba'],
    'weekdays_short' => ['Yak', 'Dush', 'Sesh', 'Chor', 'Pay', 'Jum', 'Shan'],
    'weekdays_min' => ['Ya', 'Du', 'Se', 'Cho', 'Pa', 'Ju', 'Sha'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' va '],
];
