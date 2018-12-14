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
    'year' => '%count%年',
    'y' => '%count%年',
    'month' => '%count%ヶ月',
    'm' => '%count%ヶ月',
    'week' => '%count%週間',
    'w' => '%count%週間',
    'day' => '%count%日',
    'd' => '%count%日',
    'hour' => '%count%時間',
    'h' => '%count%時間',
    'minute' => '%count%分',
    'min' => '%count%分',
    'second' => '{1}数秒|]1,Inf[%count%秒',
    's' => '%count%秒',
    'ago' => ':time前',
    'from_now' => ':time後',
    'after' => ':time後',
    'before' => ':time前',
    'diff_yesterday' => '昨日',
    'diff_tomorrow' => '明日',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY/MM/DD',
        'LL' => 'YYYY年M月D日',
        'LLL' => 'YYYY年M月D日 HH:mm',
        'LLLL' => 'YYYY年M月D日 dddd HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[今日] LT',
        'nextDay' => '[明日] LT',
        'nextWeek' => function (\Carbon\CarbonInterface $current, \Carbon\CarbonInterface $other) {
            if ($other->week !== $current->week) {
                return '[来週]dddd LT';
            }

            return 'dddd LT';
        },
        'lastDay' => '[昨日] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $current, \Carbon\CarbonInterface $other) {
            if ($other->week !== $current->week) {
                return '[先週]dddd LT';
            }

            return 'dddd LT';
        },
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'd':
            case 'D':
            case 'DDD':
                return $number.'日';
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? '午前' : '午後';
    },
    'months' => ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    'months_short' => ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    'weekdays' => ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
    'weekdays_short' => ['日', '月', '火', '水', '木', '金', '土'],
    'weekdays_min' => ['日', '月', '火', '水', '木', '金', '土'],
];
