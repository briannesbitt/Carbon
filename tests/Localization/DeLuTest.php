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

use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class DeLuTest extends LocalizationTestCase
{
    public const LOCALE = 'de_LU'; // German

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'morgen um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Samstag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sonntag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Montag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mittwoch um 00:00 Uhr',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Donnerstag um 00:00 Uhr',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Freitag um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mittwoch um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Donnerstag um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freitag um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Samstag um 00:00 Uhr',
        // Carbon::now()->subDays(2)->calendar()
        'letzten Sonntag um 20:49 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gestern um 22:00 Uhr',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'heute um 10:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'heute um 02:00 Uhr',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'morgen um 01:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'gestern um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gestern um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Montag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Sonntag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Samstag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Freitag um 00:00 Uhr',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'letzten Donnerstag um 00:00 Uhr',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'letzten Mittwoch um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'letzten Freitag um 00:00 Uhr',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1. 1. 1. 1. 1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2. 1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3. 1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4. 1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5. 1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6. 1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7. 1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11. 2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100.',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am CET',
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
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'vor 1 Sekunde',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'vor 1 Sek.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'vor 2 Sekunden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'vor 2 Sek.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'vor 1 Minute',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'vor 1 Min.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'vor 2 Minuten',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'vor 2 Min.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'vor 1 Stunde',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'vor 1 Std.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'vor 2 Stunden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'vor 2 Std.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'vor 1 Tag',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'vor 1 Tg.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'vor 2 Tagen',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'vor 2 Tg.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'vor 1 Woche',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'vor 1 Wo.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'vor 2 Wochen',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'vor 2 Wo.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'vor 1 Monat',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'vor 1 Mon.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'vor 2 Monaten',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'vor 2 Mon.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'vor 1 Jahr',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'vor 1 J.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'vor 2 Jahren',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'vor 2 J.',
        // Carbon::now()->addSecond()->diffForHumans()
        'in 1 Sekunde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'in 1 Sek.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Sekunde später',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 Sek. später',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Sekunde zuvor',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 Sek. zuvor',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekunde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 Sek.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekunden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 Sek.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'in 1 Sek.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minute 1 Sekunde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 J. 3 Mon. 1 Tg. 1 Sek.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'in 3 Jahren',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'vor 5 Mon.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'vor 2 J. 3 Mon. 1 Tg. 1 Sek.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Woche 10 Stunden',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woche 6 Tage',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woche 6 Tage',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'in 1 Woche und 6 Tagen',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Wochen 1 Stunde',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'in eine Stunde',
        // CarbonInterval::days(2)->forHumans()
        '2 Tage',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 Tg. 3 Std.',
    ];
}
