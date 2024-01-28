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
class LiNlTest extends LocalizationTestCase
{
    public const LOCALE = 'li_NL'; // Limburgish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'zaoterdig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'zóndig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'maondig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'daensdig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'goonsdig at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'dónderdig at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'vriedig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'daensdig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'goonsdig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dónderdig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vriedig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'zaoterdig at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last zóndig at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'daensdig at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last daensdig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last maondig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last zóndig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last zaoterdig at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last vriedig at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last dónderdig at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last goonsdig at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last vriedig at 12:00 AM',
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
        '1 Secónd ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 Secónd ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 Secónd ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 Secónd ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 momênt ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 momênt ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 momênt ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 momênt ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 oer ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 oer ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oer ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 oer ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 daag ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 daag ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 daag ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 daag ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 waek ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 waek ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 waek ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 waek ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 maond ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 maond ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 maond ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 maond ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 jaor ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 jaor ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jaor ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 jaor ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 Secónd from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 Secónd from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Secónd after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 Secónd after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Secónd before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 Secónd before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Secónd',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 Secónd',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Secónd',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 Secónd',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 Secónd from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 momênt 1 Secónd',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 jaor 3 maond 1 daag 1 Secónd',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 jaor from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 maond ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 jaor 3 maond 1 daag 1 Secónd ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 waek 10 oer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 waek 6 daag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 waek 6 daag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 waek and 6 daag from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 waek 1 oer',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 oer from now',
        // CarbonInterval::days(2)->forHumans()
        '2 daag',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 daag 3 oer',
    ];
}
