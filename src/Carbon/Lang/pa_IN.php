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
    'year' => 'ਇੱਕ ਸਾਲ|:count ਸਾਲ',
    'month' => 'ਇੱਕ ਮਹੀਨਾ|:count ਮਹੀਨੇ',
    'week' => 'ਹਫਤਾ|:count ਹਫ਼ਤੇ',
    'day' => 'ਇੱਕ ਦਿਨ|:count ਦਿਨ',
    'hour' => 'ਇੱਕ ਘੰਟਾ|:count ਘੰਟੇ',
    'minute' => 'ਇਕ ਮਿੰਟ|:count ਮਿੰਟ',
    'second' => 'ਕੁਝ ਸਕਿੰਟ|:count ਸਕਿੰਟ',
    'ago' => ':time ਪਿਛਲੇ',
    'from_now' => ':time ਵਿੱਚ',
    'diff_yesterday' => 'ਕਲ',
    'diff_tomorrow' => 'ਕਲ',
    'formats' => [
        'LT' => 'A h:mm ਵਜੇ',
        'LTS' => 'A h:mm:ss ਵਜੇ',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY, A h:mm ਵਜੇ',
        'LLLL' => 'dddd, D MMMM YYYY, A h:mm ਵਜੇ',
    ],
    'calendar' => [
        'sameDay' => '[ਅਜ] LT',
        'nextDay' => '[ਕਲ] LT',
        'nextWeek' => '[ਅਗਲਾ] dddd, LT',
        'lastDay' => '[ਕਲ] LT',
        'lastWeek' => '[ਪਿਛਲੇ] dddd, LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'ਰਾਤ';
        }
        if ($hour < 10) {
            return 'ਸਵੇਰ';
        }
        if ($hour < 17) {
            return 'ਦੁਪਹਿਰ';
        }
        if ($hour < 20) {
            return 'ਸ਼ਾਮ';
        }

        return 'ਰਾਤ';
    },
    'months' => ['ਜਨਵਰੀ', 'ਫ਼ਰਵਰੀ', 'ਮਾਰਚ', 'ਅਪ੍ਰੈਲ', 'ਮਈ', 'ਜੂਨ', 'ਜੁਲਾਈ', 'ਅਗਸਤ', 'ਸਤੰਬਰ', 'ਅਕਤੂਬਰ', 'ਨਵੰਬਰ', 'ਦਸੰਬਰ'],
    'months_short' => ['ਜਨਵਰੀ', 'ਫ਼ਰਵਰੀ', 'ਮਾਰਚ', 'ਅਪ੍ਰੈਲ', 'ਮਈ', 'ਜੂਨ', 'ਜੁਲਾਈ', 'ਅਗਸਤ', 'ਸਤੰਬਰ', 'ਅਕਤੂਬਰ', 'ਨਵੰਬਰ', 'ਦਸੰਬਰ'],
    'weekdays' => ['ਐਤਵਾਰ', 'ਸੋਮਵਾਰ', 'ਮੰਗਲਵਾਰ', 'ਬੁਧਵਾਰ', 'ਵੀਰਵਾਰ', 'ਸ਼ੁੱਕਰਵਾਰ', 'ਸ਼ਨੀਚਰਵਾਰ'],
    'weekdays_short' => ['ਐਤ', 'ਸੋਮ', 'ਮੰਗਲ', 'ਬੁਧ', 'ਵੀਰ', 'ਸ਼ੁਕਰ', 'ਸ਼ਨੀ'],
    'weekdays_min' => ['ਐਤ', 'ਸੋਮ', 'ਮੰਗਲ', 'ਬੁਧ', 'ਵੀਰ', 'ਸ਼ੁਕਰ', 'ਸ਼ਨੀ'],
];
