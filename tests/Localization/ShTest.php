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

class ShTest extends LocalizationTestCase
{
    const LOCALE = 'sh'; // SerboCroatian

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
        'pre 1 sekund',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'pre 1 sekund',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'pre 2 sekunda',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'pre 2 sekunda',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'pre 1 minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'pre 1 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'pre 2 minuta',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'pre 2 minuta',
        // Carbon::now()->subHours(1)->diffForHumans()
        'pre 1 čas',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'pre 1 čas',
        // Carbon::now()->subHours(2)->diffForHumans()
        'pre 2 časa',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'pre 2 časa',
        // Carbon::now()->subDays(1)->diffForHumans()
        'pre 1 dan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'pre 1 dan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'pre 2 dana',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'pre 2 dana',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'pre 1 nedelja',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'pre 1 nedelja',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'pre 2 nedelje',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'pre 2 nedelje',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'pre 1 mesec',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'pre 1 mesec',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'pre 2 meseca',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'pre 2 meseca',
        // Carbon::now()->subYears(1)->diffForHumans()
        'pre 1 godina',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'pre 1 godina',
        // Carbon::now()->subYears(2)->diffForHumans()
        'pre 2 godine',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'pre 2 godine',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'nakon 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'nakon 1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund raniјe',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund raniјe',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunda',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 godine 3 meseca 1 dan 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 nedelja 10 časova',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dana',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dana',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 nedelje 1 čas',
    ];
}
