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
    'year' => '1年|:count年',
    'y' => ':count年',
    'month' => '1ヶ月|:countヶ月',
    'm' => ':countヶ月',
    'week' => ':count週間',
    'w' => ':count週間',
    'day' => '1日|:count日',
    'd' => ':count日',
    'hour' => '1時間|:count時間',
    'h' => ':count時間',
    'minute' => '1分|:count分',
    'min' => ':count分',
    'second' => '数秒|:count秒',
    's' => ':count秒',
    'ago' => ':time前',
    'from_now' => ':time後',
    'after' => ':time後',
    'before' => ':time前',
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
        'nextWeek' => '',
        'lastDay' => '[昨日] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    'months_short' => ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    'weekdays' => ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
    'weekdays_short' => ['日', '月', '火', '水', '木', '金', '土'],
    'weekdays_min' => ['日', '月', '火', '水', '木', '金', '土'],
];
