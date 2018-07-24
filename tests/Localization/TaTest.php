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

class TaTest extends LocalizationTestCase
{
    const LOCALE = 'ta'; // Tamil

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் சனிக்கிழமை, 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ஞாயிற்றுக்கிழமை, 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'நாளை 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'இன்று 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'இன்று 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'நேற்று 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'கடந்த வாரம் செவ்வாய்கிழமை, 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'செவ்வாய்கிழமை, 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'வெள்ளிக்கிழமை, 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ஒரு சில விநாடிகள் முன்',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's முன்',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 விநாடிகள் முன்',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's முன்',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ஒரு நிமிடம் முன்',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min முன்',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 நிமிடங்கள் முன்',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min முன்',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ஒரு மணி நேரம் முன்',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h முன்',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 மணி நேரம் முன்',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h முன்',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ஒரு நாள் முன்',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd முன்',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 நாட்கள் முன்',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd முன்',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ஒரு வாரம் முன்',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w முன்',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 வாரங்கள் முன்',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w முன்',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ஒரு மாதம் முன்',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm முன்',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 மாதங்கள் முன்',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm முன்',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ஒரு வருடம் முன்',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y முன்',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ஆண்டுகள் முன்',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y முன்',
        // Carbon::now()->addSecond()->diffForHumans()
        'ஒரு சில விநாடிகள் இல்',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's இல்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ஒரு சில விநாடிகள்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 விநாடிகள்',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's இல்',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ஒரு நிமிடம் ஒரு சில விநாடிகள்',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ஒரு வாரம் 10 மணி நேரம்',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ஒரு வாரம் 6 நாட்கள்',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ஒரு வாரம் 6 நாட்கள்',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 வாரங்கள் ஒரு மணி நேரம்',
    ];
}
