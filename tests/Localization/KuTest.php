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
class KuTest extends LocalizationTestCase
{
    public const LOCALE = 'ku'; // Kurdish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM'
        'Tomorrow at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM'
        'şemî at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM'
        'yekşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM'
        'duşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'sêşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'çarşem at 12:00 AM',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM'
        'pêncşem at 12:00 AM',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM'
        'în at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'sêşem at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'çarşem at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM'
        'pêncşem at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM'
        'în at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM'
        'şemî at 12:00 AM',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM'
        'Last yekşem at 8:49 PM',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM'
        'Yesterday at 10:00 PM',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM'
        'Today at 10:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM'
        'Today at 2:00 AM',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM'
        'Tomorrow at 1:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'sêşem at 12:00 AM',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'Yesterday at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'Yesterday at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM'
        'Last sêşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM'
        'Last duşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM'
        'Last yekşem at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM'
        'Last şemî at 12:00 AM',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'Last în at 12:00 AM',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM'
        'Last pêncşem at 12:00 AM',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM'
        'Last çarşem at 12:00 AM',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'Last în at 12:00 AM',

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
        '6 2',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 1st'
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
        '12:00 am CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am'
        '12:00 AM, 12:00 am',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am'
        '1:30 AM, 1:30 am',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am'
        '2:00 AM, 2:00 am',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am'
        '6:00 AM, 6:00 am',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am'
        '10:00 AM, 10:00 am',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm'
        '12:00 PM, 12:00 pm',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm'
        '5:00 PM, 5:00 pm',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm'
        '9:30 PM, 9:30 pm',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm'
        '11:00 PM, 11:00 pm',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th'
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago'
        'berî 1 saniye',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago'
        'berî 1 saniye',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago'
        'berî 2 saniye',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago'
        'berî 2 saniye',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago'
        'berî 1 deqîqe',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago'
        'berî 1 deqîqe',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago'
        'berî 2 deqîqe',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago'
        'berî 2 deqîqe',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago'
        'berî 1 saet',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago'
        'berî 1 saet',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago'
        'berî 2 saet',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago'
        'berî 2 saet',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago'
        'berî 1 roj',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago'
        'berî 1 roj',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago'
        'berî 2 roj',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago'
        'berî 2 roj',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago'
        'berî 1 hefte',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago'
        'berî 1 hefte',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago'
        'berî 2 hefte',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago'
        'berî 2 hefte',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago'
        'berî 1 meh',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago'
        'berî 1 meh',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago'
        'berî 2 meh',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago'
        'berî 2 meh',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago'
        'berî 1 salê',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago'
        'berî 1 salê',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago'
        'berî 2 salan',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago'
        'berî 2 salan',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now'
        'di 1 saniye de',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now'
        'di 1 saniye de',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after'
        '1 saniye piştî',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after'
        '1 saniye piştî',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before'
        '1 saniye berê',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before'
        '1 saniye berê',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second'
        '1 saniye',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s'
        '1 saniye',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds'
        '2 saniye',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s'
        '2 saniye',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now'
        'di 1 saniye de',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second'
        '1 deqîqe 1 saniye',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s'
        '2 sal 3 meh 1 roj 1 saniye',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now'
        'di 3 salan de',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago'
        'berî 5 meh',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago'
        'berî 2 salan 3 meh 1 roj 1 saniye',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours'
        '1 hefte 10 saet',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 hefte 6 roj',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 hefte 6 roj',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now'
        'di 1 hefte û 6 roj de',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour'
        '2 hefte 1 saet',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now'
        'di 1 saet de',

        // CarbonInterval::days(2)->forHumans()
        // '2 days'
        '2 roj',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h'
        '1 roj 3 saet',
    ];
}
