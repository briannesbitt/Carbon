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

class DvMvTest extends LocalizationTestCase
{
    const LOCALE = 'dv_MV'; // Divehi

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ފާއިތުވި ހޮނިހިރު 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'އާދިއްތަ 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'މާދަމާ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'މިއަދު 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'މިއަދު 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'އިއްޔެ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ފާއިތުވި އަންގާރަ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'އަންގާރަ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ހުކުރު 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ސިކުންތު ކުރިން',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ސިކުންތު ކުރިން',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ސިކުންތު ކުރިން',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ސިކުންތު ކުރިން',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 މިނެޓް ކުރިން',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 މިނެޓް ކުރިން',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 މިނެޓް ކުރިން',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 މިނެޓް ކުރިން',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ގަޑި ކުރިން',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ގަޑި ކުރިން',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ގަޑި ކުރިން',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ގަޑި ކުރިން',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ދުވަސް ކުރިން',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ދުވަސް ކުރިން',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ދުވަސް ކުރިން',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ދުވަސް ކުރިން',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ހަފްތާ ކުރިން',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ހަފްތާ ކުރިން',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ހަފްތާ ކުރިން',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ހަފްތާ ކުރިން',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 މަސް ކުރިން',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 މަސް ކުރިން',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 މަސް ކުރިން',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 މަސް ކުރިން',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 އަހަރު ކުރިން',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 އަހަރު ކުރިން',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 އަހަރު ކުރިން',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 އަހަރު ކުރިން',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ސިކުންތު ފަހުން',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ސިކުންތު ފަހުން',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ސިކުންތު ފަހުން',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ސިކުންތު ފަހުން',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ސިކުންތު ކުރި',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ސިކުންތު ކުރި',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ސިކުންތު',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ސިކުންތު',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ސިކުންތު',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ސިކުންތު',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ސިކުންތު ފަހުން',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 މިނެޓް 1 ސިކުންތު',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 އަހަރު 3 މަސް 1 ދުވަސް 1 ސިކުންތު',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ހަފްތާ 10 ގަޑި',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ހަފްތާ 6 ދުވަސް',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ހަފްތާ 6 ދުވަސް',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ހަފްތާ 1 ގަޑި',
    ];
}
