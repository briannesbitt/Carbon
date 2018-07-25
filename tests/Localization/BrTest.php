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

class BrTest extends LocalizationTestCase
{
    const LOCALE = 'br'; // Breton

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sadorn paset da 12e00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sul da 8e49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Warc\'hoazh da 10e00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hiziv da 10e00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hiziv da 2e00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Dec\'h da 1e00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Meurzh paset da 12e00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Meurzh da 12e00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Gwener da 12e00 AM',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        '1añ 1añ',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2vet 1añ',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3vet 1añ',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4vet 1añ',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5vet 1añ',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6vet 1añ',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7vet 2vet',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11vet 2vet',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40vet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41vet',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'un nebeud segondennoù \'zo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 eilenn \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ur vunutenn \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 vunutenn \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min \'zo',
        // Carbon::now()->subHours(1)->diffForHumans()
        'un eur \'zo',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h \'zo',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 eur \'zo',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h \'zo',
        // Carbon::now()->subDays(1)->diffForHumans()
        'un devezh \'zo',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd \'zo',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 zevezh \'zo',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 sizhun \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 sizhun \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ur miz \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 viz \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm \'zo',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 bloaz \'zo',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y \'zo',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 vloaz \'zo',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y \'zo',
        // Carbon::now()->addSecond()->diffForHumans()
        'a-benn un nebeud segondennoù',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'a-benn s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'un nebeud segondennoù',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 eilenn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'a-benn s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ur vunutenn un nebeud segondennoù',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sizhun 10 eur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sizhun un eur',
    ];
}
