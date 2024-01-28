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
class LbLuTest extends LocalizationTestCase
{
    public const LOCALE = 'lb_LU'; // Luxembourgish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Muer um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Samschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sonndeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Méindeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mëttwoch um 0:00 Auer',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Donneschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Freideg um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Mëttwoch um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Donneschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freideg um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Samschdeg um 0:00 Auer',
        // Carbon::now()->subDays(2)->calendar()
        'Leschte Sonndeg um 20:49 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Gëschter um 22:00 Auer',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Haut um 10:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Haut um 2:00 Auer',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Muer um 1:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Gëschter um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Gëschter um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschten Dënschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschte Méindeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschte Sonndeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschte Samschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Leschte Freideg um 0:00 Auer',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Leschten Donneschdeg um 0:00 Auer',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Leschte Mëttwoch um 0:00 Auer',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Leschte Freideg um 0:00 Auer',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1. 1. 1. 1. 1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2. 1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3. 1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4. 1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5. 1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6. 1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7. 1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11. 2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100.',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 moies CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 moies, 12:00 moies',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 moies, 1:30 moies',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 moies, 2:00 moies',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 moies, 6:00 moies',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 moies, 10:00 moies',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 mëttes, 12:00 mëttes',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 mëttes, 5:00 mëttes',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 mëttes, 9:30 mëttes',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 mëttes, 11:00 mëttes',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'virun 1 Sekonn',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'virun 1Sek',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'virun 2 Sekonnen',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'virun 2Sek',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'virun 1 Minutt',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'virun 1M',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'virun 2 Minutten',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'virun 2M',
        // Carbon::now()->subHours(1)->diffForHumans()
        'virun 1 Stonn',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'virun 1Sto',
        // Carbon::now()->subHours(2)->diffForHumans()
        'virun 2 Stonnen',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'virun 2Sto',
        // Carbon::now()->subDays(1)->diffForHumans()
        'virun 1 Dag',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'virun 1D',
        // Carbon::now()->subDays(2)->diffForHumans()
        'virun 2 Deeg',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'virun 2D',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'virun 1 Woch',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'virun 1Wo',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'virun 2 Wochen',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'virun 2Wo',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'virun 1 Mount',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'virun 1Mo',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'virun 2 Méint',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'virun 2Mo',
        // Carbon::now()->subYears(1)->diffForHumans()
        'virun 1 Joer',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'virun 1J',
        // Carbon::now()->subYears(2)->diffForHumans()
        'virun 2 Joer',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'virun 2J',
        // Carbon::now()->addSecond()->diffForHumans()
        'an 1 Sekonn',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'an 1Sek',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Sekonn duerno',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1Sek duerno',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Sekonn virdrun',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1Sek virdrun',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekonn',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1Sek',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekonnen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2Sek',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'an 1Sek',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minutt 1 Sekonn',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2J 3Mo 1D 1Sek',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'an 3 Joer',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'virun 5Mo',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'virun 2J 3Mo 1D 1Sek',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Woch 10 Stonnen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woch 6 Deeg',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Woch 6 Deeg',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'an 1 Woch an 6 Deeg',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Wochen 1 Stonn',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'an 1 Stonn',
        // CarbonInterval::days(2)->forHumans()
        '2 Deeg',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1D 3Sto',
    ];
}
