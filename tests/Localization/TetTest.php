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

class TetTest extends LocalizationTestCase
{
    const LOCALE = 'tet';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabadu semana kotuk iha 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Domingu iha 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aban iha 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Ohin iha 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ohin iha 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Horiseik iha 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tersa semana kotuk iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tersa iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sesta iha 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'minutu balun liuba',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's liuba',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'minutu 2 liuba',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's liuba',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'minutu ida liuba',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min liuba',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'minutu 2 liuba',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min liuba',
        // Carbon::now()->subHours(1)->diffForHumans()
        'oras ida liuba',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h liuba',
        // Carbon::now()->subHours(2)->diffForHumans()
        'oras 2 liuba',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h liuba',
        // Carbon::now()->subDays(1)->diffForHumans()
        'loron ida liuba',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd liuba',
        // Carbon::now()->subDays(2)->diffForHumans()
        'loron 2 liuba',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd liuba',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'semana ida liuba',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w liuba',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'semana 2 liuba',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w liuba',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'fulan ida liuba',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm liuba',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'fulan 2 liuba',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm liuba',
        // Carbon::now()->subYears(1)->diffForHumans()
        'tinan ida liuba',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y liuba',
        // Carbon::now()->subYears(2)->diffForHumans()
        'tinan 2 liuba',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y liuba',
        // Carbon::now()->addSecond()->diffForHumans()
        'iha minutu balun',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'iha s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'minutu balun',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'minutu 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'iha s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minutu ida minutu balun',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'semana ida oras 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'semana ida loron 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'semana ida loron 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'semana 2 oras ida',
    ];
}
