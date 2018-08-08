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

class CaTest extends LocalizationTestCase
{
    const LOCALE = 'ca'; // Catalan

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'demà a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dissabte a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'diumenge a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dilluns a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimarts a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimecres a les 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'dijous a les 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'divendres a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimarts a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimecres a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dijous a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'divendres a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dissabte a les 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'el diumenge passat a les 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ahir a les 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'avui a les 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'avui a les 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'demà a les 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimarts a les 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ahir a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ahir a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el dimarts passat a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el dilluns passat a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el diumenge passat a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el dissabte passat a les 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el divendres passat a les 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'el dijous passat a les 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'el dimecres passat a les 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'el divendres passat a les 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1r 1r 1r 1a 1a',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2n 1a',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3r 1a',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4t 1a',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5è 1a',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6è 1a',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7è 1a',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11è 2a',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40è',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41è',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100è',
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
        '0è',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'fa uns segons',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'fa 1 segon',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'fa 2 segons',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'fa 2 segons',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'fa un minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'fa 1 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'fa 2 minuts',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'fa 2 minuts',
        // Carbon::now()->subHours(1)->diffForHumans()
        'fa una hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'fa 1 hora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'fa 2 hores',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'fa 2 hores',
        // Carbon::now()->subDays(1)->diffForHumans()
        'fa un dia',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'fa 1 dia',
        // Carbon::now()->subDays(2)->diffForHumans()
        'fa 2 dies',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'fa 2 dies',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'fa 1 setmana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'fa 1 setmana',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'fa 2 setmanes',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'fa 2 setmanes',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'fa un mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'fa 1 mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'fa 2 mesos',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'fa 2 mesos',
        // Carbon::now()->subYears(1)->diffForHumans()
        'fa un any',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'fa 1 any',
        // Carbon::now()->subYears(2)->diffForHumans()
        'fa 2 anys',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'fa 2 anys',
        // Carbon::now()->addSecond()->diffForHumans()
        'd\'aquí uns segons',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'd\'aquí 1 segon',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'uns segons després',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 segon després',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'uns segons abans',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 segon abans',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'uns segons',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 segon',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segons',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segons',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'd\'aquí 1 segon',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'un minut uns segons',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 anys 3 mesos 1 dia 1 segon',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'd\'aquí 3 anys',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'fa 5 mesos',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'fa 2 anys 3 mesos 1 dia 1 segon',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 setmana 10 hores',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 setmana 6 dies',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 setmana 6 dies',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 setmanes una hora',
        // CarbonInterval::days(2)->forHumans()
        '2 dies',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dia 3 hores',
    ];
}
