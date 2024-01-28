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
class FyTest extends LocalizationTestCase
{
    public const LOCALE = 'fy'; // WesternFrisian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'moarn om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sneon om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'snein om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'moandei om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tiisdei om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'woansdei om 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'tongersdei om 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'freed om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tiisdei om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'woansdei om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tongersdei om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'freed om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sneon om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ôfrûne snein om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juster om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'hjoed om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hjoed om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'moarn om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tiisdei om 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'juster om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juster om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne tiisdei om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne moandei om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne snein om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne sneon om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne freed om 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ôfrûne tongersdei om 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ôfrûne woansdei om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ôfrûne freed om 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1ste 1ste 1ste 1ste 1ste',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2de 1ste',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3de 1ste',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4de 1ste',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5de 1ste',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6de 1ste',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7de 1ste',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11de 2de',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40ste',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41ste',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100ste',
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
        '0de',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekonde lyn',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 s. lyn',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekonden lyn',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 s. lyn',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minút lyn',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min. lyn',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuten lyn',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min. lyn',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 oere lyn',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 o. lyn',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oeren lyn',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 o. lyn',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dei lyn',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 d. lyn',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagen lyn',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 d. lyn',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 wike lyn',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 wike lyn',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 wiken lyn',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 wiken lyn',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 moanne lyn',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 moa. lyn',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 moannen lyn',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 moa. lyn',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 jier lyn',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 j lyn',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jierren lyn',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 j lyn',
        // Carbon::now()->addSecond()->diffForHumans()
        'oer 1 sekonde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'oer 1 s.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekonde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekonden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'oer 1 s.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minút 1 sekonde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 j 3 moa. 1 d. 1 s.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'oer 3 jierren',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 moa. lyn',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 j 3 moa. 1 d. 1 s. lyn',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 wike 10 oeren',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wike 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wike 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'oer 1 wike en 6 dagen',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wiken 1 oere',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'oer ien oere',
        // CarbonInterval::days(2)->forHumans()
        '2 dagen',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 o.',
    ];
}
