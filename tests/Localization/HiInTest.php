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
class HiInTest extends LocalizationTestCase
{
    public const LOCALE = 'hi_IN'; // Hindi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'कल रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शनिवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'रविवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'बुधवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'गुरूवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'शुक्रवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बुधवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'गुरूवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शनिवार, रात 12:00 बजे',
        // Carbon::now()->subDays(2)->calendar()
        'पिछले रविवार, रात 8:49 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'कल रात 10:00 बजे',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'आज दोपहर 10:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आज रात 2:00 बजे',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'कल रात 1:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'कल रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'कल रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले मंगलवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले सोमवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले रविवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले शनिवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'पिछले शुक्रवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'पिछले गुरूवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'पिछले बुधवार, रात 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'पिछले शुक्रवार, रात 12:00 बजे',
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
        '12:00 रात CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 रात, 12:00 रात',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 रात, 1:30 रात',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 रात, 2:00 रात',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 सुबह, 6:00 सुबह',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 दोपहर, 10:00 दोपहर',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 दोपहर, 12:00 दोपहर',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 शाम, 5:00 शाम',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 रात, 9:30 रात',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 रात, 11:00 रात',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
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
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 वर्ष में',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 महीने पहले',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 वर्षों 3 महीने 1 दिन 1 सेकंड पहले',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 10 घंटे',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताह 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 सप्ताह और 6 दिन में',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 सप्ताह एक घंटा',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'एक घंटा में',
        // CarbonInterval::days(2)->forHumans()
        '2 दिन',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 दिन 3 घंटे',
    ];
}
