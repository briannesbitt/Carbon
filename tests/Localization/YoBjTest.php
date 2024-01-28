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
class YoBjTest extends LocalizationTestCase
{
    public const LOCALE = 'yo_BJ'; // Yoruba

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ọ̀la ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Àbámɛ́ta Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Àìkú Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Ajé Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Ìsɛ́gun Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́rú Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Ɔjɔ́bɔ Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Ɔjɔ́ Ɛtì Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́ Ìsɛ́gun Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́rú Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́bɔ Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́ Ɛtì Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́ Àbámɛ́ta Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Ɔjɔ́ Àìkú Ọsẹ̀ tólọ́ ni 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àna ni 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Ònì ni 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ònì ni 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ọ̀la ni 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́ Ìsɛ́gun Ọsẹ̀ tón\'bọ ni 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Àna ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Àna ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Ìsɛ́gun Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Ajé Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Àìkú Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Àbámɛ́ta Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ɔjɔ́ Ɛtì Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Ɔjɔ́bɔ Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Ɔjɔ́rú Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ɔjɔ́ Ɛtì Ọsẹ̀ tólọ́ ni 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ọjọ́ 1 ọjọ́ 1 ọjọ́ 1 ọjọ́ 1 ọjọ́ 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 2 ọjọ́ 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 3 ọjọ́ 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 4 ọjọ́ 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 5 ọjọ́ 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 6 ọjọ́ 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 7 ọjọ́ 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ọjọ́ 11 ọjọ́ 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ọjọ́ 40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ọjọ́ 41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ọjọ́ 100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 àárɔ̀ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Àárɔ̀, 12:00 àárɔ̀',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Àárɔ̀, 1:30 àárɔ̀',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Àárɔ̀, 2:00 àárɔ̀',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Àárɔ̀, 6:00 àárɔ̀',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Àárɔ̀, 10:00 àárɔ̀',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Ɔ̀sán, 12:00 ɔ̀sán',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Ɔ̀sán, 5:00 ɔ̀sán',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Ɔ̀sán, 9:30 ɔ̀sán',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Ɔ̀sán, 11:00 ɔ̀sán',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ọjọ́ 0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'iaayá 1 kọjá',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'iaayá 1 kọjá',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'iaayá 2 kọjá',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'iaayá 2 kọjá',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ìsẹjú 1 kọjá',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ìsẹjú 1 kọjá',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ìsẹjú 2 kọjá',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ìsẹjú 2 kọjá',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wákati 1 kọjá',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'wákati 1 kọjá',
        // Carbon::now()->subHours(2)->diffForHumans()
        'wákati 2 kọjá',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'wákati 2 kọjá',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ọjọ́ 1 kọjá',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ọjọ́ 1 kọjá',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ọjọ́ 2 kọjá',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ọjọ́ 2 kọjá',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ọsẹ 1 kọjá',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ọsẹ 1 kọjá',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ọsẹ 2 kọjá',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ọsẹ 2 kọjá',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'osù 1 kọjá',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'osù 1 kọjá',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'osù 2 kọjá',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'osù 2 kọjá',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ọdún 1 kọjá',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ọdún 1 kọjá',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ọdún 2 kọjá',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ọdún 2 kọjá',
        // Carbon::now()->addSecond()->diffForHumans()
        'ní iaayá 1',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ní iaayá 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'iaayá 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'iaayá 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'iaayá 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'iaayá 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ní iaayá 1',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ìsẹjú 1 iaayá 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'ọdún 2 osù 3 ọjọ́ 1 iaayá 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ní ọdún 3',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'osù 5 kọjá',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ọdún 2 osù 3 ọjọ́ 1 iaayá 1 kọjá',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ọsẹ 1 wákati 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ọsẹ 1 ọjọ́ 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ọsẹ 1 ọjọ́ 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ní ọsẹ 1 ọjọ́ 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'ọsẹ 2 wákati 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ní wákati kan',
        // CarbonInterval::days(2)->forHumans()
        'ọjọ́ 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ọjọ́ 1 wákati 3',
    ];
}
