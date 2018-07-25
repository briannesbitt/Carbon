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

class MrTest extends LocalizationTestCase
{
    const LOCALE = 'mr'; // Marathi

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'काल रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील शनिवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील रविवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील सोमवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील मंगळवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील बुधवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'मागील गुरूवार, रात्री 12:00 वाजता',
        // Carbon::now()->subDays(2)->calendar()
        'रविवार, रात्री 8:49 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'उद्या रात्री 10:00 वाजता',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'आज दुपारी 10:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आज रात्री 2:00 वाजता',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'काल रात्री 1:00 वाजता',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मागील मंगळवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'उद्या रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगळवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'रविवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शनिवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शुक्रवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'गुरूवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ordinal ordinal ordinal ordinal ordinal',
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
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 रात्री, 12:00 रात्री',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 रात्री, 1:30 रात्री',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 रात्री, 2:00 रात्री',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 सकाळी, 6:00 सकाळी',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 दुपारी, 10:00 दुपारी',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 दुपारी, 12:00 दुपारी',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 सायंकाळी, 5:00 सायंकाळी',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 रात्री, 11:00 रात्री',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ordinal',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 सेकंदपूर्वी',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 सेकंदपूर्वी',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 सेकंदपूर्वी',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 सेकंदपूर्वी',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 मिनिटेपूर्वी',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 मिनिटेपूर्वी',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 मिनिटेपूर्वी',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 मिनिटेपूर्वी',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 तासपूर्वी',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 तासपूर्वी',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 तासपूर्वी',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 तासपूर्वी',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 दिवसपूर्वी',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 दिवसपूर्वी',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 दिवसपूर्वी',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 दिवसपूर्वी',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 आठवडापूर्वी',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 आठवडापूर्वी',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 आठवडेपूर्वी',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 आठवडेपूर्वी',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 महिनापूर्वी',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 महिनापूर्वी',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 महिनेपूर्वी',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 महिनेपूर्वी',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 वर्षपूर्वी',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 वर्षपूर्वी',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 वर्षपूर्वी',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 वर्षपूर्वी',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 सेकंदमध्ये',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 सेकंदमध्ये',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 सेकंद',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 सेकंद',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 सेकंद',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 सेकंद',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 सेकंदमध्ये',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 मिनिटे 1 सेकंद',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 वर्ष 3 महिने 1 दिवस 1 सेकंद',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 आठवडा 10 तास',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 आठवडा 6 दिवस',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 आठवडा 6 दिवस',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 आठवडे 1 तास',
    ];
}
