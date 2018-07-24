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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मागील शनिवार, रात्री 12:00 वाजता',
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
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगळवार, रात्री 12:00 वाजता',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवार, रात्री 12:00 वाजता',
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
