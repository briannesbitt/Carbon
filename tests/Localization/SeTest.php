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

class SeTest extends LocalizationTestCase
{
    const LOCALE = 'se'; // NorthernSami

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ihttin ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lávvardat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sotnabeaivi ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'vuossárga ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'maŋŋebárga ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'duorastat ti 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'bearjadat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'maŋŋebárga ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'duorastat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'bearjadat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lávvardat ti 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ovddit sotnabeaivi ti 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ikte ti 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'otne ti 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'otne ti 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ihttin ti 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'maŋŋebárga ti 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ikte ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ikte ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit maŋŋebárga ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit vuossárga ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit sotnabeaivi ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit lávvardat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit bearjadat ti 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ovddit duorastat ti 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ovddit gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ovddit bearjadat ti 00:00',
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
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'maŋit moadde sekunddat',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'maŋit moadde sekunddat',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'maŋit 2 sekunddat',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'maŋit 2 sekunddat',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'maŋit okta minuhta',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'maŋit okta minuhta',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'maŋit 2 minuhtat',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'maŋit 2 minuhtat',
        // Carbon::now()->subHours(1)->diffForHumans()
        'maŋit okta diimmu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'maŋit okta diimmu',
        // Carbon::now()->subHours(2)->diffForHumans()
        'maŋit 2 diimmut',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'maŋit 2 diimmut',
        // Carbon::now()->subDays(1)->diffForHumans()
        'maŋit okta beaivi',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'maŋit okta beaivi',
        // Carbon::now()->subDays(2)->diffForHumans()
        'maŋit 2 beaivvit',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'maŋit 2 beaivvit',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'maŋit okta vahkku',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'maŋit okta vahkku',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'maŋit 2 vahkku',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'maŋit 2 vahkku',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'maŋit okta mánnu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'maŋit okta mánnu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'maŋit 2 mánut',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'maŋit 2 mánut',
        // Carbon::now()->subYears(1)->diffForHumans()
        'maŋit okta jahki',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'maŋit okta jahki',
        // Carbon::now()->subYears(2)->diffForHumans()
        'maŋit 2 jagit',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'maŋit 2 jagit',
        // Carbon::now()->addSecond()->diffForHumans()
        'moadde sekunddat geažes',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'moadde sekunddat geažes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'moadde sekunddat',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'moadde sekunddat',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunddat',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunddat',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'moadde sekunddat geažes',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'okta minuhta moadde sekunddat',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 jagit 3 mánut okta beaivi moadde sekunddat',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 jagit geažes',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'maŋit 5 mánut',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'maŋit 2 jagit 3 mánut okta beaivi moadde sekunddat',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'okta vahkku 10 diimmut',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'okta vahkku 6 beaivvit',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'okta vahkku 6 beaivvit',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 vahkku okta diimmu',
        // CarbonInterval::days(2)->forHumans()
        '2 beaivvit',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'okta beaivi 3 diimmut',
    ];
}
