<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

class YoTest extends LocalizationTestCase
{
    const LOCALE = 'yo'; // Yoruba

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ọ̀la ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àbámẹ́ta Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àìkú Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ajé Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ìsẹ́gun Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ọjọ́rú Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Ọjọ́bọ Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Ẹtì Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ìsẹ́gun Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ọjọ́rú Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ọjọ́bọ Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ẹtì Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Àbámẹ́ta Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Àìkú Ọsẹ̀ tólọ́ ni 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àna ni 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Ònì ni 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ònì ni 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ọ̀la ni 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ìsẹ́gun Ọsẹ̀ tón\'bọ ni 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Àna ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àna ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ìsẹ́gun Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ajé Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àìkú Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àbámẹ́ta Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ẹtì Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Ọjọ́bọ Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Ọjọ́rú Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ẹtì Ọsẹ̀ tólọ́ ni 12:00 AM',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ọjọ́ :1 ọjọ́ :1 ọjọ́ :1 ọjọ́ :1 ọjọ́ :1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :2 ọjọ́ :1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :3 ọjọ́ :1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :4 ọjọ́ :1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :5 ọjọ́ :1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :6 ọjọ́ :1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :7 ọjọ́ :1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ọjọ́ :11 ọjọ́ :2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ọjọ́ :40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ọjọ́ :41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ọjọ́ :100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am cet',
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
        'ọjọ́ :0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ìsẹjú aayá die kọjá',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's kọjá',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'aayá 2 kọjá',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's kọjá',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ìsẹjú kan kọjá',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min kọjá',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ìsẹjú 2 kọjá',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min kọjá',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wákati kan kọjá',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h kọjá',
        // Carbon::now()->subHours(2)->diffForHumans()
        'wákati 2 kọjá',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h kọjá',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ọjọ́ kan kọjá',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd kọjá',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ọjọ́ 2 kọjá',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd kọjá',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ọsẹ kan kọjá',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w kọjá',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ọsẹ 2 kọjá',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w kọjá',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'osù kan kọjá',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm kọjá',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'osù 2 kọjá',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm kọjá',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ọdún kan kọjá',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y kọjá',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ọdún 2 kọjá',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y kọjá',
        // Carbon::now()->addSecond()->diffForHumans()
        'ní ìsẹjú aayá die',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ní s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ìsẹjú aayá die',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'aayá 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ní s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ìsẹjú kan ìsẹjú aayá die',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ní ọdún 3',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'm kọjá',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'y m d s kọjá',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ọsẹ kan wákati 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ọsẹ kan ọjọ́ 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ọsẹ kan ọjọ́ 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'ọsẹ 2 wákati kan',
        // CarbonInterval::days(2)->forHumans()
        'ọjọ́ 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ọjọ́ kan wákati 3',
    ];
}
