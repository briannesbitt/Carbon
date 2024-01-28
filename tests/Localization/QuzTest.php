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
class QuzTest extends LocalizationTestCase
{
    public const LOCALE = 'quz'; // Cusco Quechua

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sawatu at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tuminku at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lunis at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martis at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'miyirkulis at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'juywis at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'wiyirnis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'miyirkulis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'juywis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiyirnis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sawatu at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last tuminku at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martis at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last martis at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last lunis at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last tuminku at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sawatu at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last wiyirnis at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last juywis at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last miyirkulis at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last wiyirnis at 12:00 AM',
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
        '1 iskay ñiqin ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 iskay ñiqin ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 iskay ñiqin ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 iskay ñiqin ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 uchuy ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 uchuy ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 uchuy ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 uchuy ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ura ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ura ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ura ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ura ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 pʼunchaw ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 pʼunchaw ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 pʼunchaw ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 pʼunchaw ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 simana ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 simana ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 simana ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 simana ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 killa ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 killa ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 killa ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 killa ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 wata ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 wata ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 wata ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 wata ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 iskay ñiqin from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 iskay ñiqin from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 iskay ñiqin after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 iskay ñiqin after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 iskay ñiqin before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 iskay ñiqin before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 iskay ñiqin',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 iskay ñiqin',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 iskay ñiqin',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 iskay ñiqin',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 iskay ñiqin from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 uchuy 1 iskay ñiqin',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 wata 3 killa 1 pʼunchaw 1 iskay ñiqin',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 wata from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 killa ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 wata 3 killa 1 pʼunchaw 1 iskay ñiqin ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 simana 10 ura',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 simana 6 pʼunchaw',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 simana 6 pʼunchaw',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 simana and 6 pʼunchaw from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 simana 1 ura',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ura from now',
        // CarbonInterval::days(2)->forHumans()
        '2 pʼunchaw',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 pʼunchaw 3 ura',
    ];
}
