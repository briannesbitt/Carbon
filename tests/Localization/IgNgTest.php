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
class IgNgTest extends LocalizationTestCase
{
    public const LOCALE = 'ig_NG'; // Igbo

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'satọde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sọnde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mọnde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tuzde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wenzde at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'tọsde at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'fraịde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tuzde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wenzde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tọsde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fraịde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'satọde at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last sọnde at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tuzde at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last tuzde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last mọnde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sọnde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last satọde at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last fraịde at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last tọsde at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last wenzde at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last fraịde at 12:00 AM',
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
        'sekọnd 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'sekọnd 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'sekọnd 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'sekọnd 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'minit 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'minit 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'minit 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'minit 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'awa 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'awa 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'awa 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'awa 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ụbọchị 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ụbọchị 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ụbọchị 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ụbọchị 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'izu 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'izu 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'izu 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'izu 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'önwa 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'önwa 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'önwa 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'önwa 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'afo 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'afo 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'afo 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'afo 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'sekọnd 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sekọnd 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'sekọnd 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'sekọnd 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'sekọnd 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'sekọnd 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sekọnd 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'sekọnd 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'sekọnd 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'sekọnd 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sekọnd 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minit 1 sekọnd 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'afo 2 önwa 3 ụbọchị 1 sekọnd 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'afo 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'önwa 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'afo 2 önwa 3 ụbọchị 1 sekọnd 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'izu 1 awa 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'izu 1 ụbọchị 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'izu 1 ụbọchị 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'izu 1 and ụbọchị 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'izu 2 awa 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'awa 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'ụbọchị 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ụbọchị 1 awa 3',
    ];
}
