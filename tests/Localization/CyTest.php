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

class CyTest extends LocalizationTestCase
{
    const LOCALE = 'cy'; // Welsh

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Sadwrn diwethaf am 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Dydd Sul am 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yfory am 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Heddiw am 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Heddiw am 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ddoe am 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Mawrth diwethaf am 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dydd Mawrth am 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dydd Gwener am 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ychydig eiliadau yn ôl',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s yn ôl',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 eiliad yn ôl',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s yn ôl',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'munud yn ôl',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m yn ôl',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 munud yn ôl',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m yn ôl',
        // Carbon::now()->subHours(1)->diffForHumans()
        'awr yn ôl',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1h yn ôl',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 awr yn ôl',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2h yn ôl',
        // Carbon::now()->subDays(1)->diffForHumans()
        'diwrnod yn ôl',
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
        'mis yn ôl',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mi yn ôl',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mis yn ôl',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mi yn ôl',
        // Carbon::now()->subYears(1)->diffForHumans()
        'blwyddyn yn ôl',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1bl yn ôl',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 flynedd yn ôl',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2bl yn ôl',
        // Carbon::now()->addSecond()->diffForHumans()
        'mewn ychydig eiliadau',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'mewn 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'ychydig eiliadau ar ôl',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s ar ôl',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'ychydig eiliadau o\'r blaen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s o\'r blaen',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ychydig eiliadau',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 eiliad',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'mewn 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'munud ychydig eiliadau',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2bl 3mi 1d 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 wythnos 10 awr',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wythnos 6 diwrnod',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wythnos 6 diwrnod',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wythnos awr',
    ];
}
