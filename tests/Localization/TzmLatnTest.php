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
class TzmLatnTest extends LocalizationTestCase
{
    public const LOCALE = 'tzm_Latn'; // Tamazight

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aska g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asiḍyas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asamas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aynas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'akras g 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'akwas g 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'asimwas g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'akras g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'akwas g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asimwas g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asiḍyas g 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'asamas g 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'assant g 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'asdkh g 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asdkh g 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'aska g 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'assant g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'assant g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asinas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aynas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asamas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asiḍyas g 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asimwas g 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'akwas g 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'akras g 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asimwas g 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 2',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 zdat azal CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Zdat azal, 12:00 zdat azal',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Zdat azal, 1:30 zdat azal',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Zdat azal, 2:00 zdat azal',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Zdat azal, 6:00 zdat azal',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Zdat azal, 10:00 zdat azal',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Ḍeffir aza, 12:00 ḍeffir aza',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Ḍeffir aza, 5:00 ḍeffir aza',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Ḍeffir aza, 9:30 ḍeffir aza',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Ḍeffir aza, 11:00 ḍeffir aza',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'yan 1 imik',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'yan 1 imik',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'yan 2 imik',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'yan 2 imik',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'yan 1 minuḍ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'yan 1 minuḍ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'yan 2 minuḍ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'yan 2 minuḍ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'yan 1 saɛa',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'yan 1 saɛa',
        // Carbon::now()->subHours(2)->diffForHumans()
        'yan 2 tassaɛin',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'yan 2 tassaɛin',
        // Carbon::now()->subDays(1)->diffForHumans()
        'yan 1 ass',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'yan 1 ass',
        // Carbon::now()->subDays(2)->diffForHumans()
        'yan 2 ossan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'yan 2 ossan',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'yan 1 imalass',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'yan 1 imalass',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'yan 2 imalass',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'yan 2 imalass',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'yan 1 ayowr',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'yan 1 ayowr',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'yan 2 iyyirn',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'yan 2 iyyirn',
        // Carbon::now()->subYears(1)->diffForHumans()
        'yan 1 asgas',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'yan 1 asgas',
        // Carbon::now()->subYears(2)->diffForHumans()
        'yan 2 isgasn',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'yan 2 isgasn',
        // Carbon::now()->addSecond()->diffForHumans()
        'dadkh s yan 1 imik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'dadkh s yan 1 imik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 imik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 imik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 imik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 imik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'dadkh s yan 1 imik',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuḍ 1 imik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 isgasn 3 iyyirn 1 ass 1 imik',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'dadkh s yan 3 isgasn',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'yan 5 iyyirn',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'yan 2 isgasn 3 iyyirn 1 ass 1 imik',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 imalass 10 tassaɛin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 imalass 6 ossan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 imalass 6 ossan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'dadkh s yan 1 imalass 6 ossan',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 imalass 1 saɛa',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'dadkh s yan saɛa',
        // CarbonInterval::days(2)->forHumans()
        '2 ossan',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ass 3 tassaɛin',
    ];
}
