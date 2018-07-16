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
    'year' => '1 年|:count 年',
    'month' => '1 個月|:count 個月',
    'day' => '1 天|:count 天',
    'hour' => '1 小時|:count 小時',
    'minute' => '1 分鐘|:count 分鐘',
    'second' => '幾秒|:count 秒',
    'ago' => ':time前',
    'from_now' => ':time內',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY/MM/DD',
        'LL' => 'YYYY年M月D日',
        'LLL' => 'YYYY年M月D日 HH:mm',
        'LLLL' => 'YYYY年M月D日dddd HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[今天]LT',
        'nextDay' => '[明天]LT',
        'nextWeek' => '[下]ddddLT',
        'lastDay' => '[昨天]LT',
        'lastWeek' => '[上]ddddLT',
        'sameElse' => 'L',
    ],
    'months' => ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    'months_short' => ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    'weekdays' => ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
    'weekdays_short' => ['週日', '週一', '週二', '週三', '週四', '週五', '週六'],
    'weekdays_min' => ['日', '一', '二', '三', '四', '五', '六'],
];
