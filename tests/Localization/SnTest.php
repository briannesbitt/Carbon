<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Localization;

class SnTest extends LocalizationTestCase
{
    const LOCALE = 'sn'; // Shona

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mugovera at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Svondo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Muvhuro at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Chipiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Chitatu at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'China at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Chishanu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Chipiri at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Chitatu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'China at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Chishanu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mugovera at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Svondo at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Chipiri at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Chipiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Muvhuro at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Svondo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mugovera at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Chishanu at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last China at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Chitatu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Chishanu at 00:00',
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
        '12:00 a cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a, 12:00 a',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 a, 1:30 a',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 a, 2:00 a',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 a, 6:00 a',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 a, 10:00 a',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 p, 12:00 p',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 p, 5:00 p',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 p, 9:30 p',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 p, 11:00 p',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 piri ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 piri ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 piri ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 piri ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 Nguva dzezuva ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 Nguva dzezuva ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 Nguva dzezuva ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 Nguva dzezuva ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 Nguva dzezuva ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 Nguva dzezuva ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 Nguva dzezuva ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 Nguva dzezuva ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 Musi ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 Musi ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 Musi ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 Musi ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 Vhiki ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 Vhiki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 Vhiki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 Vhiki ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'mwedzi 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'mwedzi 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'mwedzi 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'mwedzi 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 gore ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 gore ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 gore ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 gore ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 piri from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 piri from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 piri after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 piri after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 piri before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 piri before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 piri',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 piri',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 piri',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 piri',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 piri from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Nguva dzezuva 1 piri',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 gore mwedzi 3 1 Musi 1 piri',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 gore from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'mwedzi 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 gore mwedzi 3 1 Musi 1 piri ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Vhiki 10 Nguva dzezuva',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Vhiki 6 Musi',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Vhiki 6 Musi',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 Vhiki and 6 Musi from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Vhiki 1 Nguva dzezuva',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 Nguva dzezuva from now',
        // CarbonInterval::days(2)->forHumans()
        '2 Musi',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 Musi 3 Nguva dzezuva',
    ];
}
