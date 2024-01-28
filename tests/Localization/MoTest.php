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
class MoTest extends LocalizationTestCase
{
    public const LOCALE = 'mo'; // Moldavian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mâine la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sâmbătă la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'duminică la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'luni la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'marți la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'miercuri la 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'joi la 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'vineri la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'marți la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'miercuri la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'joi la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vineri la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sâmbătă la 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'fosta duminică la 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ieri la 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'azi la 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'azi la 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'mâine la 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'marți la 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ieri la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ieri la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'fosta marți la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'fosta luni la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'fosta duminică la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'fosta sâmbătă la 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'fosta vineri la 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'fosta joi la 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'fosta miercuri la 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fosta vineri la 0:00',
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
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 a.m. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a.m., 12:00 a.m.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 a.m., 1:30 a.m.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 a.m., 2:00 a.m.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 a.m., 6:00 a.m.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 a.m., 10:00 a.m.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 p.m., 12:00 p.m.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 p.m., 5:00 p.m.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 p.m., 9:30 p.m.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 p.m., 11:00 p.m.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 secundă în urmă',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sec. în urmă',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 secundă în urmă',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sec. în urmă',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minut în urmă',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 m. în urmă',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minut în urmă',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 m. în urmă',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 oră în urmă',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 o. în urmă',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oră în urmă',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 o. în urmă',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 zi în urmă',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 z. în urmă',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 zi în urmă',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 z. în urmă',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 săptămână în urmă',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 săp. în urmă',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 săptămână în urmă',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 săp. în urmă',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 lună în urmă',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 l. în urmă',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 lună în urmă',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 l. în urmă',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 an în urmă',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 a. în urmă',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 an în urmă',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 a. în urmă',
        // Carbon::now()->addSecond()->diffForHumans()
        'peste 1 secundă',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'peste 1 sec.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'peste 1 secundă',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'peste 1 sec.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'acum 1 secundă',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'acum 1 sec.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 secundă',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sec.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 secundă',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sec.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'peste 1 sec.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 secundă',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 a. 3 l. 1 z. 1 sec.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'peste 3 an',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 l. în urmă',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 a. 3 l. 1 z. 1 sec. în urmă',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 săptămână 10 oră',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 săptămână 6 zi',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 săptămână 6 zi',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'peste 1 săptămână și 6 zi',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 săptămână 1 oră',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'peste o oră',
        // CarbonInterval::days(2)->forHumans()
        '2 zi',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 z. 3 o.',
    ];
}
