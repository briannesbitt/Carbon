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

use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class VoTest extends LocalizationTestCase
{
    public const LOCALE = 'vo'; // Volapuk

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Saturday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sunday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Monday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tuesday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wednesday at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Thursday at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Friday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tuesday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Wednesday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Thursday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Friday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Saturday at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sunday at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tuesday at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tuesday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Monday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sunday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Saturday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Friday at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Thursday at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Wednesday at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Friday at 00:00',
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
        '12:00 am CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekun ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekun ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekun ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekun ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minut ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minut ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minut ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minut ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 düp ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 düp ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 düp ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 düp ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 del ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 del ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 del ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 del ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 vig ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 vig ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 vig ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 vig ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mul ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mul ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mul ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mul ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 yel ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 yel ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 yel ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 yel ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekun from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 sekun from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekun after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekun after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekun before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekun before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekun',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekun',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekun',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekun',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 sekun from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekun',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 yel 3 mul 1 del 1 sekun',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 yel from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mul ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 yel 3 mul 1 del 1 sekun ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vig 10 düp',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vig 6 del',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vig 6 del',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 vig and 6 del from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 vig 1 düp',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 düp from now',
        // CarbonInterval::days(2)->forHumans()
        '2 del',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 del 3 düp',
    ];
}
