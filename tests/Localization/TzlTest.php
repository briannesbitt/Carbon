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

class TzlTest extends LocalizationTestCase
{
    const LOCALE = 'tzl';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sür el Sáturi lasteu à 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Súladi à 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'demà à 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'oxhi à 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'oxhi à 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ieiri à 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sür el Maitzi lasteu à 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Maitzi à 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Viénerçi à 00.00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        ':1. :1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2. :1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3. :1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4. :1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5. :1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6. :1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7. :2.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11. :2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41.',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 D\'O, 11:00 d\'o',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ja1 secunds',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ja1 secunds',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ja2 secunds',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ja2 secunds',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ja1 míut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ja1 míut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ja2 míuts',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ja2 míuts',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ja1 þora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ja1 þora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ja2 þoras',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ja2 þoras',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ja1 ziua',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ja1 ziua',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ja2 ziuas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ja2 ziuas',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ja1 seifetziua',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ja1 seifetziua',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ja2 seifetziuas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ja2 seifetziuas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ja1 mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ja1 mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ja2 mesen',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ja2 mesen',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ja1 ar',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ja1 ar',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ja2 ars',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ja2 ars',
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
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 seifetziua 10 þoras',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seifetziua 6 ziuas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 seifetziua 6 ziuas',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 seifetziuas 1 þora',
    ];
}
