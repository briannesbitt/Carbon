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
class CyTest extends LocalizationTestCase
{
    public const LOCALE = 'cy'; // Welsh

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yfory am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Sadwrn am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Sul am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Llun am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Mawrth am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Mercher am 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Dydd Iau am 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Dydd Gwener am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Mawrth am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Mercher am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Iau am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Gwener am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Sadwrn am 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Dydd Sul diwethaf am 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ddoe am 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Heddiw am 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Heddiw am 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Yfory am 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Mawrth am 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Ddoe am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ddoe am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Mawrth diwethaf am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Llun diwethaf am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Sul diwethaf am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Sadwrn diwethaf am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Gwener diwethaf am 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Dydd Iau diwethaf am 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Dydd Mercher diwethaf am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Gwener diwethaf am 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1af 1af 1af 1af 1af',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2il 1af',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3ydd 1af',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4ydd 1af',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5ed 1af',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6ed 1af',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7ed 1af',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11eg 2il',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40fed',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41ain',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100fed',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 yb CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 yb, 12:00 yb',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 yb, 1:30 yb',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 yb, 2:00 yb',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 yb, 6:00 yb',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 yb, 10:00 yb',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 yh, 12:00 yh',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 yh, 5:00 yh',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 yh, 9:30 yh',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 yh, 11:00 yh',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 eiliad yn ôl',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s yn ôl',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 eiliad yn ôl',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s yn ôl',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 munud yn ôl',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m yn ôl',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 munud yn ôl',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m yn ôl',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 awr yn ôl',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1h yn ôl',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 awr yn ôl',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2h yn ôl',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 diwrnod yn ôl',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d yn ôl',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 diwrnod yn ôl',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d yn ôl',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 wythnos yn ôl',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1w yn ôl',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 wythnos yn ôl',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2w yn ôl',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mis yn ôl',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mi yn ôl',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mis yn ôl',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mi yn ôl',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 flwyddyn yn ôl',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1bl yn ôl',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 flynedd yn ôl',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2bl yn ôl',
        // Carbon::now()->addSecond()->diffForHumans()
        'mewn 1 eiliad',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'mewn 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 eiliad ar ôl',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s ar ôl',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 eiliad o\'r blaen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s o\'r blaen',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 eiliad',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 eiliad',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'mewn 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 munud 1 eiliad',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2bl 3mi 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'mewn 3 flynedd',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5mi yn ôl',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2bl 3mi 1d 1s yn ôl',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 wythnos 10 awr',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wythnos 6 diwrnod',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wythnos 6 diwrnod',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'mewn 1 wythnos a 6 diwrnod',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wythnos 1 awr',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'mewn awr',
        // CarbonInterval::days(2)->forHumans()
        '2 diwrnod',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3h',
    ];
}
