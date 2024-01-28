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
class JvTest extends LocalizationTestCase
{
    public const LOCALE = 'jv'; // Javanese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mbenjang pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Septu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Minggu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Senen pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Seloso pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Rebu pukul 00.00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kemis pukul 00.00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jemuwah pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Seloso pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Rebu pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kemis pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jemuwah pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Septu pukul 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Minggu kepengker pukul 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kala wingi pukul 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Dinten puniko pukul 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dinten puniko pukul 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Mbenjang pukul 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Seloso pukul 00.00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Kala wingi pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kala wingi pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Seloso kepengker pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Senen kepengker pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Minggu kepengker pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Septu kepengker pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jemuwah kepengker pukul 00.00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Kemis kepengker pukul 00.00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Rebu kepengker pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jemuwah kepengker pukul 00.00',
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
        '12:00 enjing CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 enjing, 12:00 enjing',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 enjing, 1:30 enjing',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 enjing, 2:00 enjing',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 enjing, 6:00 enjing',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 enjing, 10:00 enjing',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 siyang, 12:00 siyang',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 sonten, 5:00 sonten',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ndalu, 9:30 ndalu',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ndalu, 11:00 ndalu',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'sawetawis detik ingkang kepengker',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'sawetawis detik ingkang kepengker',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 detik ingkang kepengker',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 detik ingkang kepengker',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'setunggal menit ingkang kepengker',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'setunggal menit ingkang kepengker',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 menit ingkang kepengker',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 menit ingkang kepengker',
        // Carbon::now()->subHours(1)->diffForHumans()
        'setunggal jam ingkang kepengker',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'setunggal jam ingkang kepengker',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam ingkang kepengker',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 jam ingkang kepengker',
        // Carbon::now()->subDays(1)->diffForHumans()
        'sedinten ingkang kepengker',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'sedinten ingkang kepengker',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dinten ingkang kepengker',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dinten ingkang kepengker',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'sakminggu ingkang kepengker',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'sakminggu ingkang kepengker',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu ingkang kepengker',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 minggu ingkang kepengker',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'sewulan ingkang kepengker',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'sewulan ingkang kepengker',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 wulan ingkang kepengker',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 wulan ingkang kepengker',
        // Carbon::now()->subYears(1)->diffForHumans()
        'setaun ingkang kepengker',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'setaun ingkang kepengker',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 taun ingkang kepengker',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 taun ingkang kepengker',
        // Carbon::now()->addSecond()->diffForHumans()
        'wonten ing sawetawis detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'wonten ing sawetawis detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sawetawis detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'sawetawis detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'wonten ing sawetawis detik',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'setunggal menit sawetawis detik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 taun 3 wulan sedinten sawetawis detik',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'wonten ing 3 taun',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 wulan ingkang kepengker',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 taun 3 wulan sedinten sawetawis detik ingkang kepengker',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'sakminggu 10 jam',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'sakminggu 6 dinten',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'sakminggu 6 dinten',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'wonten ing sakminggu lan 6 dinten',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 minggu setunggal jam',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'wonten ing setunggal jam',
        // CarbonInterval::days(2)->forHumans()
        '2 dinten',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'sedinten 3 jam',
    ];
}
