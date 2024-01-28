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
class ShTest extends LocalizationTestCase
{
    public const LOCALE = 'sh'; // Serbo Croatian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM'
        'Tomorrow at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM'
        'Subota at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM'
        'Nedelja at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM'
        'Ponedeljak at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'Utorak at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'Sreda at 00:00',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM'
        'Četvrtak at 00:00',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM'
        'Petak at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'Utorak at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'Sreda at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM'
        'Četvrtak at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM'
        'Petak at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM'
        'Subota at 00:00',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM'
        'Last Nedelja at 20:49',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM'
        'Yesterday at 22:00',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM'
        'Today at 10:00',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM'
        'Today at 02:00',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM'
        'Tomorrow at 01:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'Utorak at 00:00',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'Yesterday at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'Yesterday at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM'
        'Last Utorak at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM'
        'Last Ponedeljak at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM'
        'Last Nedelja at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM'
        'Last Subota at 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'Last Petak at 00:00',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM'
        'Last Četvrtak at 00:00',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM'
        'Last Sreda at 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'Last Petak at 00:00',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st'
        '1 1 1 1 1',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st'
        '2 1',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st'
        '3 1',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st'
        '4 1',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st'
        '5 1',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st'
        '6 1',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 2nd'
        '7 2',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd'
        '11 2',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th'
        '40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st'
        '41',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th'
        '100',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET'
        '12:00 pre podne CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am'
        '12:00 pre podne, 12:00 pre podne',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am'
        '1:30 pre podne, 1:30 pre podne',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am'
        '2:00 pre podne, 2:00 pre podne',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am'
        '6:00 pre podne, 6:00 pre podne',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am'
        '10:00 pre podne, 10:00 pre podne',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm'
        '12:00 po podne, 12:00 po podne',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm'
        '5:00 po podne, 5:00 po podne',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm'
        '9:30 po podne, 9:30 po podne',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm'
        '11:00 po podne, 11:00 po podne',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th'
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago'
        'pre 1 sekund',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago'
        'pre 1 s.',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago'
        'pre 2 sekunde',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago'
        'pre 2 s.',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago'
        'pre 1 minut',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago'
        'pre 1 min.',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago'
        'pre 2 minuta',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago'
        'pre 2 min.',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago'
        'pre 1 sat',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago'
        'pre 1 č.',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago'
        'pre 2 sata',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago'
        'pre 2 č.',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago'
        'pre 1 dan',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago'
        'pre 1 d.',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago'
        'pre 2 dana',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago'
        'pre 2 d.',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago'
        'pre 1 nedelja',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago'
        'pre 1 n.',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago'
        'pre 2 nedelje',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago'
        'pre 2 n.',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago'
        'pre 1 mesec',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago'
        'pre 1 m.',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago'
        'pre 2 meseca',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago'
        'pre 2 m.',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago'
        'pre 1 godina',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago'
        'pre 1 g.',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago'
        'pre 2 godine',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago'
        'pre 2 g.',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now'
        'za 1 sekund',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now'
        'za 1 s.',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after'
        'nakon 1 sekund',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after'
        'nakon 1 s.',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before'
        '1 sekund raniјe',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before'
        '1 s. raniјe',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second'
        '1 sekund',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s'
        '1 s.',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds'
        '2 sekunde',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s'
        '2 s.',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now'
        'za 1 s.',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second'
        '1 minut 1 sekund',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s'
        '2 g. 3 m. 1 d. 1 s.',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now'
        'za 3 godine',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago'
        'pre 5 m.',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago'
        'pre 2 g. 3 m. 1 d. 1 s.',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours'
        '1 nedelja 10 sati',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 nedelja 6 dana',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 nedelja 6 dana',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now'
        'za 1 nedelja i 6 dana',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour'
        '2 nedelje 1 sat',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now'
        'za 1 sat',

        // CarbonInterval::days(2)->forHumans()
        // '2 days'
        '2 dana',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h'
        '1 d. 3 č.',
    ];
}
