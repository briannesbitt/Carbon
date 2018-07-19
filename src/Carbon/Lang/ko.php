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
    'year' => '{1}일 년|]1,Inf[:count년',
    'y' => ':count 년',
    'month' => '{1}한 달|]1,Inf[:count달',
    'm' => ':count 개월',
    'week' => ':count 주일',
    'w' => ':count 주일',
    'day' => '{1}하루|]1,Inf[:count일',
    'd' => ':count 일',
    'hour' => '{1}한 시간|]1,Inf[:count시간',
    'h' => ':count 시간',
    'minute' => '{1}1분|]1,Inf[:count분',
    'min' => ':count 분',
    'second' => '{1}몇 초|]1,Inf[:count초',
    's' => ':count 초',
    'ago' => ':time 전',
    'from_now' => ':time 후',
    'after' => ':time 이후',
    'before' => ':time 이전',
    'formats' => [
        'LT' => 'A h:mm',
        'LTS' => 'A h:mm:ss',
        'L' => 'YYYY.MM.DD.',
        'LL' => 'YYYY년 MMMM D일',
        'LLL' => 'YYYY년 MMMM D일 A h:mm',
        'LLLL' => 'YYYY년 MMMM D일 dddd A h:mm',
    ],
    'calendar' => [
        'sameDay' => '오늘 LT',
        'nextDay' => '내일 LT',
        'nextWeek' => 'dddd LT',
        'lastDay' => '어제 LT',
        'lastWeek' => '지난주 dddd LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'd':
            case 'D':
            case 'DDD':
                return $number.'일';
            case 'M':
                return $number.'월';
            case 'w':
            case 'W':
                return $number.'주';
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? '오전' : '오후';
    },
    'months' => ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    'months_short' => ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    'weekdays' => ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
    'weekdays_short' => ['일', '월', '화', '수', '목', '금', '토'],
    'weekdays_min' => ['일', '월', '화', '수', '목', '금', '토'],
];
