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
class MsBnTest extends LocalizationTestCase
{
    public const LOCALE = 'ms_BN'; // Malay

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Esok pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ahad pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Isnin pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Rabu pukul 12:00 a',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Khamis pukul 12:00 a',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jumaat pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Rabu pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Khamis pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumaat pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabtu pukul 12:00 a',
        // Carbon::now()->subDays(2)->calendar()
        'Ahad lepas pukul 8:49 p',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kelmarin pukul 10:00 p',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hari ini pukul 10:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hari ini pukul 2:00 a',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Esok pukul 1:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa pukul 12:00 a',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Kelmarin pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kelmarin pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa lepas pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Isnin lepas pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ahad lepas pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu lepas pukul 12:00 a',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumaat lepas pukul 12:00 a',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Khamis lepas pukul 12:00 a',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Rabu lepas pukul 12:00 a',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumaat lepas pukul 12:00 a',
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
        '12:00 a CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a, 12:00 a',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 a, 1:30 a',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 a, 2:00 a',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 a, 6:00 a',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 a, 10:00 a',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 p, 12:00 p',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 p, 5:00 p',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 p, 9:30 p',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 p, 11:00 p',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 saat yang lepas',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 saat yang lepas',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 saat yang lepas',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 saat yang lepas',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minit yang lepas',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minit yang lepas',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minit yang lepas',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minit yang lepas',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 jam yang lepas',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 jam yang lepas',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam yang lepas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 jam yang lepas',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 hari yang lepas',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 hari yang lepas',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 hari yang lepas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 hari yang lepas',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 minggu yang lepas',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 minggu yang lepas',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu yang lepas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 minggu yang lepas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 bulan yang lepas',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 bulan yang lepas',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 bulan yang lepas',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 bulan yang lepas',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 tahun yang lepas',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 tahun yang lepas',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 tahun yang lepas',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 tahun yang lepas',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 saat dari sekarang',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 saat dari sekarang',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 saat kemudian',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 saat kemudian',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 saat sebelum',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 saat sebelum',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 saat',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 saat',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 saat',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 saat',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 saat dari sekarang',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minit 1 saat',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 tahun 3 bulan 1 hari 1 saat',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 tahun dari sekarang',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 bulan yang lepas',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 tahun 3 bulan 1 hari 1 saat yang lepas',
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
        '1 hari 3 jam',
    ];
}
