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

/**
 * @group localization
 */
class LuTest extends LocalizationTestCase
{
    public const LOCALE = 'lu'; // Luba-Katanga

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Samschdeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sonndeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Méindeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dënschdeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mëttwoch at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Donneschdeg at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Freideg at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dënschdeg at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mëttwoch at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Donneschdeg at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freideg at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Samschdeg at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sonndeg at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dënschdeg at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Dënschdeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Méindeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sonndeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Samschdeg at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Freideg at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Donneschdeg at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Mëttwoch at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Freideg at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 dinda CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Dinda, 12:00 dinda',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Dinda, 1:30 dinda',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Dinda, 2:00 dinda',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Dinda, 6:00 dinda',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Dinda, 10:00 dinda',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Dilolo, 12:00 dilolo',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Dilolo, 5:00 dilolo',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Dilolo, 9:30 dilolo',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Dilolo, 11:00 dilolo',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'virun 1 Sekonn',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'virun 1s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'virun 2 Sekonn',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'virun 2s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'virun 1 Minutt',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'virun 1m',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'virun 2 Minutt',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'virun 2m',
        // Carbon::now()->subHours(1)->diffForHumans()
        'virun 1 Stonn',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'virun 1h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'virun 2 Stonn',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'virun 2h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'virun 1 Dag',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'virun 1d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'virun 2 Dag',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'virun 2d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'virun 1 Wooch',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'virun 1w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'virun 2 Wooch',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'virun 2w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'virun 1 Mount',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'virun 1m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'virun 2 Mount',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'virun 2m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'virun 1 Joer',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'virun 1j',
        // Carbon::now()->subYears(2)->diffForHumans()
        'virun 2 Joer',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'virun 2j',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 Sekonn ab elo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1s ab elo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Sekonn virdrun',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s virdrun',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Sekonn dono',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s dono',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekonn',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekonn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1s ab elo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minutt 1 Sekonn',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2j 3m 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 Joer ab elo',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'virun 5m',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'virun 2j 3m 1d 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Wooch 10 Stonn',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Wooch 6 Dag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Wooch 6 Dag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 Wooch and 6 Dag ab elo',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Wooch 1 Stonn',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'eine Stonn ab elo',
        // CarbonInterval::days(2)->forHumans()
        '2 Dag',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3h',
    ];
}
