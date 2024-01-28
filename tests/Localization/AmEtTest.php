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
class AmEtTest extends LocalizationTestCase
{
    public const LOCALE = 'am_ET'; // Amharic

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ቅዳሜ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'እሑድ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ማክሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ረቡዕ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ሐሙስ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ዓርብ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ማክሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ረቡዕ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ሐሙስ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ዓርብ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ቅዳሜ at 12:00 ጡዋት',
        // Carbon::now()->subDays(2)->calendar()
        'Last እሑድ at 8:49 ከሰዓት',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ከሰዓት',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ጡዋት',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ማክሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ማክሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ሰኞ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last እሑድ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ቅዳሜ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ዓርብ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ሐሙስ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ረቡዕ at 12:00 ጡዋት',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ዓርብ at 12:00 ጡዋት',
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
        '12:00 ጡዋት CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ጡዋት, 12:00 ጡዋት',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ጡዋት, 1:30 ጡዋት',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ጡዋት, 2:00 ጡዋት',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ጡዋት, 6:00 ጡዋት',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ጡዋት, 10:00 ጡዋት',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ከሰዓት, 12:00 ከሰዓት',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ከሰዓት, 5:00 ከሰዓት',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ከሰዓት, 9:30 ከሰዓት',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ከሰዓት, 11:00 ከሰዓት',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ከ1 ሴኮንድ በፊት',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ከ1 ሴኮንድ በፊት',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ከ2 ሴኮንድ በፊት',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ከ2 ሴኮንድ በፊት',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ከ1 ደቂቃ በፊት',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ከ1 ደቂቃ በፊት',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ከ2 ደቂቃ በፊት',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ከ2 ደቂቃ በፊት',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ከ1 ሰዓት በፊት',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ከ1 ሰዓት በፊት',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ከ2 ሰዓት በፊት',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ከ2 ሰዓት በፊት',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ከ1 ቀን በፊት',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ከ1 ቀን በፊት',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ከ2 ቀን በፊት',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ከ2 ቀን በፊት',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ከ1 ሳምንት በፊት',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ከ1 ሳምንት በፊት',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ከ2 ሳምንት በፊት',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ከ2 ሳምንት በፊት',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ከ1 ወር በፊት',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ከ1 ወር በፊት',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ከ2 ወር በፊት',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ከ2 ወር በፊት',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ከ1 አመት በፊት',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ከ1 አመት በፊት',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ከ2 አመት በፊት',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ከ2 አመት በፊት',
        // Carbon::now()->addSecond()->diffForHumans()
        'በ1 ሴኮንድ ውስጥ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'በ1 ሴኮንድ ውስጥ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ሴኮንድ after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ሴኮንድ after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ሴኮንድ before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ሴኮንድ before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ሴኮንድ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ሴኮንድ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ሴኮንድ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ሴኮንድ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'በ1 ሴኮንድ ውስጥ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ደቂቃ 1 ሴኮንድ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 አመት 3 ወር 1 ቀን 1 ሴኮንድ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'በ3 አመት ውስጥ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ከ5 ወር በፊት',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ከ2 አመት 3 ወር 1 ቀን 1 ሴኮንድ በፊት',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ሳምንት 10 ሰዓት',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ሳምንት 6 ቀን',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ሳምንት 6 ቀን',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'በ1 ሳምንት and 6 ቀን ውስጥ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ሳምንት 1 ሰዓት',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'በ1 ሰዓት ውስጥ',
        // CarbonInterval::days(2)->forHumans()
        '2 ቀን',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ቀን 3 ሰዓት',
    ];
}
