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

class HiTest extends LocalizationTestCase
{
    const LOCALE = 'hi'; // Hindi

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले शनिवार, रात 12:00 बजे',
        // Carbon::now()->subDays(2)->calendar()
        'रविवार, रात 8:49 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'कल रात 10:00 बजे',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'आज दोपहर 10:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आज रात 2:00 बजे',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'कल रात 1:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'पिछले मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवार, रात 12:00 बजे',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'कुछ ही क्षण पहले',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 सेकंड पहले',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 सेकंड पहले',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 सेकंड पहले',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'एक मिनट पहले',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 मिनट पहले',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 मिनट पहले',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 मिनटों पहले',
        // Carbon::now()->subHours(1)->diffForHumans()
        'एक घंटा पहले',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 घंटा पहले',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 घंटे पहले',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 घंटे पहले',
        // Carbon::now()->subDays(1)->diffForHumans()
        'एक दिन पहले',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 दिन पहले',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 दिन पहले',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 दिनों पहले',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 सप्ताह पहले',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 सप्ताह पहले',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 सप्ताह पहले',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 सप्ताह पहले',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'एक महीने पहले',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 माह पहले',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 महीने पहले',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 महीने पहले',
        // Carbon::now()->subYears(1)->diffForHumans()
        'एक वर्ष पहले',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 वर्ष पहले',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 वर्ष पहले',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 वर्षों पहले',
        // Carbon::now()->addSecond()->diffForHumans()
        'कुछ ही क्षण में',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 सेकंड में',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'कुछ ही क्षण के बाद',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 सेकंड के बाद',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'कुछ ही क्षण के पहले',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 सेकंड के पहले',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'कुछ ही क्षण',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 सेकंड',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 सेकंड',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 सेकंड',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 सेकंड में',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'एक मिनट कुछ ही क्षण',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 वर्षों 3 महीने 1 दिन 1 सेकंड',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 10 घंटे',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 6 दिन',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 सप्ताह एक घंटा',
    ];
}
