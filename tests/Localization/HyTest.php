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

class HyTest extends LocalizationTestCase
{
    const LOCALE = 'hy'; // Armenian

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
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        '1 1-ին',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1-ին',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1-ին',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1-ին',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1-ին',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1-ին',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2-րդ',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2-րդ',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-րդ',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-րդ',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 գիշերվա, 12:00 գիշերվա',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 գիշերվա, 1:30 գիշերվա',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 գիշերվա, 2:00 գիշերվա',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 առավոտվա, 6:00 առավոտվա',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 առավոտվա, 10:00 առավոտվա',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ցերեկվա, 12:00 ցերեկվա',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 երեկոյան, 5:00 երեկոյան',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 երեկոյան, 11:00 երեկոյան',
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
        'մի քանի վայրկյան ներկա պահից',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1վրկ ներկա պահից',
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
        '1վրկ ներկա պահից',
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
