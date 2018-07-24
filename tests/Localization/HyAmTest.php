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

class HyAmTest extends LocalizationTestCase
{
    const LOCALE = 'hy_AM'; // Armenian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'անցած շաբաթ օրը ժամը 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'կիրակի օրը ժամը 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'վաղը 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'այսօր 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'այսօր 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'երեկ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'անցած երեքշաբթի օրը ժամը 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'երեքշաբթի օրը ժամը 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ուրբաթ օրը ժամը 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'մի քանի վայրկյան առաջ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1վրկ առաջ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 վայրկյան առաջ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2վրկ առաջ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'րոպե առաջ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1ր առաջ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 րոպե առաջ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2ր առաջ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ժամ առաջ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1ժ առաջ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ժամ առաջ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2ժ առաջ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'օր առաջ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1օր առաջ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 օր առաջ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2օր առաջ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 շաբաթ առաջ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1շ առաջ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 շաբաթ առաջ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2շ առաջ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ամիս առաջ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1ամ առաջ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ամիս առաջ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2ամ առաջ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'տարի առաջ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1տ առաջ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 տարի առաջ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2տ առաջ',
        // Carbon::now()->addSecond()->diffForHumans()
        'մի քանի վայրկյան հետո',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1վրկ հետո',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'մի քանի վայրկյան հետո',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1վրկ հետո',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'մի քանի վայրկյան առաջ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1վրկ առաջ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'մի քանի վայրկյան',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1վրկ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 վայրկյան',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2վրկ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1վրկ հետո',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'րոպե մի քանի վայրկյան',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2տ 3ամ 1օր 1վրկ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 շաբաթ 10 ժամ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 շաբաթ 6 օր',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 շաբաթ 6 օր',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 շաբաթ ժամ',
    ];
}
