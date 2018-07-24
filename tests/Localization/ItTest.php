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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lo scorso sabato alle 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'domenica alle 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Domani alle 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Oggi alle 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Oggi alle 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'lo scorso venerdì alle 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lo scorso martedì alle 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martedì alle 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'venerdì alle 00:00',
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
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 settimana 10 ore',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 settimana 6 giorni',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 settimana 6 giorni',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 settimane un\'ora',
    ];
}
