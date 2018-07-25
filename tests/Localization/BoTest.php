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

class BoTest extends LocalizationTestCase
{
    const LOCALE = 'bo'; // Tibetan

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་སྤེན་པ་, མཚན་མོ 12:00',
        // Carbon::now()->subDays(2)->calendar()
        'བདུན་ཕྲག་རྗེས་མ, མཚན་མོ 8:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'སང་ཉིན མཚན་མོ 10:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'དི་རིང ཉིན་གུང 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'དི་རིང མཚན་མོ 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ཁ་སང མཚན་མོ 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་མིག་དམར་, མཚན་མོ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, མཚན་མོ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, མཚན་མོ 12:00',
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
        '12:00 མཚན་མོ, 12:00 མཚན་མོ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 མཚན་མོ, 1:30 མཚན་མོ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 མཚན་མོ, 2:00 མཚན་མོ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ཞོགས་ཀས, 6:00 ཞོགས་ཀས',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ཉིན་གུང, 10:00 ཉིན་གུང',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ཉིན་གུང, 12:00 ཉིན་གུང',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 དགོང་དག, 5:00 དགོང་དག',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 མཚན་མོ, 11:00 མཚན་མོ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ལམ་སང སྔན་ལ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 སྐར་ཆ། སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'སྐར་མ་གཅིག སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 སྐར་མ སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ཆུ་ཚོད་གཅིག སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ཆུ་ཚོད སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ཉིན་གཅིག སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ཉིན་ སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ཟླ་བ་གཅིག སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ཟླ་བ སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ལོ་གཅིག སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ལོ སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y སྔན་ལ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ལམ་སང ལ་',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's ལ་',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ལམ་སང',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 སྐར་ཆ།',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's ལ་',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'སྐར་མ་གཅིག ལམ་སང',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 10 ཆུ་ཚོད',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 6 ཉིན་',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 6 ཉིན་',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 བདུན་ཕྲག ཆུ་ཚོད་གཅིག',
    ];
}
