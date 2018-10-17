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

class ItTest extends LocalizationTestCase
{
    const LOCALE = 'it'; // Italian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Domani alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sabato alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'domenica alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lunedì alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martedì alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mercoledì alle 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'giovedì alle 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'venerdì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martedì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mercoledì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'giovedì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'venerdì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sabato alle 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'la scorsa domenica alle 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ieri alle 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Oggi alle 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Oggi alle 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Domani alle 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martedì alle 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Ieri alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ieri alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lo scorso martedì alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lo scorso lunedì alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'la scorsa domenica alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lo scorso sabato alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lo scorso venerdì alle 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'lo scorso giovedì alle 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'lo scorso mercoledì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lo scorso venerdì alle 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        ':1º :1º :1º :1º :1º',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2º :1º',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3º :1º',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4º :1º',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5º :1º',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6º :1º',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7º :1º',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11º :2º',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40º',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41º',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        ':100º',
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
        ':0º',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'alcuni secondi fa',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 secondo fa',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 secondi fa',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 secondi fa',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'un minuto fa',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minuto fa',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuti fa',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuti fa',
        // Carbon::now()->subHours(1)->diffForHumans()
        'un\'ora fa',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ora fa',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ore fa',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ore fa',
        // Carbon::now()->subDays(1)->diffForHumans()
        'un giorno fa',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 giorno fa',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 giorni fa',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 giorni fa',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 settimana fa',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 settimana fa',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 settimane fa',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 settimane fa',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'un mese fa',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mese fa',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mesi fa',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mesi fa',
        // Carbon::now()->subYears(1)->diffForHumans()
        'un anno fa',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 anno fa',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 anni fa',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 anni fa',
        // Carbon::now()->addSecond()->diffForHumans()
        'in alcuni secondi',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'tra 1 secondo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'alcuni secondi dopo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 secondo dopo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'alcuni secondi prima',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 secondo prima',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'alcuni secondi',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 secondo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 secondi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 secondi',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'tra 1 secondo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'un minuto alcuni secondi',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 anni 3 mesi 1 giorno 1 secondo',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'tra 3 anni',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mesi fa',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 anni 3 mesi 1 giorno 1 secondo fa',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 settimana 10 ore',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 settimana 6 giorni',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 settimana 6 giorni',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 settimane un\'ora',
        // CarbonInterval::days(2)->forHumans()
        '2 giorni',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 giorno 3 ore',
    ];
}
