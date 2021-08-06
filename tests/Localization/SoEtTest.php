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
class SoEtTest extends LocalizationTestCase
{
    public const LOCALE = 'so_ET'; // Somali

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Beri markay tahay 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabti markay tahay 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Axad markay tahay 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Isniin markay tahay 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Talaada markay tahay 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Arbaca markay tahay 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Khamiis markay tahay 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jimce markay tahay 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Talaada markay tahay 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Arbaca markay tahay 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Khamiis markay tahay 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jimce markay tahay 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabti markay tahay 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Hore Axad Markay ahayd 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Shalay markay ahayd 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Maanta markay tahay 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Maanta markay tahay 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Beri markay tahay 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Talaada markay tahay 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Shalay markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Shalay markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hore Talaada Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hore Isniin Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hore Axad Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hore Sabti Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hore Jimce Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Hore Khamiis Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Hore Arbaca Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Hore Jimce Markay ahayd 12:00 AM',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 2',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
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
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ilbidhiqsi kahor',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1il kahor',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ilbidhiqsi kahor',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2il kahor',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 daqiiqo kahor',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1dq kahor',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 daqiiqo kahor',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2dq kahor',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 saac kahor',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1sc kahor',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 saac kahor',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2sc kahor',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 maalin kahor',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1ml kahor',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 maalmood kahor',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2ml kahor',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 isbuuc kahor',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1is kahor',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 isbuuc kahor',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2is kahor',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 bil kahor',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1bil kahor',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 bilood kahor',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2bil kahor',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 sanad kahor',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1sn kahor',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 sanadood kahor',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2sn kahor',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ilbidhiqsi gudahood',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1il gudahood',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ilbidhiqsi kedib',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1il kedib',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ilbidhiqsi kahor',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1il kahor',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ilbidhiqsi',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1il',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ilbidhiqsi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2il',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1il gudahood',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 daqiiqo 1 ilbidhiqsi',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2sn 3bil 1ml 1il',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 sanadood gudahood',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5bil kahor',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2sn 3bil 1ml 1il kahor',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 isbuuc 10 saac',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 isbuuc 6 maalmood',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 isbuuc 6 maalmood',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 isbuuc and 6 maalmood gudahood',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 isbuuc 1 saac',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'saacad gudahood',
        // CarbonInterval::days(2)->forHumans()
        '2 maalmood',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1ml 3sc',
    ];
}
