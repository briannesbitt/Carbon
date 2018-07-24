<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

class LoTest extends LocalizationTestCase
{
    const LOCALE = 'lo'; // Lao

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນເສົາແລ້ວນີ້ເວລາ 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ວັນອາທິດໜ້າເວລາ 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ອື່ນເວລາ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ມື້ນີ້ເວລາ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ນີ້ເວລາ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ມື້ວານນີ້ເວລາ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນອັງຄານແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນອັງຄານໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນສຸກໜ້າເວລາ 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ບໍ່ເທົ່າໃດວິນາທີຜ່ານມາ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'sຜ່ານມາ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ວິນາທີຜ່ານມາ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'sຜ່ານມາ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ນາທີຜ່ານມາ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'minຜ່ານມາ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ນາທີຜ່ານມາ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'minຜ່ານມາ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ຊົ່ວໂມງຜ່ານມາ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'hຜ່ານມາ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ຊົ່ວໂມງຜ່ານມາ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'hຜ່ານມາ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ມື້ຜ່ານມາ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'dຜ່ານມາ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ມື້ຜ່ານມາ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'dຜ່ານມາ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ອາທິດຜ່ານມາ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'wຜ່ານມາ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ອາທິດຜ່ານມາ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'wຜ່ານມາ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ເດືອນຜ່ານມາ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'mຜ່ານມາ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ເດືອນຜ່ານມາ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'mຜ່ານມາ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ປີຜ່ານມາ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'yຜ່ານມາ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ປີຜ່ານມາ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'yຜ່ານມາ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ອີກ ບໍ່ເທົ່າໃດວິນາທີ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ອີກ s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ບໍ່ເທົ່າໃດວິນາທີ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ວິນາທີ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ອີກ s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ນາທີ ບໍ່ເທົ່າໃດວິນາທີ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 10 ຊົ່ວໂມງ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 6 ມື້',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 6 ມື້',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ອາທິດ 1 ຊົ່ວໂມງ',
    ];
}
