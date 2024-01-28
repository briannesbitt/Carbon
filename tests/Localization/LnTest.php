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
class LnTest extends LocalizationTestCase
{
    public const LOCALE = 'ln'; // Lingala

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mpɔ́sɔ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lomíngo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mosálá mɔ̌kɔ́ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Misálá míbalé at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Misálá mísáto at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Misálá mínei at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Misálá mítáno at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Misálá míbalé at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Misálá mísáto at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Misálá mínei at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Misálá mítáno at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mpɔ́sɔ at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Lomíngo at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Misálá míbalé at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Misálá míbalé at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mosálá mɔ̌kɔ́ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Lomíngo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mpɔ́sɔ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Misálá mítáno at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Misálá mínei at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Misálá mísáto at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Misálá mítáno at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
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
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'segɔnde 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'segɔnde 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'segɔnde 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'segɔnde 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'miniti 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'miniti 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'miniti 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'miniti 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ngonga 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ngonga 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ngonga 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ngonga 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'mokɔlɔ 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'mokɔlɔ 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'mokɔlɔ 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'mokɔlɔ 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'mpɔ́sɔ 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'mpɔ́sɔ 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'mpɔ́sɔ 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'mpɔ́sɔ 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'sánzá 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'sánzá 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'sánzá 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'sánzá 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'mbula 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'mbula 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'mbula 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'mbula 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'segɔnde 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'segɔnde 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'segɔnde 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'segɔnde 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'segɔnde 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'segɔnde 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'segɔnde 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'segɔnde 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'segɔnde 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'segɔnde 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'segɔnde 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'miniti 1 segɔnde 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'mbula 2 sánzá 3 mokɔlɔ 1 segɔnde 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'mbula 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'sánzá 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'mbula 2 sánzá 3 mokɔlɔ 1 segɔnde 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'mpɔ́sɔ 1 ngonga 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'mpɔ́sɔ 1 mokɔlɔ 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'mpɔ́sɔ 1 mokɔlɔ 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'mpɔ́sɔ 1 and mokɔlɔ 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'mpɔ́sɔ 2 ngonga 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ngonga 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'mokɔlɔ 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'mokɔlɔ 1 ngonga 3',
    ];
}
