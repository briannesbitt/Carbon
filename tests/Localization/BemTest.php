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
class BemTest extends LocalizationTestCase
{
    public const LOCALE = 'bem'; // Bemba

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Pachibelushi at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Pa Mulungu at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Palichimo at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Palichibuli at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Palichitatu at 12:00 uluchelo',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Palichine at 12:00 uluchelo',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Palichisano at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Palichibuli at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Palichitatu at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Palichine at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Palichisano at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Pachibelushi at 12:00 uluchelo',
        // Carbon::now()->subDays(2)->calendar()
        'Last Pa Mulungu at 8:49 akasuba',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 akasuba',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 uluchelo',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Palichibuli at 12:00 uluchelo',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Palichibuli at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Palichimo at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Pa Mulungu at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Pachibelushi at 12:00 uluchelo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Palichisano at 12:00 uluchelo',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Palichine at 12:00 uluchelo',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Palichitatu at 12:00 uluchelo',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Palichisano at 12:00 uluchelo',
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
        '12:00 uluchelo CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 uluchelo, 12:00 uluchelo',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 uluchelo, 1:30 uluchelo',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 uluchelo, 2:00 uluchelo',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 uluchelo, 6:00 uluchelo',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 uluchelo, 10:00 uluchelo',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 akasuba, 12:00 akasuba',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 akasuba, 5:00 akasuba',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 akasuba, 9:30 akasuba',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 akasuba, 11:00 akasuba',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'sekondi 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'sekondi 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'sekondi 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'sekondi 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'miniti 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'miniti 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'miniti 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'miniti 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'awala 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'awala 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'awala 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'awala 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'inshiku 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'inshiku 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'inshiku 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'inshiku 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'umulungu 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'umulungu 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'umulungu 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'umulungu 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'myeshi 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'myeshi 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'myeshi 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'myeshi 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'myaka 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'myaka 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'myaka 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'myaka 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'sekondi 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sekondi 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'sekondi 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'sekondi 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'sekondi 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'sekondi 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sekondi 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'sekondi 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'sekondi 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'sekondi 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sekondi 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'miniti 1 sekondi 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'myaka 2 myeshi 3 inshiku 1 sekondi 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'myaka 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'myeshi 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'myaka 2 myeshi 3 inshiku 1 sekondi 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'umulungu 1 awala 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'umulungu 1 inshiku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'umulungu 1 inshiku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'umulungu 1 and inshiku 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'umulungu 2 awala 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'awala 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'inshiku 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'inshiku 1 awala 3',
    ];
}
