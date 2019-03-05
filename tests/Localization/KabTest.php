<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Localization;

class KabTest extends LocalizationTestCase
{
    const LOCALE = 'kab';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sed at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Acer at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Arim at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ahad at 12:00 FT',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Amhad at 12:00 FT',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Sem at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ahad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Amhad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sem at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sed at 12:00 FT',
        // Carbon::now()->subDays(2)->calendar()
        'Last Acer at 8:49 MD',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 MD',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 FT',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Aram at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Arim at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Acer at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sed at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sem at 12:00 FT',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Amhad at 12:00 FT',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Ahad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Sem at 12:00 FT',
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
        '12:00 ft cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 FT, 12:00 ft',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 FT, 1:30 ft',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 FT, 2:00 ft',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 FT, 6:00 ft',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 FT, 10:00 ft',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 MD, 12:00 md',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 MD, 5:00 md',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 MD, 9:30 md',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 MD, 11:00 md',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 deg ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 deg ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 deg ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 deg ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 tamrilt ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 tamrilt ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 tamrilt ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 tamrilt ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 tamrilt ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 tamrilt ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 tamrilt ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 tamrilt ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 nekk ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 nekk ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 nekk ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 nekk ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 d-itteddun ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 d-itteddun ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 d-itteddun ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 d-itteddun ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ayyur ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ayyur ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ayyur ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ayyur ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 aseggas ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 aseggas ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 aseggas ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 aseggas ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 deg from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 deg from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 deg after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 deg after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 deg before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 deg before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 deg',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 deg',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 deg',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 deg',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 deg from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 tamrilt 1 deg',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 aseggas 3 ayyur 1 nekk 1 deg',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 aseggas from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ayyur ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 aseggas 3 ayyur 1 nekk 1 deg ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 d-itteddun 10 tamrilt',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 d-itteddun 6 nekk',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 d-itteddun 6 nekk',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 d-itteddun and 6 nekk from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 d-itteddun 1 tamrilt',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 tamrilt from now',
        // CarbonInterval::days(2)->forHumans()
        '2 nekk',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 nekk 3 tamrilt',
    ];
}
