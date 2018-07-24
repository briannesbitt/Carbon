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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'પાછલા શનિવાર, રાત 12:00 વાગ્યે',
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
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'મંગળવાર, રાત 12:00 વાગ્યે',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'શુક્રવાર, રાત 12:00 વાગ્યે',
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
