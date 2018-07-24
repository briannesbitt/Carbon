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

class TlPhTest extends LocalizationTestCase
{
    const LOCALE = 'tl_PH'; // Tagalog

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '00:00 noong nakaraang Sabado',
        // Carbon::now()->subDays(2)->calendar()
        '20:49 sa susunod na Linggo',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Bukas ng 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '10:00 ngayong araw',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '02:00 ngayong araw',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '01:00 kahapon',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '00:00 noong nakaraang Martes',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '00:00 sa susunod na Martes',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '00:00 sa susunod na Biyernes',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ilang segundo ang nakalipas',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ang nakalipas',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 segundo ang nakalipas',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ang nakalipas',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'isang minuto ang nakalipas',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ang nakalipas',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuto ang nakalipas',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ang nakalipas',
        // Carbon::now()->subHours(1)->diffForHumans()
        'isang oras ang nakalipas',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ang nakalipas',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oras ang nakalipas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ang nakalipas',
        // Carbon::now()->subDays(1)->diffForHumans()
        'isang araw ang nakalipas',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ang nakalipas',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 araw ang nakalipas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ang nakalipas',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'isang linggo ang nakalipas',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ang nakalipas',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 linggo ang nakalipas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ang nakalipas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'isang buwan ang nakalipas',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ang nakalipas',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 buwan ang nakalipas',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ang nakalipas',
        // Carbon::now()->subYears(1)->diffForHumans()
        'isang taon ang nakalipas',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ang nakalipas',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 taon ang nakalipas',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ang nakalipas',
        // Carbon::now()->addSecond()->diffForHumans()
        'sa loob ng ilang segundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sa loob ng s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ilang segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sa loob ng s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'isang minuto ilang segundo',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'isang linggo 10 oras',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'isang linggo 6 araw',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'isang linggo 6 araw',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 linggo isang oras',
    ];
}
