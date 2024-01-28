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
class TpiTest extends LocalizationTestCase
{
    public const LOCALE = 'tpi'; // Tok Pisin

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sarere at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sande at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mande at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tunde at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Trinde at 12:00 biknait',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Fonde at 12:00 biknait',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Fraide at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tunde at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Trinde at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Fonde at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Fraide at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sarere at 12:00 biknait',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sande at 8:49 apinun',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 apinun',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 biknait',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tunde at 12:00 biknait',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tunde at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mande at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sande at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sarere at 12:00 biknait',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Fraide at 12:00 biknait',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Fonde at 12:00 biknait',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Trinde at 12:00 biknait',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Fraide at 12:00 biknait',
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
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 biknait CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 biknait, 12:00 biknait',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 biknait, 1:30 biknait',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 biknait, 2:00 biknait',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 biknait, 6:00 biknait',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 biknait, 10:00 biknait',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 apinun, 12:00 apinun',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 apinun, 5:00 apinun',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 apinun, 9:30 apinun',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 apinun, 11:00 apinun',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 namba tu ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 namba tu ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 namba tu ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 namba tu ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minit ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minit ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minit ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minit ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 aua ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 aua ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 aua ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 aua ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 de ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 de ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 de ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 de ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 wik ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 wik ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 wik ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 wik ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mun ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mun ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mun ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mun ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'yia 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'yia 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'yia 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'yia 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 namba tu from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 namba tu from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 namba tu after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 namba tu after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 namba tu before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 namba tu before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 namba tu',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 namba tu',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 namba tu',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 namba tu',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 namba tu from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minit 1 namba tu',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'yia 2 3 mun 1 de 1 namba tu',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'yia 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mun ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'yia 2 3 mun 1 de 1 namba tu ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 wik 10 aua',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wik 6 de',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 wik 6 de',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 wik and 6 de from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wik 1 aua',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 aua from now',
        // CarbonInterval::days(2)->forHumans()
        '2 de',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 de 3 aua',
    ];
}
