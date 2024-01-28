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
class ZghTest extends LocalizationTestCase
{
    public const LOCALE = 'zgh'; // Standard Moroccan Tamazight

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴽⴽⴰ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⵉⴹⵢⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⴰⵎⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵡⴰⵢⵏⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⵉⵏⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵡⴰⴽⵕⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ⵓⴽⵡⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ⵓⵙⵉⵎⵡⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⵙⵉⵏⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵡⴰⴽⵕⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⴽⵡⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⵙⵉⵎⵡⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⵙⵉⴹⵢⴰⵙ ⴳ 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ⵓⵙⴰⵎⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵙⵏⵏⴰⵟ ⴳ 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ⴰⵙⵙ ⴰ/ⴰⴷ ⴳ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵙ ⴰ/ⴰⴷ ⴳ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ⴰⵙⴽⴽⴰ ⴳ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⵙⵉⵏⴰⵙ ⴳ 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ⴰⵙⵙⵏⵏⴰⵟ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵙⵏⵏⴰⵟ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⵉⵏⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵡⴰⵢⵏⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⴰⵎⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⵉⴹⵢⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⵓⵙⵉⵎⵡⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ⵓⴽⵡⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ⵡⴰⴽⵕⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵓⵙⵉⵎⵡⴰⵙ ⴰⵎⴳⴳⴰⵔⵓ ⴳ 00:00',
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
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ⵜⵉⴼⴰⵡⵜ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ⵜⵉⴼⴰⵡⵜ, 12:00 ⵜⵉⴼⴰⵡⵜ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ⵜⵉⴼⴰⵡⵜ, 1:30 ⵜⵉⴼⴰⵡⵜ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ⵜⵉⴼⴰⵡⵜ, 2:00 ⵜⵉⴼⴰⵡⵜ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ⵜⵉⴼⴰⵡⵜ, 6:00 ⵜⵉⴼⴰⵡⵜ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ⵜⵉⴼⴰⵡⵜ, 10:00 ⵜⵉⴼⴰⵡⵜ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ⵜⴰⴷⴳⴳⵯⴰⵜ, 12:00 ⵜⴰⴷⴳⴳⵯⴰⵜ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ⵜⴰⴷⴳⴳⵯⴰⵜ, 5:00 ⵜⴰⴷⴳⴳⵯⴰⵜ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ⵜⴰⴷⴳⴳⵯⴰⵜ, 9:30 ⵜⴰⴷⴳⴳⵯⴰⵜ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ⵜⴰⴷⴳⴳⵯⴰⵜ, 11:00 ⵜⴰⴷⴳⴳⵯⴰⵜ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ⵣⴳ 1 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵜ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ⵣⴳ 2 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵜ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ⵣⴳ 1 ⵜⵓⵙⴷⵉⴷⵜ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵜⵓⵙ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ⵣⴳ 2 ⵜⵓⵙⴷⵉⴷⵜ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵜⵓⵙ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ⵣⴳ 1 ⵜⵙⵔⴰⴳⵜ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵜ',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ⵣⴳ 2 ⵜⵙⵔⴰⴳⵜ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵜ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ⵣⴳ 1 ⵡⴰⵙⵙ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵓ',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ⵣⴳ 2 ⵡⴰⵙⵙ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵓ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ⵣⴳ 1 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵉⵎⴰⵍⴰⵙⵙ.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ⵣⴳ 2 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵉⵎⴰⵍⴰⵙⵙ.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ⵣⴳ 1 ⵡⴰⵢⵢⵓⵔ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⴰⵢⵢⵓⵔⵏ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ⵣⴳ 2 ⵡⴰⵢⵢⵓⵔ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⴰⵢⵢⵓⵔⵏ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ⵣⴳ 1 ⵓⵙⴳⴳⵯⴰⵙ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ⵣⴳ 1 ⵓⵙⴳⴳⵯⴰⵙ',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ⵣⴳ 2 ⵓⵙⴳⴳⵯⴰⵙ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ⵣⴳ 2 ⵓⵙⴳⴳⵯⴰⵙ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ⴷⴳ 1 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ⴷⴳ 1 ⵜ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ⵜⵙⵉⵏⵜ ⴰⵡⴰⵔ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ⵜ ⴰⵡⴰⵔ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ⵜⵙⵉⵏⵜ ⴷⴰⵜ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ⵜ ⴷⴰⵜ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ⵜ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ⵜ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ⴷⴳ 1 ⵜ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ⵜⵓⵙⴷⵉⴷⵜ 1 ⵜⵙⵉⵏⵜ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ⵓⵙⴳⴳⵯⴰⵙ 3 ⴰⵢⵢⵓⵔⵏ 1 ⵓ 1 ⵜ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ⴷⴳ 3 ⵓⵙⴳⴳⵯⴰⵙ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ⵣⴳ 5 ⴰⵢⵢⵓⵔⵏ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ⵣⴳ 2 ⵓⵙⴳⴳⵯⴰⵙ 3 ⴰⵢⵢⵓⵔⵏ 1 ⵓ 1 ⵜ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 10 ⵜⵙⵔⴰⴳⵜ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 ⵡⴰⵙⵙ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 ⵡⴰⵙⵙ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ⴷⴳ 1 ⵉⵎⴰⵍⴰⵙⵙ ⴷ 6 ⵡⴰⵙⵙ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ⵉⵎⴰⵍⴰⵙⵙ 1 ⵜⵙⵔⴰⴳⵜ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ⴷⴳ ⵉⵛⵜ ⵜⵙⵔⴰⴳⵜ',
        // CarbonInterval::days(2)->forHumans()
        '2 ⵡⴰⵙⵙ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ⵓ 3 ⵜ',
    ];
}
