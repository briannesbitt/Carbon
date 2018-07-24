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

class MeTest extends LocalizationTestCase
{
    const LOCALE = 'me';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošle subote u 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'u nedjelju u 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sjutra u 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'danas u 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'danas u 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'juče u 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'prošlog utorka u 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u utorak u 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u petak u 0:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'prije 1 sekund',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'prije 1 sekund',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'prije 2 sekunda',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'prije 2 sekunda',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'prije 1 minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'prije 1 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'prije 2 minuta',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'prije 2 minuta',
        // Carbon::now()->subHours(1)->diffForHumans()
        'prije 1 sat',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'prije 1 sat',
        // Carbon::now()->subHours(2)->diffForHumans()
        'prije 2 sata',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'prije 2 sata',
        // Carbon::now()->subDays(1)->diffForHumans()
        'prije 1 dan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'prije 1 dan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'prije 2 dana',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'prije 2 dana',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'prije 1 nedjelja',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'prije 1 nedjelja',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'prije 2 nedjelje',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'prije 2 nedjelje',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'prije 1 mjesec',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'prije 1 mjesec',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'prije 2 mjeseca',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'prije 2 mjeseca',
        // Carbon::now()->subYears(1)->diffForHumans()
        'prije 1 godina',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'prije 1 godina',
        // Carbon::now()->subYears(2)->diffForHumans()
        'prije 2 godine',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'prije 2 godine',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
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
        '2 godine 3 mjeseca 1 dan 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 nedjelja 10 sati',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedjelja 6 dana',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedjelja 6 dana',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 nedjelje 1 sat',
    ];
}
