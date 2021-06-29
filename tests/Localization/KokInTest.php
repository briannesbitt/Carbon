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
class KokInTest extends LocalizationTestCase
{
    public const LOCALE = 'kok_IN'; // Konkani

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शेनवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आयतार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगळवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'बुधवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'बेरेसतार at 12:00 म.पू.',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'शुकरार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगळवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बुधवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बेरेसतार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुकरार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शेनवार at 12:00 म.पू.',
        // Carbon::now()->subDays(2)->calendar()
        'Last आयतार at 8:49 म.नं.',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 म.नं.',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 म.पू.',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगळवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last मंगळवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सोमार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last आयतार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शेनवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शुकरार at 12:00 म.पू.',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last बेरेसतार at 12:00 म.पू.',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last बुधवार at 12:00 म.पू.',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last शुकरार at 12:00 म.पू.',
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
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 म.पू. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 म.पू., 12:00 म.पू.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 म.पू., 1:30 म.पू.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 म.पू., 2:00 म.पू.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 म.पू., 6:00 म.पू.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 म.पू., 10:00 म.पू.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 म.नं., 12:00 म.नं.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 म.नं., 5:00 म.नं.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 म.नं., 9:30 म.नं.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 म.नं., 11:00 म.नं.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 तेंको ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 तेंको ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 तेंको ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 तेंको ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 नोंद ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 नोंद ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 नोंद ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 नोंद ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 घंते ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 घंते ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 घंते ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 घंते ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 दिवसु ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 दिवसु ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 दिवसु ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 दिवसु ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 आदित्यवार ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 आदित्यवार ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 आदित्यवार ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 आदित्यवार ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 मैनो ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 मैनो ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 मैनो ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 मैनो ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 वैशाकु ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 वैशाकु ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 वैशाकु ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 वैशाकु ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 तेंको from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 तेंको from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 तेंको after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 तेंको after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 तेंको before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 तेंको before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 तेंको',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 तेंको',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 तेंको',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 तेंको',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 तेंको from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 नोंद 1 तेंको',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 वैशाकु 3 मैनो 1 दिवसु 1 तेंको',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 वैशाकु from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 मैनो ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 वैशाकु 3 मैनो 1 दिवसु 1 तेंको ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 आदित्यवार 10 घंते',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 आदित्यवार 6 दिवसु',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 आदित्यवार 6 दिवसु',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 आदित्यवार and 6 दिवसु from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 आदित्यवार 1 घंते',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 घंते from now',
        // CarbonInterval::days(2)->forHumans()
        '2 दिवसु',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 दिवसु 3 घंते',
    ];
}
