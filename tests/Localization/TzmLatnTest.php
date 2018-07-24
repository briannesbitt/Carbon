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

class TzmLatnTest extends LocalizationTestCase
{
    const LOCALE = 'tzm_Latn';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asiḍyas g 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'asamas g 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aska g 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'asdkh g 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asdkh g 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'assant g 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asimwas g 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'yan imik',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'yan s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'yan 2 imik',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'yan s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'yan minuḍ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'yan min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'yan 2 minuḍ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'yan min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'yan saɛa',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'yan h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'yan 2 tassaɛin',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'yan h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'yan ass',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'yan d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'yan 2 ossan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'yan d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'yan 1 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'yan w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'yan 2 ⵉⵎⴰⵍⴰⵙⵙ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'yan w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'yan ayowr',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'yan m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'yan 2 iyyirn',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'yan m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'yan asgas',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'yan y',
        // Carbon::now()->subYears(2)->diffForHumans()
        'yan 2 isgasn',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'yan y',
        // Carbon::now()->addSecond()->diffForHumans()
        'dadkh s yan imik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'dadkh s yan s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'imik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 imik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'dadkh s yan s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minuḍ imik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 10 tassaɛin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 ossan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ⵉⵎⴰⵍⴰⵙⵙ 6 ossan',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ⵉⵎⴰⵍⴰⵙⵙ saɛa',
    ];
}
