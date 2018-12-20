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
}, 'lo');

return [
    'year' => ':count ປີ',
    'month' => ':count ເດືອນ',
    'week' => ':count ອາທິດ',
    'day' => ':count ມື້',
    'hour' => ':count ຊົ່ວໂມງ',
    'minute' => ':count ນາທີ',
    'second' => 'ບໍ່ເທົ່າໃດວິນາທີ|:count ວິນາທີ',
    'ago' => ':timeຜ່ານມາ',
    'from_now' => 'ອີກ :time',
    'diff_yesterday' => 'ມື້ວານນີ້ເວລາ',
    'diff_tomorrow' => 'ມື້ອື່ນເວລາ',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'ວັນdddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[ມື້ນີ້ເວລາ] LT',
        'nextDay' => '[ມື້ອື່ນເວລາ] LT',
        'nextWeek' => '[ວັນ]dddd[ໜ້າເວລາ] LT',
        'lastDay' => '[ມື້ວານນີ້ເວລາ] LT',
        'lastWeek' => '[ວັນ]dddd[ແລ້ວນີ້ເວລາ] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => 'ທີ່:number',
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'ຕອນເຊົ້າ' : 'ຕອນແລງ';
    },
    'months' => ['ມັງກອນ', 'ກຸມພາ', 'ມີນາ', 'ເມສາ', 'ພຶດສະພາ', 'ມິຖຸນາ', 'ກໍລະກົດ', 'ສິງຫາ', 'ກັນຍາ', 'ຕຸລາ', 'ພະຈິກ', 'ທັນວາ'],
    'months_short' => ['ມັງກອນ', 'ກຸມພາ', 'ມີນາ', 'ເມສາ', 'ພຶດສະພາ', 'ມິຖຸນາ', 'ກໍລະກົດ', 'ສິງຫາ', 'ກັນຍາ', 'ຕຸລາ', 'ພະຈິກ', 'ທັນວາ'],
    'weekdays' => ['ອາທິດ', 'ຈັນ', 'ອັງຄານ', 'ພຸດ', 'ພະຫັດ', 'ສຸກ', 'ເສົາ'],
    'weekdays_short' => ['ທິດ', 'ຈັນ', 'ອັງຄານ', 'ພຸດ', 'ພະຫັດ', 'ສຸກ', 'ເສົາ'],
    'weekdays_min' => ['ທ', 'ຈ', 'ອຄ', 'ພ', 'ພຫ', 'ສກ', 'ສ'],
    'list' => [', ', 'ແລະ '],
];
