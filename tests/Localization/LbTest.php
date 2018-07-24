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

class LbTest extends LocalizationTestCase
{
    const LOCALE = 'lb'; // Luxembourgish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschte Samschdeg um 0:00 Auer',
        // Carbon::now()->subDays(2)->calendar()
        'Sonndeg um 20:49 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Muer um 22:00 Auer',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Haut um 10:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Haut um 2:00 Auer',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Gëschter um 1:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Leschten Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freideg um 0:00 Auer',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekonnen',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1Sek',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekonnen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2Sek',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'from_now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minutt 1 Sekonnen',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2J 3Mo 1D 1Sek',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Woch 10 Stonnen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woch 6 Deeg',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woch 6 Deeg',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Wochen 1 Stonn',
    ];
}
