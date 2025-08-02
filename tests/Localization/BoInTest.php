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
        'སྐར་ཆ1 སྔན་ལ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'སྐར་ཆ1 སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'སྐར་ཆ2 སྔན་ལ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'སྐར་ཆ2 སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'སྐར་མ་1 སྔན་ལ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'སྐར་མ་1 སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'སྐར་མ་2 སྔན་ལ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'སྐར་མ་2 སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ཆུ་ཚོད1 སྔན་ལ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ཆུ་ཚོད1 སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ཆུ་ཚོད2 སྔན་ལ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ཆུ་ཚོད2 སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ཉིན1་ སྔན་ལ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ཉིན1་ སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ཉིན2་ སྔན་ལ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ཉིན2་ སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'གཟའ་འཁོར་1 སྔན་ལ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'གཟའ་འཁོར་1 སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'གཟའ་འཁོར་2 སྔན་ལ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'གཟའ་འཁོར་2 སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ཟླ་བ1 སྔན་ལ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ཟླ་བ1 སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ཟླ་བ2 སྔན་ལ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ཟླ་བ2 སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ལོ1 སྔན་ལ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ལོ1 སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ལོ2 སྔན་ལ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ལོ2 སྔན་ལ',
        // Carbon::now()->addSecond()->diffForHumans()
        'སྐར་ཆ1 ལ་',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'སྐར་ཆ1 ལ་',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'སྐར་ཆ1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'སྐར་ཆ1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'སྐར་ཆ2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'སྐར་ཆ2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'སྐར་ཆ1 ལ་',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'སྐར་མ་1 སྐར་ཆ1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'ལོ2 ཟླ་བ3 ཉིན1་ སྐར་ཆ1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ལོ3 ལ་',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ཟླ་བ5 སྔན་ལ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ལོ2 ཟླ་བ3 ཉིན1་ སྐར་ཆ1 སྔན་ལ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'གཟའ་འཁོར་1 ཆུ་ཚོད10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'གཟའ་འཁོར་1 ཉིན6་',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'གཟའ་འཁོར་1 ཉིན6་',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'གཟའ་འཁོར་1 ཨནད་ ཉིན6་ ལ་',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'གཟའ་འཁོར་2 ཆུ་ཚོད1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ཆུ་ཚོད་གཅིག ལ་',
        // CarbonInterval::days(2)->forHumans()
        'ཉིན2་',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ཉིན1་ ཆུ་ཚོད3',
    ];
}
