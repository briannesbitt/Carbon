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

class OmKeTest extends LocalizationTestCase
{
    const LOCALE = 'om_KE'; // Oromo

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sanbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dilbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wiixata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Roobii at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kamiisa at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jimaata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Roobii at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kamiisa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jimaata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sanbata at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Dilbata at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Qibxata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Wiixata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Dilbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sanbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jimaata at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Kamiisa at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Roobii at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Jimaata at 00:00',
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
        '12:00 wd cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 WD, 12:00 wd',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 WD, 1:30 wd',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 WD, 2:00 wd',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 WD, 6:00 wd',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 WD, 10:00 wd',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 WB, 12:00 wb',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 WB, 5:00 wb',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 WB, 9:30 wb',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 WB, 11:00 wb',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 abba ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 abba ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 abba ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 abba ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 sa&#039;aatii ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 sa&#039;aatii ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 sa&#039;aatii ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 sa&#039;aatii ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 sa&#039;aatii ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 sa&#039;aatii ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 sa&#039;aatii ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 sa&#039;aatii ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 aduu ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 aduu ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 aduu ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 aduu ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 Dilbata ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 Dilbata ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 Dilbata ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 Dilbata ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 Month ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 Month ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 Month ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 Month ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 Class ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 Class ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 Class ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 Class ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 abba from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 abba from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 abba after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 abba after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 abba before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 abba before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 abba',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 abba',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 abba',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 abba',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 abba from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 sa&#039;aatii 1 abba',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 Class 3 Month 1 aduu 1 abba',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 Class from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 Month ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 Class 3 Month 1 aduu 1 abba ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Dilbata 10 sa&#039;aatii',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Dilbata 6 aduu',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Dilbata 6 aduu',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 Dilbata and 6 aduu from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Dilbata 1 sa&#039;aatii',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 sa&#039;aatii from now',
        // CarbonInterval::days(2)->forHumans()
        '2 aduu',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 aduu 3 sa&#039;aatii',
    ];
}
