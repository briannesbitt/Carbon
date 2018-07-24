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

class DeAtTest extends LocalizationTestCase
{
    const LOCALE = 'de_AT'; // German

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'letzten Samstag um 00:00 Uhr',
        // Carbon::now()->subDays(2)->calendar()
        'Sonntag um 20:49 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'morgen um 22:00 Uhr',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'heute um 10:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'heute um 02:00 Uhr',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'gestern um 01:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'letzten Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dienstag um 00:00 Uhr',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freitag um 00:00 Uhr',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'vor 1 Sekunde',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'vor 1Sek',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'vor 2 Sekunden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'vor 2Sek',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'vor 1 Minute',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'vor 1Min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'vor 2 Minuten',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'vor 2Min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'vor 1 Stunde',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'vor 1Std',
        // Carbon::now()->subHours(2)->diffForHumans()
        'vor 2 Stunden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'vor 2Std',
        // Carbon::now()->subDays(1)->diffForHumans()
        'vor 1 Tag',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'vor 1Tg',
        // Carbon::now()->subDays(2)->diffForHumans()
        'vor 2 Tagen',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'vor 2Tg',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'vor 1 Woche',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'vor 1Wo',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'vor 2 Wochen',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'vor 2Wo',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'vor 1 Monat',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'vor 1Mon',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'vor 2 Monaten',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'vor 2Mon',
        // Carbon::now()->subYears(1)->diffForHumans()
        'vor 1 Jahr',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'vor 1J',
        // Carbon::now()->subYears(2)->diffForHumans()
        'vor 2 Jahren',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'vor 2J',
        // Carbon::now()->addSecond()->diffForHumans()
        'in 1 Sekunde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'in 1Sek',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Sekunde später',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1Sek später',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Sekunde zuvor',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1Sek zuvor',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekunde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1Sek',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekunden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2Sek',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'in 1Sek',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minute 1 Sekunde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2J 3Mon 1Tg 1Sek',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Woche 10 Stunden',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woche 6 Tage',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woche 6 Tage',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Wochen 1 Stunde',
    ];
}
