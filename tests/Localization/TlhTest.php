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
class TlhTest extends LocalizationTestCase
{
    public const LOCALE = 'tlh'; // Klingon

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wa’leS 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '6 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '7 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '8 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '9 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '10 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '11 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '12 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '9 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '10 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '11 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '12 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '13 tera’ jar wa’ 2018 00:00',
        // Carbon::now()->subDays(2)->calendar()
        '13 tera’ jar vagh 2018 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wa’Hu’ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'DaHjaj 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'DaHjaj 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'wa’leS 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '9 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'wa’Hu’ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wa’Hu’ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '2 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '1 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '31 tera’ jar wa’maH cha’ 2017 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '30 tera’ jar wa’maH cha’ 2017 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '29 tera’ jar wa’maH cha’ 2017 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        '28 tera’ jar wa’maH cha’ 2017 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        '27 tera’ jar wa’maH cha’ 2017 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '5 tera’ jar wa’ 2018 00:00',
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
        'puS lup ret',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'puS lup ret',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 lup ret',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 lup ret',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'wa’ tup ret',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'wa’ tup ret',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 tup ret',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 tup ret',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wa’ rep ret',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'wa’ rep ret',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 rep ret',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 rep ret',
        // Carbon::now()->subDays(1)->diffForHumans()
        'wa’ Hu’',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'wa’ Hu’',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 Hu’',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 Hu’',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'wa’ hogh ret',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'wa’ hogh ret',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hogh ret',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 hogh ret',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'wa’ wen',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'wa’ wen',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 wen',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 wen',
        // Carbon::now()->subYears(1)->diffForHumans()
        'wa’ ben',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'wa’ ben',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ben',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ben',
        // Carbon::now()->addSecond()->diffForHumans()
        'puS lup pIq',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'puS lup pIq',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'puS lup',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'puS lup',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 lup',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 lup',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'puS lup pIq',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'wa’ tup puS lup',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 DIS 3 jar wa’ jaj puS lup',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 nem',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 wen',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ben 3 wen wa’ Hu’ puS lup',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'wa’ hogh 10 rep',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wa’ hogh 6 jaj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wa’ hogh 6 jaj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'wa’ hogh ’ej 6 leS',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hogh wa’ rep',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'wa’ rep pIq',
        // CarbonInterval::days(2)->forHumans()
        '2 jaj',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'wa’ jaj 3 rep',
    ];
}
