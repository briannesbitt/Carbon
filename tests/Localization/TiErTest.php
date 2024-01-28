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
class TiErTest extends LocalizationTestCase
{
    public const LOCALE = 'ti_ER'; // Tigrinya

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ቀዳም at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ሰንበት at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ሰኑይ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ሰሉስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ረቡዕ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ሓሙስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ዓርቢ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ሰሉስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ረቡዕ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ሓሙስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ዓርቢ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ቀዳም at 12:00 ንጉሆ ሰዓተ',
        // Carbon::now()->subDays(2)->calendar()
        'Last ሰንበት at 8:49 ድሕር ሰዓት',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ድሕር ሰዓት',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ሰሉስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ሰሉስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ሰኑይ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ሰንበት at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ቀዳም at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ዓርቢ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ሓሙስ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ረቡዕ at 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ዓርቢ at 12:00 ንጉሆ ሰዓተ',
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
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ንጉሆ ሰዓተ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ንጉሆ ሰዓተ, 12:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ንጉሆ ሰዓተ, 1:30 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ንጉሆ ሰዓተ, 2:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ንጉሆ ሰዓተ, 6:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ንጉሆ ሰዓተ, 10:00 ንጉሆ ሰዓተ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ድሕር ሰዓት, 12:00 ድሕር ሰዓት',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ድሕር ሰዓት, 5:00 ድሕር ሰዓት',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ድሕር ሰዓት, 9:30 ድሕር ሰዓት',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ድሕር ሰዓት, 11:00 ድሕር ሰዓት',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ሰከንድ ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ሰከንድ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ሰከንድ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ሰከንድ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ደቒቕ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ደቒቕ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ደቒቕ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ደቒቕ ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ሰዓት ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ሰዓት ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ሰዓት ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ሰዓት ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 መዓልቲ ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 መዓልቲ ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 መዓልቲ ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 መዓልቲ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ሰሙን ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ሰሙን ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ሰሙን ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ሰሙን ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ወርሒ 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ወርሒ 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ወርሒ 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ወርሒ 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ዓመት ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ዓመት ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ዓመት ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ዓመት ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ሰከንድ from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ሰከንድ from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ሰከንድ after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ሰከንድ after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ሰከንድ before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ሰከንድ before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ሰከንድ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ሰከንድ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ሰከንድ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ሰከንድ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ሰከንድ from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ደቒቕ 1 ሰከንድ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ዓመት ወርሒ 3 1 መዓልቲ 1 ሰከንድ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ዓመት from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ወርሒ 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ዓመት ወርሒ 3 1 መዓልቲ 1 ሰከንድ ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ሰሙን 10 ሰዓት',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ሰሙን 6 መዓልቲ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ሰሙን 6 መዓልቲ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ሰሙን and 6 መዓልቲ from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ሰሙን 1 ሰዓት',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ሰዓት from now',
        // CarbonInterval::days(2)->forHumans()
        '2 መዓልቲ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 መዓልቲ 3 ሰዓት',
    ];
}
