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
class TzlTest extends LocalizationTestCase
{
    public const LOCALE = 'tzl'; // Talossan

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'demà à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sáturi à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Súladi à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lúneçi à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Maitzi à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Márcuri à 00.00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Xhúadi à 00.00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Viénerçi à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Maitzi à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Márcuri à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Xhúadi à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Viénerçi à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sáturi à 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'sür el Súladi lasteu à 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ieiri à 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'oxhi à 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'oxhi à 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'demà à 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Maitzi à 00.00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ieiri à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ieiri à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Maitzi lasteu à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Lúneçi lasteu à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Súladi lasteu à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Sáturi lasteu à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Viénerçi lasteu à 00.00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'sür el Xhúadi lasteu à 00.00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'sür el Márcuri lasteu à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sür el Viénerçi lasteu à 00.00',
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
        '12:00 d\'a CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 D\'A, 12:00 d\'a',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 D\'A, 1:30 d\'a',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 D\'A, 2:00 d\'a',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 D\'A, 6:00 d\'a',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 D\'A, 10:00 d\'a',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 D\'O, 12:00 d\'o',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 D\'O, 5:00 d\'o',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 D\'O, 9:30 d\'o',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 D\'O, 11:00 d\'o',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ja 1 secunds',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ja 1 secunds',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ja 2 secunds',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ja 2 secunds',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ja 1 míut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ja 1 míut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ja 2 míuts',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ja 2 míuts',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ja 1 þora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ja 1 þora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ja 2 þoras',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ja 2 þoras',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ja 1 ziua',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ja 1 ziua',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ja 2 ziuas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ja 2 ziuas',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ja 1 seifetziua',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ja 1 seifetziua',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ja 2 seifetziuas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ja 2 seifetziuas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ja 1 mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ja 1 mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ja 2 mesen',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ja 2 mesen',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ja 1 ar',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ja 1 ar',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ja 2 ars',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ja 2 ars',
        // Carbon::now()->addSecond()->diffForHumans()
        'osprei 1 secunds',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'osprei 1 secunds',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 secunds',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 secunds',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 secunds',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 secunds',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'osprei 1 secunds',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 míut 1 secunds',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ars 3 mesen 1 ziua 1 secunds',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'osprei 3 ars',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ja 5 mesen',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ja 2 ars 3 mesen 1 ziua 1 secunds',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 seifetziua 10 þoras',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seifetziua 6 ziuas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seifetziua 6 ziuas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'osprei 1 seifetziua 6 ziuas',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 seifetziuas 1 þora',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'osprei 1 þora',
        // CarbonInterval::days(2)->forHumans()
        '2 ziuas',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ziua 3 þoras',
    ];
}
