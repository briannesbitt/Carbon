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
class IiTest extends LocalizationTestCase
{
    public const LOCALE = 'ii'; // SichuanYi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ꆏꊂꃘ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ꑭꆏꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ꆏꊂꋍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ꆏꊂꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ꆏꊂꌕ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ꆏꊂꇖ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ꆏꊂꉬ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꌕ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꇖ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꉬ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꃘ at 12:00 ꎸꄑ',
        // Carbon::now()->subDays(2)->calendar()
        'Last ꑭꆏꑍ at 8:49 ꁯꋒ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ꁯꋒ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ꆏꊂꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ꆏꊂꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ꆏꊂꋍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ꑭꆏꑍ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ꆏꊂꃘ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ꆏꊂꉬ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ꆏꊂꇖ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ꆏꊂꌕ at 12:00 ꎸꄑ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ꆏꊂꉬ at 12:00 ꎸꄑ',
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
        '12:00 ꎸꄑ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ꎸꄑ, 12:00 ꎸꄑ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ꎸꄑ, 1:30 ꎸꄑ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ꎸꄑ, 2:00 ꎸꄑ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ꎸꄑ, 6:00 ꎸꄑ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ꎸꄑ, 10:00 ꎸꄑ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ꁯꋒ, 12:00 ꁯꋒ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ꁯꋒ, 5:00 ꁯꋒ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ꁯꋒ, 9:30 ꁯꋒ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ꁯꋒ, 11:00 ꁯꋒ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ꇅ ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ꇅ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ꇅ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ꇅ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ꀄꊭ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ꀄꊭ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ꀄꊭ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ꀄꊭ ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ꄮꈉ ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ꄮꈉ ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ꄮꈉ ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ꄮꈉ ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ꏜ ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ꏜ ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ꏜ ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ꏜ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ꏃ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ꏃ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ꏃ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ꏃ ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ꆪ ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ꆪ ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ꆪ ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ꆪ ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ꒉ ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ꒉ ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ꒉ ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ꒉ ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ꇅ from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ꇅ from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ꇅ after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ꇅ after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ꇅ before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ꇅ before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ꇅ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ꇅ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ꇅ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ꇅ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ꇅ from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ꀄꊭ 1 ꇅ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ꒉ 3 ꆪ 1 ꏜ 1 ꇅ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ꒉ from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ꆪ ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ꒉ 3 ꆪ 1 ꏜ 1 ꇅ ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ꏃ 10 ꄮꈉ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ꏃ 6 ꏜ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ꏃ 6 ꏜ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ꏃ and 6 ꏜ from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ꏃ 1 ꄮꈉ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ꄮꈉ from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ꏜ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ꏜ 3 ꄮꈉ',
    ];
}
