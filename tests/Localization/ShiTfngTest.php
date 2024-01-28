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
class ShiTfngTest extends LocalizationTestCase
{
    public const LOCALE = 'shi_Tfng'; // Tachelhit

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⴹⵢⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⴰⵎⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵢⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ⴰⴽⵕⴰⵙ at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ⴰⴽⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ⵙⵉⵎⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⴽⵕⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⴽⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⵙⵉⵎⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⴹⵢⴰⵙ at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last ⴰⵙⴰⵎⴰⵙ at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ⴰⵙⵉⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ⴰⵙⵉⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ⴰⵢⵏⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ⴰⵙⴰⵎⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ⴰⵙⵉⴹⵢⴰⵙ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ⵙⵉⵎⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ⴰⴽⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ⴰⴽⵕⴰⵙ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ⵙⵉⵎⵡⴰⵙ at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 2nd',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
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
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sin ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sin ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sin ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sin ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ⴰⵎⵥⵉ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ⴰⵎⵥⵉ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ⴰⵎⵥⵉ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ⴰⵎⵥⵉ ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 urɣ ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 urɣ ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 urɣ ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 urɣ ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ass ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ass ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ass ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ass ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 imalass ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 imalass ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 imalass ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 imalass ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ayyur ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ayyur ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ayyur ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ayyur ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 aseggwas ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 aseggwas ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 aseggwas ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 aseggwas ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sin from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 sin from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sin after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sin after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sin before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sin before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sin',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sin',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sin',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sin',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 sin from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ⴰⵎⵥⵉ 1 sin',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 aseggwas 3 ayyur 1 ass 1 sin',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 aseggwas from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ayyur ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 aseggwas 3 ayyur 1 ass 1 sin ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 imalass 10 urɣ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 imalass 6 ass',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 imalass 6 ass',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 imalass and 6 ass from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 imalass 1 urɣ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 urɣ from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ass',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ass 3 urɣ',
    ];
}
