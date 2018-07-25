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

class IdTest extends LocalizationTestCase
{
    const LOCALE = 'id'; // Indonesian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu lalu pukul 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Minggu pukul 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Besok pukul 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hari ini pukul 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hari ini pukul 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Kemarin pukul 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa lalu pukul 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa pukul 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumat pukul 00.00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ordinal',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 malam, 11:00 malam',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'beberapa detik yang lalu',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 detik yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 detik yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 detik yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'semenit yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 menit yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 menit yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 menit yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans()
        'sejam yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 jam yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 jam yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans()
        'sehari yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 hari yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 hari yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 hari yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 minggu yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 minggu yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 minggu yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'sebulan yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 bulan yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 bulan yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 bulan yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans()
        'setahun yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 tahun yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 tahun yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 tahun yang lalu',
        // Carbon::now()->addSecond()->diffForHumans()
        'dalam beberapa detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'dalam 1 detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'beberapa detik setelah',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 detik setelah',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'beberapa detik sebelum',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 detik sebelum',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'beberapa detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'dalam 1 detik',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'semenit beberapa detik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 tahun 3 bulan 1 hari 1 detik',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 minggu 10 jam',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 minggu sejam',
    ];
}
