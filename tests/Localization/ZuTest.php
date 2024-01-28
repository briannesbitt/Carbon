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
class ZuTest extends LocalizationTestCase
{
    public const LOCALE = 'zu'; // Zulu

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'uMgqibelo at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'iSonto at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'uMsombuluko at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'uLwesibili at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'uLwesithathu at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'uLwesine at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'uLwesihlanu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uLwesibili at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uLwesithathu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uLwesine at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uLwesihlanu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uMgqibelo at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last iSonto at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'uLwesibili at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last uLwesibili at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last uMsombuluko at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last iSonto at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last uMgqibelo at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last uLwesihlanu at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last uLwesine at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last uLwesithathu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last uLwesihlanu at 12:00 AM',
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
        'imizuzwana engu-1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'imizuzwana engu-1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'imizuzwana engu-2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'imizuzwana engu-2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ngemizuzu engu-1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ngemizuzu engu-1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ngemizuzu engu-2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ngemizuzu engu-2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'amahora angu-1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'amahora angu-1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'amahora angu-2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'amahora angu-2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ezingaba ngu-1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ezingaba ngu-1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ezingaba ngu-2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ezingaba ngu-2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'lwamasonto angu-1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'lwamasonto angu-1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'lwamasonto angu-2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'lwamasonto angu-2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'izinyanga ezingu-1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'izinyanga ezingu-1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'izinyanga ezingu-2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'izinyanga ezingu-2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'kweminyaka engu-1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'kweminyaka engu-1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'kweminyaka engu-2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'kweminyaka engu-2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'imizuzwana engu-1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'imizuzwana engu-1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'imizuzwana engu-1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'imizuzwana engu-1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'imizuzwana engu-1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'imizuzwana engu-1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'imizuzwana engu-1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'imizuzwana engu-1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'imizuzwana engu-2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'imizuzwana engu-2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'imizuzwana engu-1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ngemizuzu engu-1 imizuzwana engu-1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'kweminyaka engu-2 izinyanga ezingu-3 ezingaba ngu-1 imizuzwana engu-1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'kweminyaka engu-3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'izinyanga ezingu-5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'kweminyaka engu-2 izinyanga ezingu-3 ezingaba ngu-1 imizuzwana engu-1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'lwamasonto angu-1 amahora angu-10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'lwamasonto angu-1 ezingaba ngu-6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'lwamasonto angu-1 ezingaba ngu-6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'lwamasonto angu-1 and ezingaba ngu-6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'lwamasonto angu-2 amahora angu-1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'amahora angu-1 from now',
        // CarbonInterval::days(2)->forHumans()
        'ezingaba ngu-2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ezingaba ngu-1 amahora angu-3',
    ];
}
