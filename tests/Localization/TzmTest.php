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
class TzmTest extends LocalizationTestCase
{
    public const LOCALE = 'tzm'; // Tamazight

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴽⴰ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⴹⵢⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴰⵎⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵢⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⴽⵔⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ⴰⴽⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ⴰⵙⵉⵎⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⴽⵔⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⴽⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵎⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⴹⵢⴰⵙ ⴴ 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ⴰⵙⴰⵎⴰⵙ ⴴ 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵚⴰⵏⵜ ⴴ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ⴰⵙⴷⵅ ⴴ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴷⵅ ⴴ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ⴰⵙⴽⴰ ⴴ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ⴰⵚⴰⵏⵜ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵚⴰⵏⵜ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵢⵏⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴰⵎⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⴹⵢⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⵎⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ⴰⴽⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ⴰⴽⵔⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵎⵡⴰⵙ ⴴ 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 2',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
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
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ⵢⴰⵏ ⵉⵎⵉⴽ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⵉⵎⵉⴽ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵉⵎⵉⴽ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵉⵎⵉⴽ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ⵢⴰⵏ ⵎⵉⵏⵓⴺ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⵎⵉⵏⵓⴺ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵎⵉⵏⵓⴺ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵎⵉⵏⵓⴺ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ⵢⴰⵏ ⵙⴰⵄⴰ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⵙⴰⵄⴰ',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵜⴰⵙⵙⴰⵄⵉⵏ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵜⴰⵙⵙⴰⵄⵉⵏ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ⵢⴰⵏ ⴰⵙⵙ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⴰⵙⵙ',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ⵢⴰⵏ 2 oⵙⵙⴰⵏ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 oⵙⵙⴰⵏ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ⵢⴰⵏ 1 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 1 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ⵢⴰⵏ ⴰⵢoⵓⵔ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⴰⵢoⵓⵔ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵉⵢⵢⵉⵔⵏ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵉⵢⵢⵉⵔⵏ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ⵢⴰⵏ ⴰⵙⴳⴰⵙ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ⵢⴰⵏ ⴰⵙⴳⴰⵙ',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ⵢⴰⵏ 2 ⵉⵙⴳⴰⵙⵏ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ⵢⴰⵏ 2 ⵉⵙⴳⴰⵙⵏ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ ⵉⵎⵉⴽ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ ⵉⵎⵉⴽ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ⵉⵎⵉⴽ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'ⵉⵎⵉⴽ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ⵉⵎⵉⴽ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ⵉⵎⵉⴽ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ ⵉⵎⵉⴽ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ⵎⵉⵏⵓⴺ ⵉⵎⵉⴽ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ⵉⵙⴳⴰⵙⵏ 3 ⵉⵢⵢⵉⵔⵏ ⴰⵙⵙ ⵉⵎⵉⴽ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ 3 ⵉⵙⴳⴰⵙⵏ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ⵢⴰⵏ 5 ⵉⵢⵢⵉⵔⵏ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ⵢⴰⵏ 2 ⵉⵙⴳⴰⵙⵏ 3 ⵉⵢⵢⵉⵔⵏ ⴰⵙⵙ ⵉⵎⵉⴽ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 10 ⵜⴰⵙⵙⴰⵄⵉⵏ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 oⵙⵙⴰⵏ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 oⵙⵙⴰⵏ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ 1 ⵉⵎⴰⵍⴰⵙⵙ 6 oⵙⵙⴰⵏ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ⵉⵎⴰⵍⴰⵙⵙ ⵙⴰⵄⴰ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ ⵙⴰⵄⴰ',
        // CarbonInterval::days(2)->forHumans()
        '2 oⵙⵙⴰⵏ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ⴰⵙⵙ 3 ⵜⴰⵙⵙⴰⵄⵉⵏ',
    ];
}
