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
class GdGbTest extends LocalizationTestCase
{
    public const LOCALE = 'gd_GB'; // ScottishGaelic

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'A-màireach aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Disathairne aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Didòmhnaich aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Diluain aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dimàirt aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Diciadain aig 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Diardaoin aig 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Dihaoine aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dimàirt aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Diciadain aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Diardaoin aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dihaoine aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Disathairne aig 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Didòmhnaich seo chaidh aig 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'An-dè aig 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'An-diugh aig 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'An-diugh aig 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'A-màireach aig 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dimàirt aig 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'An-dè aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'An-dè aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dimàirt seo chaidh aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Diluain seo chaidh aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Didòmhnaich seo chaidh aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Disathairne seo chaidh aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dihaoine seo chaidh aig 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Diardaoin seo chaidh aig 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Diciadain seo chaidh aig 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dihaoine seo chaidh aig 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1d 1d 1d 1d 1d',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2na 1d',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3mh 1d',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4mh 1d',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5mh 1d',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6mh 1d',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7mh 1d',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11mh 2na',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40mh',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41mh',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100mh',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 m CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 m, 12:00 m',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 m, 1:30 m',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 m, 2:00 m',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 m, 6:00 m',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 m, 10:00 m',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 f, 12:00 f',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 f, 5:00 f',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 f, 9:30 f',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 f, 11:00 f',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0mh',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'bho chionn 1 diogan',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'bho chionn 1 d.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'bho chionn 2 diogan',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'bho chionn 2 d.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'bho chionn 1 mionaidean',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'bho chionn 1 md.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'bho chionn 2 mionaidean',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'bho chionn 2 md.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'bho chionn 1 uairean',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'bho chionn 1 u.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'bho chionn 2 uairean',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'bho chionn 2 u.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'bho chionn 1 latha',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'bho chionn 1 l.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'bho chionn 2 latha',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'bho chionn 2 l.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'bho chionn 1 seachdainean',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'bho chionn 1 s.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'bho chionn 2 seachdainean',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'bho chionn 2 s.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'bho chionn 1 mìosan',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'bho chionn 1 ms.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'bho chionn 2 mìosan',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'bho chionn 2 ms.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'bho chionn 1 bliadhna',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'bho chionn 1 b.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'bho chionn 2 bliadhna',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'bho chionn 2 b.',
        // Carbon::now()->addSecond()->diffForHumans()
        'ann an 1 diogan',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ann an 1 d.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 diogan',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 d.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 diogan',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 d.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ann an 1 d.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 mionaidean 1 diogan',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 b. 3 ms. 1 l. 1 d.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ann an 3 bliadhna',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'bho chionn 5 ms.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'bho chionn 2 b. 3 ms. 1 l. 1 d.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 seachdainean 10 uairean',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seachdainean 6 latha',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seachdainean 6 latha',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ann an 1 seachdainean agus 6 latha',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 seachdainean 1 uairean',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ann an uair',
        // CarbonInterval::days(2)->forHumans()
        '2 latha',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 l. 3 u.',
    ];
}
