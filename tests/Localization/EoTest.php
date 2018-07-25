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

class EoTest extends LocalizationTestCase
{
    const LOCALE = 'eo'; // Esperanto

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pasinta sabato je 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'dimanĉo je 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Morgaŭ je 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hodiaŭ je 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hodiaŭ je 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Hieraŭ je 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'pasinta mardo je 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mardo je 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vendredo je 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        ':1a :1a',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2a :1a',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3a :1a',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4a :1a',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5a :1a',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6a :1a',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7a :2a',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11a :2a',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40a',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41a',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a.t.m., 12:00 a.t.m.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 a.t.m., 1:30 a.t.m.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 a.t.m., 2:00 a.t.m.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 a.t.m., 6:00 a.t.m.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 a.t.m., 10:00 a.t.m.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 p.t.m., 12:00 p.t.m.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 p.t.m., 5:00 p.t.m.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 p.t.m., 11:00 p.t.m.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'antaŭ sekundoj',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'antaŭ 1 sekundo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'antaŭ 2 sekundoj',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'antaŭ 2 sekundoj',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'antaŭ minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'antaŭ 1 minuto',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'antaŭ 2 minutoj',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'antaŭ 2 minutoj',
        // Carbon::now()->subHours(1)->diffForHumans()
        'antaŭ horo',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'antaŭ 1 horo',
        // Carbon::now()->subHours(2)->diffForHumans()
        'antaŭ 2 horoj',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'antaŭ 2 horoj',
        // Carbon::now()->subDays(1)->diffForHumans()
        'antaŭ tago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'antaŭ 1 tago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'antaŭ 2 tagoj',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'antaŭ 2 tagoj',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'antaŭ 1 semajno',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'antaŭ 1 semajno',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'antaŭ 2 semajnoj',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'antaŭ 2 semajnoj',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'antaŭ monato',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'antaŭ 1 monato',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'antaŭ 2 monatoj',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'antaŭ 2 monatoj',
        // Carbon::now()->subYears(1)->diffForHumans()
        'antaŭ jaro',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'antaŭ 1 jaro',
        // Carbon::now()->subYears(2)->diffForHumans()
        'antaŭ 2 jaroj',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'antaŭ 2 jaroj',
        // Carbon::now()->addSecond()->diffForHumans()
        'post sekundoj',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'post 1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'sekundoj poste',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekundo poste',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'sekundoj antaŭe',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekundo antaŭe',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sekundoj',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundoj',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekundoj',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'post 1 sekundo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minuto sekundoj',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 jaroj 3 monatoj 1 tago 1 sekundo',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semajno 10 horoj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semajno 6 tagoj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semajno 6 tagoj',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semajnoj horo',
    ];
}
