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
    'year' => '1 ປີ|:count ປີ',
    'month' => '1 ເດືອນ|:count ເດືອນ',
    'day' => '1 ມື້|:count ມື້',
    'hour' => '1 ຊົ່ວໂມງ|:count ຊົ່ວໂມງ',
    'minute' => '1 ນາທີ|:count ນາທີ',
    'second' => 'ບໍ່ເທົ່າໃດວິນາທີ|:count ວິນາທີ',
    'ago' => ':timeຜ່ານມາ',
    'from_now' => 'ອີກ :time',
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
    'months' => ['ມັງກອນ', 'ກຸມພາ', 'ມີນາ', 'ເມສາ', 'ພຶດສະພາ', 'ມິຖຸນາ', 'ກໍລະກົດ', 'ສິງຫາ', 'ກັນຍາ', 'ຕຸລາ', 'ພະຈິກ', 'ທັນວາ'],
    'months_short' => ['ມັງກອນ', 'ກຸມພາ', 'ມີນາ', 'ເມສາ', 'ພຶດສະພາ', 'ມິຖຸນາ', 'ກໍລະກົດ', 'ສິງຫາ', 'ກັນຍາ', 'ຕຸລາ', 'ພະຈິກ', 'ທັນວາ'],
    'weekdays' => ['ອາທິດ', 'ຈັນ', 'ອັງຄານ', 'ພຸດ', 'ພະຫັດ', 'ສຸກ', 'ເສົາ'],
    'weekdays_short' => ['ທິດ', 'ຈັນ', 'ອັງຄານ', 'ພຸດ', 'ພະຫັດ', 'ສຸກ', 'ເສົາ'],
    'weekdays_min' => ['ທ', 'ຈ', 'ອຄ', 'ພ', 'ພຫ', 'ສກ', 'ສ'],
];
