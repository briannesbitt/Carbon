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

class PsTest extends LocalizationTestCase
{
    const LOCALE = 'ps'; // Pashto

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Saturday at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sunday at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Yesterday at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Friday at 12:00 AM',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ثانيه دمخه',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1ثانيه دمخه',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ثانيې دمخه',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2ثانيې دمخه',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 دقيقه دمخه',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1دقيقه دمخه',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 دقيقې دمخه',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2دقيقې دمخه',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ساعت دمخه',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1ساعت دمخه',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ساعته دمخه',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2ساعته دمخه',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ورځ دمخه',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1ورځ دمخه',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ورځي دمخه',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2ورځي دمخه',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 اونۍ دمخه',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1اونۍ دمخه',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 اونۍ دمخه',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2اونۍ دمخه',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 مياشت دمخه',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1مياشت دمخه',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 مياشتي دمخه',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2مياشتي دمخه',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 کال دمخه',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1کال دمخه',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 کاله دمخه',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2کاله دمخه',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ثانيه له اوس څخه',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1ثانيه له اوس څخه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ثانيه وروسته',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1ثانيه وروسته',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ثانيه دمخه',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1ثانيه دمخه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ثانيه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1ثانيه',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ثانيې',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2ثانيې',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1ثانيه له اوس څخه',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 دقيقه 1 ثانيه',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2کاله 3مياشتي 1ورځ 1ثانيه',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 اونۍ 10 ساعته',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 اونۍ 6 ورځي',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 اونۍ 6 ورځي',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 اونۍ 1 ساعت',
    ];
}
