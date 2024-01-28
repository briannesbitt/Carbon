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
class TsZaTest extends LocalizationTestCase
{
    public const LOCALE = 'ts_ZA'; // Tsonga

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mugqivela at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sonto at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Musumbhunuku at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ravumbirhi at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ravunharhu at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Ravumune at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Ravuntlhanu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ravumbirhi at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ravunharhu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ravumune at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ravuntlhanu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mugqivela at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sonto at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ravumbirhi at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ravumbirhi at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Musumbhunuku at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sonto at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mugqivela at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ravuntlhanu at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Ravumune at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Ravunharhu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Ravuntlhanu at 12:00 AM',
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
        'tisekoni ta 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'tisekoni ta 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'tisekoni ta 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'tisekoni ta 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'timinete ta 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'timinete ta 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'timinete ta 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'timinete ta 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'tiawara ta 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'tiawara ta 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'tiawara ta 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'tiawara ta 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'masiku 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'masiku 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'masiku 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'masiku 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'mavhiki ya 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'mavhiki ya 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'mavhiki ya 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'mavhiki ya 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'tin’hweti ta 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'tin’hweti ta 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'tin’hweti ta 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'tin’hweti ta 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'malembe ya 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'malembe ya 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'malembe ya 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'malembe ya 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'tisekoni ta 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'tisekoni ta 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'tisekoni ta 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'tisekoni ta 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'tisekoni ta 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'tisekoni ta 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'tisekoni ta 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'tisekoni ta 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'tisekoni ta 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'tisekoni ta 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'tisekoni ta 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'timinete ta 1 tisekoni ta 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'malembe ya 2 tin’hweti ta 3 masiku 1 tisekoni ta 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'malembe ya 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'tin’hweti ta 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'malembe ya 2 tin’hweti ta 3 masiku 1 tisekoni ta 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'mavhiki ya 1 tiawara ta 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'mavhiki ya 1 masiku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'mavhiki ya 1 masiku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'mavhiki ya 1 and masiku 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'mavhiki ya 2 tiawara ta 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'tiawara ta 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'masiku 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'masiku 1 tiawara ta 3',
    ];
}
