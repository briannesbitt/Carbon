<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class LoLaTest extends LocalizationTestCase
{
    public const LOCALE = 'lo_LA'; // Lao

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ອື່ນເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນເສົາໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນອາທິດໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນຈັນໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນອັງຄານໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນພຸດໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ວັນພະຫັດໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ວັນສຸກໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນອັງຄານໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນພຸດໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນພະຫັດໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນສຸກໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນເສົາໜ້າເວລາ 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ວັນອາທິດແລ້ວນີ້ເວລາ 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ວານນີ້ເວລາ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ມື້ນີ້ເວລາ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ນີ້ເວລາ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ມື້ອື່ນເວລາ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນອັງຄານໜ້າເວລາ 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ມື້ວານນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ມື້ວານນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນອັງຄານແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນຈັນແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນອາທິດແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນເສົາແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ວັນສຸກແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ວັນພະຫັດແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ວັນພຸດແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ວັນສຸກແລ້ວນີ້ເວລາ 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ທີ່1 ທີ່1 ທີ່1 ທີ່1 ທີ່1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ທີ່2 ທີ່1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ທີ່3 ທີ່1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ທີ່4 ທີ່1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ທີ່5 ທີ່1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ທີ່6 ທີ່1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ທີ່7 ທີ່2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ທີ່11 ທີ່2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ທີ່40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ທີ່41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ທີ່100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ຕອນເຊົ້າ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ຕອນເຊົ້າ, 12:00 ຕອນເຊົ້າ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ຕອນເຊົ້າ, 1:30 ຕອນເຊົ້າ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ຕອນເຊົ້າ, 2:00 ຕອນເຊົ້າ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ຕອນເຊົ້າ, 6:00 ຕອນເຊົ້າ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ຕອນເຊົ້າ, 10:00 ຕອນເຊົ້າ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ຕອນແລງ, 12:00 ຕອນແລງ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ຕອນແລງ, 5:00 ຕອນແລງ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ຕອນແລງ, 9:30 ຕອນແລງ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ຕອນແລງ, 11:00 ຕອນແລງ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ທີ່0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ບໍ່ເທົ່າໃດວິນາທີຜ່ານມາ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ວິ.ຜ່ານມາ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ວິນາທີຜ່ານມາ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ວິ.ຜ່ານມາ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ນາທີຜ່ານມາ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ນທ.ຜ່ານມາ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ນາທີຜ່ານມາ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ນທ.ຜ່ານມາ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ຊົ່ວໂມງຜ່ານມາ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ຊມ.ຜ່ານມາ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ຊົ່ວໂມງຜ່ານມາ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ຊມ.ຜ່ານມາ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ມື້ຜ່ານມາ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ມື້ຜ່ານມາ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ມື້ຜ່ານມາ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ມື້ຜ່ານມາ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ອາທິດຜ່ານມາ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ອທ.ຜ່ານມາ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ອາທິດຜ່ານມາ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ອທ.ຜ່ານມາ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ເດືອນຜ່ານມາ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ດ.ຜ່ານມາ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ເດືອນຜ່ານມາ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ດ.ຜ່ານມາ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ປີຜ່ານມາ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ປີຜ່ານມາ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ປີຜ່ານມາ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ປີຜ່ານມາ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ອີກ ບໍ່ເທົ່າໃດວິນາທີ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ອີກ 1 ວິ.',
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
        '1 ວິ.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ວິນາທີ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ວິ.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ອີກ 1 ວິ.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ນາທີ ບໍ່ເທົ່າໃດວິນາທີ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ປີ 3 ດ. 1 ມື້ 1 ວິ.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ອີກ 3 ປີ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ດ.ຜ່ານມາ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ປີ 3 ດ. 1 ມື້ 1 ວິ.ຜ່ານມາ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 10 ຊົ່ວໂມງ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 6 ມື້',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ອາທິດ 6 ມື້',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ອີກ 1 ອາທິດແລະ 6 ມື້',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ອາທິດ 1 ຊົ່ວໂມງ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ອີກ 1 ຊົ່ວໂມງ',
        // CarbonInterval::days(2)->forHumans()
        '2 ມື້',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ມື້ 3 ຊມ.',
    ];
}
