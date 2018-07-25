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

class ElTest extends LocalizationTestCase
{
    const LOCALE = 'el'; // Greek

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'το προηγούμενο Σάββατο {} 12:00 ΠΜ',
        // Carbon::now()->subDays(2)->calendar()
        'Κυριακή {} 8:49 ΜΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Αύριο {} 10:00 ΜΜ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Σήμερα {} 10:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Σήμερα {} 2:00 ΠΜ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Χθες {} 1:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'την προηγούμενη Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Παρασκευή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        ':1η :1η',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2η :1η',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3η :1η',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4η :1η',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5η :1η',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6η :1η',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7η :2η',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11η :2η',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40η',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41η',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ΠΜ, 12:00 πμ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ΠΜ, 1:30 πμ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ΠΜ, 2:00 πμ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ΠΜ, 6:00 πμ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ΠΜ, 10:00 πμ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ΜΜ, 12:00 μμ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ΜΜ, 5:00 μμ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ΜΜ, 11:00 μμ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'λίγα δευτερόλεπτα πριν',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 δευτερόλεπτο πριν',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 δευτερόλεπτα πριν',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 δευτερόλεπτα πριν',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ένα λεπτό πριν',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 λεπτό πριν',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 λεπτά πριν',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 λεπτά πριν',
        // Carbon::now()->subHours(1)->diffForHumans()
        'μία ώρα πριν',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ώρα πριν',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ώρες πριν',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ώρες πριν',
        // Carbon::now()->subDays(1)->diffForHumans()
        'μία μέρα πριν',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 μέρα πριν',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 μέρες πριν',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 μέρες πριν',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 εβδομάδα πριν',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 εβδομάδα πριν',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 εβδομάδες πριν',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 εβδομάδες πριν',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ένας μήνας πριν',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 μήνας πριν',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 μήνες πριν',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 μήνες πριν',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ένας χρόνος πριν',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 χρόνος πριν',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 χρόνια πριν',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 χρόνια πριν',
        // Carbon::now()->addSecond()->diffForHumans()
        'σε λίγα δευτερόλεπτα',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'σε 1 δευτερόλεπτο',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'λίγα δευτερόλεπτα μετά',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 δευτερόλεπτο μετά',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'λίγα δευτερόλεπτα πριν',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 δευτερόλεπτο πριν',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'λίγα δευτερόλεπτα',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 δευτερόλεπτο',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 δευτερόλεπτα',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 δευτερόλεπτα',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'σε 1 δευτερόλεπτο',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ένα λεπτό λίγα δευτερόλεπτα',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 χρόνια 3 μήνες 1 μέρα 1 δευτερόλεπτο',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 10 ώρες',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 6 μέρες',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 6 μέρες',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 εβδομάδες μία ώρα',
    ];
}
