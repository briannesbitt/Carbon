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
class HakTest extends LocalizationTestCase
{
    public const LOCALE = 'hak'; // Hakka Chinese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '禮拜六 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '禮拜日 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '禮拜一 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '禮拜二 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '禮拜三 at 12:00 上晝',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '禮拜四 at 12:00 上晝',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '禮拜五 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜二 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜三 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜四 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜五 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜六 at 12:00 上晝',
        // Carbon::now()->subDays(2)->calendar()
        'Last 禮拜日 at 8:49 下晝',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 下晝',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 上晝',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '禮拜二 at 12:00 上晝',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 禮拜二 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 禮拜一 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 禮拜日 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 禮拜六 at 12:00 上晝',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 禮拜五 at 12:00 上晝',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last 禮拜四 at 12:00 上晝',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last 禮拜三 at 12:00 上晝',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last 禮拜五 at 12:00 上晝',
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
        '12:00 上晝 CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 上晝, 12:00 上晝',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 上晝, 1:30 上晝',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 上晝, 2:00 上晝',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 上晝, 6:00 上晝',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 上晝, 10:00 上晝',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 下晝, 12:00 下晝',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 下晝, 5:00 下晝',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 下晝, 9:30 下晝',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 下晝, 11:00 下晝',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 miéu ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 miéu ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 miéu ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 miéu ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 fûn ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 fûn ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 fûn ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 fûn ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 sṳ̀ ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 sṳ̀ ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 sṳ̀ ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 sṳ̀ ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ngit ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ngit ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ngit ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ngit ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 lî-pai ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 lî-pai ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 lî-pai ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 lî-pai ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ngie̍t ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ngie̍t ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ngie̍t ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ngie̍t ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ngien11 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ngien11 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ngien11 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ngien11 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 miéu from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 miéu from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 miéu after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 miéu after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 miéu before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 miéu before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 miéu',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 miéu',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 miéu',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 miéu',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 miéu from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 fûn 1 miéu',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ngien11 3 ngie̍t 1 ngit 1 miéu',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ngien11 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ngie̍t ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ngien11 3 ngie̍t 1 ngit 1 miéu ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 lî-pai 10 sṳ̀',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 lî-pai 6 ngit',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 lî-pai 6 ngit',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 lî-pai and 6 ngit from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 lî-pai 1 sṳ̀',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 sṳ̀ from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ngit',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ngit 3 sṳ̀',
    ];
}
