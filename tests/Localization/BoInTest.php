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
class BoInTest extends LocalizationTestCase
{
    public const LOCALE = 'bo_IN'; // Tibetan

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'སང་ཉིན 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::now()->subDays(2)->calendar()
        'བདུན་ཕྲག་མཐའ་མ གཟའ་ཉི་མ་, 8:49 ཕྱི་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ཁ་སང 10:00 ཕྱི་དྲོ་',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'དི་རིང 10:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'དི་རིང 2:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'སང་ཉིན 1:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་རྗེས་མ, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ཁ་སང 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ཁ་སང 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་མིག་དམར་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་ཟླ་བ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་ཉི་མ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་སྤེན་པ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་པ་སངས་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་ཕུར་བུ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་ལྷག་པ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'བདུན་ཕྲག་མཐའ་མ གཟའ་པ་སངས་, 12:00 སྔ་དྲོ་',
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
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 སྔ་དྲོ་ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 སྔ་དྲོ་, 12:00 སྔ་དྲོ་',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 སྔ་དྲོ་, 1:30 སྔ་དྲོ་',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 སྔ་དྲོ་, 2:00 སྔ་དྲོ་',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 སྔ་དྲོ་, 6:00 སྔ་དྲོ་',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 སྔ་དྲོ་, 10:00 སྔ་དྲོ་',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ཕྱི་དྲོ་, 12:00 ཕྱི་དྲོ་',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ཕྱི་དྲོ་, 5:00 ཕྱི་དྲོ་',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ཕྱི་དྲོ་, 9:30 ཕྱི་དྲོ་',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ཕྱི་དྲོ་, 11:00 ཕྱི་དྲོ་',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ལམ་སང སྔན་ལ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ལམ་སང སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 སྐར་ཆ། སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 སྐར་ཆ། སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'སྐར་མ་གཅིག སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'སྐར་མ་གཅིག སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 སྐར་མ སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 སྐར་མ སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ཆུ་ཚོད་གཅིག སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ཆུ་ཚོད་གཅིག སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ཆུ་ཚོད སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ཆུ་ཚོད སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ཉིན་གཅིག སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ཉིན་གཅིག སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ཉིན་ སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ཉིན་ སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 བདུན་ཕྲག སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ཟླ་བ་གཅིག སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ཟླ་བ་གཅིག སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ཟླ་བ སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ཟླ་བ སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ལོ་གཅིག སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ལོ་གཅིག སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ལོ སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ལོ སྔན་ལ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ལམ་སང ལ་',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ལམ་སང ལ་',
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
        'ལམ་སང',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 སྐར་ཆ།',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 སྐར་ཆ།',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ལམ་སང ལ་',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'སྐར་མ་གཅིག ལམ་སང',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ལོ 3 ཟླ་བ ཉིན་གཅིག ལམ་སང',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ལོ ལ་',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ཟླ་བ སྔན་ལ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ལོ 3 ཟླ་བ ཉིན་གཅིག ལམ་སང སྔན་ལ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 10 ཆུ་ཚོད',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 6 ཉིན་',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 བདུན་ཕྲག 6 ཉིན་',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 བདུན་ཕྲག ཨནད་ 6 ཉིན་ ལ་',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 བདུན་ཕྲག ཆུ་ཚོད་གཅིག',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ཆུ་ཚོད་གཅིག ལ་',
        // CarbonInterval::days(2)->forHumans()
        '2 ཉིན་',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ཉིན་གཅིག 3 ཆུ་ཚོད',
    ];
}
