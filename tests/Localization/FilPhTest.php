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
class FilPhTest extends LocalizationTestCase
{
    public const LOCALE = 'fil_PH'; // Filipino

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabado at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Linggo at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lunes at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Martes at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Miyerkoles at 12:00 N.U.',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Huwebes at 12:00 N.U.',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Biyernes at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Martes at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Miyerkoles at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Huwebes at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Biyernes at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabado at 12:00 N.U.',
        // Carbon::now()->subDays(2)->calendar()
        'Last Linggo at 8:49 N.H.',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 N.H.',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 N.U.',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Martes at 12:00 N.U.',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Martes at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Lunes at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Linggo at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sabado at 12:00 N.U.',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Biyernes at 12:00 N.U.',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Huwebes at 12:00 N.U.',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Miyerkoles at 12:00 N.U.',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Biyernes at 12:00 N.U.',
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
        '12:00 n.u. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 N.U., 12:00 n.u.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 N.U., 1:30 n.u.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 N.U., 2:00 n.u.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 N.U., 6:00 n.u.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 N.U., 10:00 n.u.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 N.H., 12:00 n.h.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 N.H., 5:00 n.h.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 N.H., 9:30 n.h.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 N.H., 11:00 n.h.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 segundo ang nakalipas',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 segundo ang nakalipas',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 segundo ang nakalipas',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 segundo ang nakalipas',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuto ang nakalipas',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minuto ang nakalipas',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuto ang nakalipas',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuto ang nakalipas',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 oras ang nakalipas',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 oras ang nakalipas',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oras ang nakalipas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 oras ang nakalipas',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 araw ang nakalipas',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 araw ang nakalipas',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 araw ang nakalipas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 araw ang nakalipas',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 linggo ang nakalipas',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 linggo ang nakalipas',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 linggo ang nakalipas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 linggo ang nakalipas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 buwan ang nakalipas',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 buwan ang nakalipas',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 buwan ang nakalipas',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 buwan ang nakalipas',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 taon ang nakalipas',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 taon ang nakalipas',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 taon ang nakalipas',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 taon ang nakalipas',
        // Carbon::now()->addSecond()->diffForHumans()
        'sa 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sa 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 segundo pagkatapos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 segundo pagkatapos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 segundo bago',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 segundo bago',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sa 1 segundo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuto 1 segundo',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 taon 3 buwan 1 araw 1 segundo',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'sa 3 taon',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 buwan ang nakalipas',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 taon 3 buwan 1 araw 1 segundo ang nakalipas',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 linggo 10 oras',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 linggo 6 araw',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 linggo 6 araw',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'sa 1 linggo and 6 araw',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 linggo 1 oras',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'sa 1 oras',
        // CarbonInterval::days(2)->forHumans()
        '2 araw',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 araw 3 oras',
    ];
}
