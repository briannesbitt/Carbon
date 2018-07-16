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
    'year' => '1 ปี|:count ปี',
    'y' => ':count ปี',
    'month' => '1 เดือน|:count เดือน',
    'm' => ':count เดือน',
    'week' => ':count สัปดาห์',
    'w' => ':count สัปดาห์',
    'day' => '1 วัน|:count วัน',
    'd' => ':count วัน',
    'hour' => '1 ชั่วโมง|:count ชั่วโมง',
    'h' => ':count ชั่วโมง',
    'minute' => '1 นาที|:count นาที',
    'min' => ':count นาที',
    'second' => 'ไม่กี่วินาที|:count วินาที',
    's' => ':count วินาที',
    'ago' => ':timeที่แล้ว',
    'from_now' => 'อีก :time',
    'after' => ':timeหลังจากนี้',
    'before' => ':timeก่อน',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY เวลา H:mm',
        'LLLL' => 'วันddddที่ D MMMM YYYY เวลา H:mm',
    ],
    'calendar' => [
        'sameDay' => '[วันนี้ เวลา] LT',
        'nextDay' => '[พรุ่งนี้ เวลา] LT',
        'nextWeek' => 'dddd[หน้า เวลา] LT',
        'lastDay' => '[เมื่อวานนี้ เวลา] LT',
        'lastWeek' => '[วัน]dddd[ที่แล้ว เวลา] LT',
        'sameElse' => 'L',
    ],
    'months' => ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    'months_short' => ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    'weekdays' => ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
    'weekdays_short' => ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์'],
    'weekdays_min' => ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
];
