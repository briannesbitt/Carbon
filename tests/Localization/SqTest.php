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

class SqTest extends LocalizationTestCase
{
    const LOCALE = 'sq'; // Albanian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'E Shtunë e kaluar në 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'E Diel në 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Nesër në 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Sot në 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sot në 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Dje në 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'E Martë e kaluar në 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'E Martë në 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'E Premte në 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'disa sekonda më parë',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekondë më parë',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekonda më parë',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekonda më parë',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'një minutë më parë',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutë më parë',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuta më parë',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuta më parë',
        // Carbon::now()->subHours(1)->diffForHumans()
        'një orë më parë',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 orë më parë',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 orë më parë',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 orë më parë',
        // Carbon::now()->subDays(1)->diffForHumans()
        'një ditë më parë',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ditë më parë',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ditë më parë',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ditë më parë',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 javë më parë',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 javë më parë',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 javë më parë',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 javë më parë',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'një muaj më parë',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 muaj më parë',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 muaj më parë',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 muaj më parë',
        // Carbon::now()->subYears(1)->diffForHumans()
        'një vit më parë',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 vit më parë',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 vite më parë',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 vjet më parë',
        // Carbon::now()->addSecond()->diffForHumans()
        'në disa sekonda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'në 1 sekondë',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'disa sekonda pas',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekondë pas',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'disa sekonda para',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekondë para',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'disa sekonda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekondë',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekonda',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekonda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'në 1 sekondë',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'një minutë disa sekonda',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 vjet 3 muaj 1 ditë 1 sekondë',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 javë 10 orë',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 javë 6 ditë',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 javë 6 ditë',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 javë një orë',
    ];
}
