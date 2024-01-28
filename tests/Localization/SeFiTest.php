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
class SeFiTest extends LocalizationTestCase
{
    public const LOCALE = 'se_FI'; // NorthernSami

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ihttin ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lávvordat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sotnabeaivi ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mánnodat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'disdat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'duorastat ti 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'bearjadat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'disdat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'duorastat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'bearjadat ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lávvordat ti 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ovddit sotnabeaivi ti 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ikte ti 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'otne ti 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'otne ti 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ihttin ti 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'disdat ti 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ikte ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ikte ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit disdat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit mánnodat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit sotnabeaivi ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit lávvordat ti 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ovddit bearjadat ti 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ovddit duorastat ti 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ovddit gaskavahkku ti 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ovddit bearjadat ti 00:00',
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
        '12:00 i CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 i, 12:00 i',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 i, 1:30 i',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 i, 2:00 i',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 i, 6:00 i',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 i, 10:00 i',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 e, 12:00 e',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 e, 5:00 e',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 e, 9:30 e',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 e, 11:00 e',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'maŋit 1 sekunddat',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'maŋit 1 s.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'maŋit 2 sekunddat',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'maŋit 2 s.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'maŋit 1 minuhta',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'maŋit 1 min.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'maŋit 2 minuhtat',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'maŋit 2 min.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'maŋit 1 diimmu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'maŋit 1 d.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'maŋit 2 diimmut',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'maŋit 2 d.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'maŋit 1 beaivi',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'maŋit 1 b.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'maŋit 2 beaivvit',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'maŋit 2 b.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'maŋit 1 vahkku',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'maŋit 1 v.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'maŋit 2 vahkku',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'maŋit 2 v.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'maŋit 1 mánnu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'maŋit 1 mán.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'maŋit 2 mánut',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'maŋit 2 mán.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'maŋit 1 jahki',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'maŋit 1 j.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'maŋit 2 jagit',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'maŋit 2 j.',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekunddat geažes',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 s. geažes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekunddat',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunddat',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 s. geažes',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuhta 1 sekunddat',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 j. 3 mán. 1 b. 1 s.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 jagit geažes',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'maŋit 5 mán.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'maŋit 2 j. 3 mán. 1 b. 1 s.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vahkku 10 diimmut',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vahkku 6 beaivvit',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vahkku 6 beaivvit',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 vahkku ja 6 beaivvit geažes',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 vahkku 1 diimmu',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'okta diimmu geažes',
        // CarbonInterval::days(2)->forHumans()
        '2 beaivvit',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 b. 3 d.',
    ];
}
