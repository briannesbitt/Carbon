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

class JvTest extends LocalizationTestCase
{
    const LOCALE = 'jv'; // Javanese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Septu kepengker pukul 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Minggu pukul 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mbenjang pukul 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Dinten puniko pukul 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dinten puniko pukul 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Kala wingi pukul 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Seloso kepengker pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Seloso pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jemuwah pukul 00.00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'sawetawis detik ingkang kepengker',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ingkang kepengker',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 detik ingkang kepengker',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ingkang kepengker',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'setunggal menit ingkang kepengker',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ingkang kepengker',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 menit ingkang kepengker',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ingkang kepengker',
        // Carbon::now()->subHours(1)->diffForHumans()
        'setunggal jam ingkang kepengker',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ingkang kepengker',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam ingkang kepengker',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ingkang kepengker',
        // Carbon::now()->subDays(1)->diffForHumans()
        'sedinten ingkang kepengker',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ingkang kepengker',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dinten ingkang kepengker',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ingkang kepengker',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'sakminggu ingkang kepengker',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ingkang kepengker',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu ingkang kepengker',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ingkang kepengker',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'sewulan ingkang kepengker',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ingkang kepengker',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 wulan ingkang kepengker',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ingkang kepengker',
        // Carbon::now()->subYears(1)->diffForHumans()
        'setaun ingkang kepengker',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ingkang kepengker',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 taun ingkang kepengker',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ingkang kepengker',
        // Carbon::now()->addSecond()->diffForHumans()
        'wonten ing sawetawis detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'wonten ing s',
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
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'wonten ing s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'setunggal menit sawetawis detik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'sakminggu 10 jam',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'sakminggu 6 dinten',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'sakminggu 6 dinten',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 minggu setunggal jam',
    ];
}
