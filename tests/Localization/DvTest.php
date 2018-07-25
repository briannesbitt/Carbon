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

class DvTest extends LocalizationTestCase
{
    const LOCALE = 'dv'; // Divehi

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
        '12:00 މކ, 12:00 މކ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 މކ, 1:30 މކ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 މކ, 2:00 މކ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 މކ, 6:00 މކ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 މކ, 10:00 މކ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 މފ, 12:00 މފ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 މފ, 5:00 މފ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 މފ, 11:00 މފ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ކުރިން ސިކުންތުކޮޅެއް',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ކުރިން s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ކުރިން d% ސިކުންތު',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ކުރިން s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ކުރިން މިނިޓެއް',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ކުރިން min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ކުރިން މިނިޓު 2',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ކުރިން min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ކުރިން ގަޑިއިރެއް',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ކުރިން h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ކުރިން ގަޑިއިރު 2',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ކުރިން h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ކުރިން ދުވަހެއް',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ކުރިން d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ކުރިން ދުވަސް 2',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ކުރިން d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ކުރިން ހަފްތާ 1',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ކުރިން w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ކުރިން ހަފްތާ 2',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ކުރިން w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ކުރިން މަހެއް',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ކުރިން m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ކުރިން މަސް 2',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ކުރިން m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ކުރިން އަހަރެއް',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ކުރިން y',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ކުރިން އަހަރު 2',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ކުރިން y',
        // Carbon::now()->addSecond()->diffForHumans()
        'ތެރޭގައި ސިކުންތުކޮޅެއް',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ތެރޭގައި s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'ސިކުންތުކޮޅެއް ފަހުން',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        's ފަހުން',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'ސިކުންތުކޮޅެއް ކުރި',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        's ކުރި',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ސިކުންތުކޮޅެއް',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'd% ސިކުންތު',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ތެރޭގައި s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'މިނިޓެއް ސިކުންތުކޮޅެއް',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ހަފްތާ 1 ގަޑިއިރު 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ހަފްތާ 1 ދުވަސް 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ހަފްތާ 1 ދުވަސް 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'ހަފްތާ 2 ގަޑިއިރެއް',
    ];
}
