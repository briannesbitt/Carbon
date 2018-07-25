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

class GuTest extends LocalizationTestCase
{
    const LOCALE = 'gu'; // Gujarati

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ગઇકાલે રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા શનિવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા રવિવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા સોમવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા મંગળવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા બુધ્વાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'પાછલા ગુરુવાર, રાત 12:00 વાગ્યે',
        // Carbon::now()->subDays(2)->calendar()
        'રવિવાર, રાત 8:49 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'કાલે રાત 10:00 વાગ્યે',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'આજ બપોર 10:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'આજ રાત 2:00 વાગ્યે',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ગઇકાલે રાત 1:00 વાગ્યે',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'પાછલા મંગળવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'કાલે રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'મંગળવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'સોમવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'રવિવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'શનિવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'શુક્રવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ગુરુવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'શુક્રવાર, રાત 12:00 વાગ્યે',
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
        '12:00 રાત, 12:00 રાત',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 રાત, 1:30 રાત',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 રાત, 2:00 રાત',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 સવાર, 6:00 સવાર',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 બપોર, 10:00 બપોર',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 બપોર, 12:00 બપોર',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 સાંજ, 5:00 સાંજ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 રાત, 11:00 રાત',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ordinal',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'અમુક પળો પેહલા',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1સે. પેહલા',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 સેકંડ પેહલા',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2સે. પેહલા',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'એક મિનિટ પેહલા',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1મિ. પેહલા',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 મિનિટ પેહલા',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2મિ. પેહલા',
        // Carbon::now()->subHours(1)->diffForHumans()
        'એક કલાક પેહલા',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1ક. પેહલા',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 કલાક પેહલા',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2ક. પેહલા',
        // Carbon::now()->subDays(1)->diffForHumans()
        'એક દિવસ પેહલા',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1દિ. પેહલા',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 દિવસ પેહલા',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2દિ. પેહલા',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 અઠવાડિયું પેહલા',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1અઠ. પેહલા',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 અઠવાડિયા પેહલા',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2અઠ. પેહલા',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'એક મહિનો પેહલા',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1મહિનો પેહલા',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 મહિનો પેહલા',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2મહિના પેહલા',
        // Carbon::now()->subYears(1)->diffForHumans()
        'એક વર્ષ પેહલા',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1વર્ષ પેહલા',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 વર્ષ પેહલા',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2વર્ષો પેહલા',
        // Carbon::now()->addSecond()->diffForHumans()
        'અમુક પળો મા',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1સે. મા',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'અમુક પળો પછી',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1સે. પછી',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'અમુક પળો પહેલા',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1સે. પહેલા',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'અમુક પળો',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1સે.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 સેકંડ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2સે.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1સે. મા',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'એક મિનિટ અમુક પળો',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2વર્ષો 3મહિના 1દિ. 1સે.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 અઠવાડિયું 10 કલાક',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 અઠવાડિયું 6 દિવસ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 અઠવાડિયું 6 દિવસ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 અઠવાડિયા એક કલાક',
    ];
}
