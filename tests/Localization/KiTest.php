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

class KiTest extends LocalizationTestCase
{
    const LOCALE = 'ki'; // Kikuyu

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Njumamothi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kiumia at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Njumatatũ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Njumaine at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Njumatana at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Aramithi at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Njumaa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Njumaine at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Njumatana at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Aramithi at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Njumaa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Njumamothi at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Kiumia at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Njumaine at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Njumaine at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Njumatatũ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Kiumia at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Njumamothi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Njumaa at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Aramithi at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Njumatana at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Njumaa at 00:00',
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
        '12:00 kiroko CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Kiroko, 12:00 kiroko',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Kiroko, 1:30 kiroko',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Kiroko, 2:00 kiroko',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Kiroko, 6:00 kiroko',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Kiroko, 10:00 kiroko',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Hwaĩ-inĩ, 12:00 hwaĩ-inĩ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Hwaĩ-inĩ, 5:00 hwaĩ-inĩ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Hwaĩ-inĩ, 9:30 hwaĩ-inĩ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Hwaĩ-inĩ, 11:00 hwaĩ-inĩ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 igego ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 igego ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 igego ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 igego ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 mundu ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 mundu ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 mundu ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 mundu ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 thaa ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 thaa ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 thaa ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 thaa ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 mũthenya ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 mũthenya ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 mũthenya ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 mũthenya ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 kiumia ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 kiumia ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 kiumia ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 kiumia ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mweri ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mweri ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mweri ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mweri ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 mĩaka ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 mĩaka ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 mĩaka ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 mĩaka ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 igego from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 igego from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 igego after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 igego after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 igego before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 igego before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 igego',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 igego',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 igego',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 igego',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 igego from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 mundu 1 igego',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 mĩaka 3 mweri 1 mũthenya 1 igego',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 mĩaka from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mweri ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 mĩaka 3 mweri 1 mũthenya 1 igego ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 kiumia 10 thaa',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 kiumia 6 mũthenya',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 kiumia 6 mũthenya',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 kiumia and 6 mũthenya from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 kiumia 1 thaa',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 thaa from now',
        // CarbonInterval::days(2)->forHumans()
        '2 mũthenya',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 mũthenya 3 thaa',
    ];
}
