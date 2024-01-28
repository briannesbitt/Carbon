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
class InTest extends LocalizationTestCase
{
    public const LOCALE = 'in'; // in

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Besok pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Minggu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Senin pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Rabu pukul 00.00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kamis pukul 00.00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jumat pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Rabu pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kamis pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumat pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabtu pukul 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Minggu lalu pukul 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kemarin pukul 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hari ini pukul 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hari ini pukul 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Besok pukul 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa pukul 00.00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Kemarin pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kemarin pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa lalu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Senin lalu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Minggu lalu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu lalu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumat lalu pukul 00.00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Kamis lalu pukul 00.00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Rabu lalu pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumat lalu pukul 00.00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 pagi CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 pagi, 12:00 pagi',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 pagi, 1:30 pagi',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 pagi, 2:00 pagi',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 pagi, 6:00 pagi',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 pagi, 10:00 pagi',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 siang, 12:00 siang',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 sore, 5:00 sore',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 malam, 9:30 malam',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 malam, 11:00 malam',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 detik yang lalu',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1dt yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 detik yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2dt yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 menit yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1mnt yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 menit yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2mnt yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 jam yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1j yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2j yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 hari yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1hr yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 hari yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2hr yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 minggu yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1mgg yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2mgg yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 bulan yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1bln yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 bulan yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2bln yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 tahun yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1thn yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 tahun yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2thn yang lalu',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 detik dari sekarang',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1dt dari sekarang',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 detik setelahnya',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1dt setelahnya',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 detik sebelumnya',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1dt sebelumnya',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1dt',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2dt',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1dt dari sekarang',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 menit 1 detik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2thn 3bln 1hr 1dt',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 tahun dari sekarang',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5bln yang lalu',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2thn 3bln 1hr 1dt yang lalu',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 minggu 10 jam',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 minggu dan 6 hari dari sekarang',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 minggu 1 jam',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'sejam dari sekarang',
        // CarbonInterval::days(2)->forHumans()
        '2 hari',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1hr 3j',
    ];
}
