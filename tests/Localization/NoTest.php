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

class NoTest extends LocalizationTestCase
{
    const LOCALE = 'no'; // Norwegian

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
        '1 sekund siden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekund siden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekunder siden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minutt siden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutt siden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutter siden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minutter siden',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 time siden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 time siden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timer siden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 timer siden',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dag siden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dag siden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dager siden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dager siden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uke siden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 uke siden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uker siden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 uker siden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 måned siden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 måned siden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 måneder siden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 måneder siden',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 år siden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 år siden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år siden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 år siden',
        // Carbon::now()->addSecond()->diffForHumans()
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekund etter',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekund etter',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund før',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund før',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutt 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 måneder 1 dag 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uke 10 timer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uker 1 time',
    ];
}
