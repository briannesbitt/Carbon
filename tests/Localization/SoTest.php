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

class SoTest extends LocalizationTestCase
{
    const LOCALE = 'so'; // Somali

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabti at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Axad at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Isniin at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Salaaso at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Arbaco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Khamiis at 12:00 subaxnimo',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jimco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Salaaso at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Arbaco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Khamiis at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jimco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabti at 12:00 subaxnimo',
        // Carbon::now()->subDays(2)->calendar()
        'Last Axad at 8:49 galabnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 galabnimo',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 subaxnimo',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Salaaso at 12:00 subaxnimo',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Salaaso at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Isniin at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Axad at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sabti at 12:00 subaxnimo',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jimco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Khamiis at 12:00 subaxnimo',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Arbaco at 12:00 subaxnimo',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Jimco at 12:00 subaxnimo',
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
        '6th 2nd',
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
        '12:00 subaxnimo CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 subaxnimo, 12:00 subaxnimo',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 subaxnimo, 1:30 subaxnimo',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 subaxnimo, 2:00 subaxnimo',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 subaxnimo, 6:00 subaxnimo',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 subaxnimo, 10:00 subaxnimo',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 galabnimo, 12:00 galabnimo',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 galabnimo, 5:00 galabnimo',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 galabnimo, 9:30 galabnimo',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 galabnimo, 11:00 galabnimo',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ilbiriqsi ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ilbiriqsi ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ilbiriqsi ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ilbiriqsi ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 daqiiqad ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 daqiiqad ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 daqiiqad ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 daqiiqad ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 saacad ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 saacad ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 saacad ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 saacad ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 maalin ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 maalin ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 maalin ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 maalin ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 todobaad ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 todobaad ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 todobaad ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 todobaad ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 Bilaha ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 Bilaha ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 Bilaha ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 Bilaha ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 sanad ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 sanad ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 sanad ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 sanad ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ilbiriqsi from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ilbiriqsi from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ilbiriqsi after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ilbiriqsi after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ilbiriqsi before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ilbiriqsi before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ilbiriqsi',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ilbiriqsi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ilbiriqsi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ilbiriqsi',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ilbiriqsi from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 daqiiqad 1 ilbiriqsi',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 sanad 3 Bilaha 1 maalin 1 ilbiriqsi',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 sanad from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 Bilaha ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 sanad 3 Bilaha 1 maalin 1 ilbiriqsi ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 todobaad 10 saacad',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 todobaad 6 maalin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 todobaad 6 maalin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 todobaad and 6 maalin from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 todobaad 1 saacad',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 saacad from now',
        // CarbonInterval::days(2)->forHumans()
        '2 maalin',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 maalin 3 saacad',
    ];
}
