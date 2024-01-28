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
class NdsDeTest extends LocalizationTestCase
{
    public const LOCALE = 'nds_DE'; // Low German

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sünnavend at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sünndag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Maandag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dingsdag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Middeweek at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Dunnersdag at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Freedag at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dingsdag at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Middeweek at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dunnersdag at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Freedag at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sünnavend at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sünndag at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dingsdag at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Dingsdag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Maandag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sünndag at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sünnavend at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Freedag at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Dunnersdag at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Middeweek at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Freedag at 12:00 AM',
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
        'vör 1 Sekunn',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'vör 1s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'vör 2 Sekunn',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'vör 2s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'vör 1 Minuut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'vör 1m',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'vör 2 Minuut',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'vör 2m',
        // Carbon::now()->subHours(1)->diffForHumans()
        'vör 1 Stünn',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'vör 1St',
        // Carbon::now()->subHours(2)->diffForHumans()
        'vör 2 Stünn',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'vör 2St',
        // Carbon::now()->subDays(1)->diffForHumans()
        'vör 1 Dag',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'vör 1D',
        // Carbon::now()->subDays(2)->diffForHumans()
        'vör 2 Dag',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'vör 2D',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'vör 1 Week',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'vör 1W',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'vör 2 Week',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'vör 2W',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'vör 1 Maand',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'vör 1M',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'vör 2 Maand',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'vör 2M',
        // Carbon::now()->subYears(1)->diffForHumans()
        'vör 1 Johr',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'vör 1J',
        // Carbon::now()->subYears(2)->diffForHumans()
        'vör 2 Johr',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'vör 2J',
        // Carbon::now()->addSecond()->diffForHumans()
        'in 1 Sekunn',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'in 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 Sekunn later',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s later',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 Sekunn vörher',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s vörher',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 Sekunn',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 Sekunn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'in 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 Minuut 1 Sekunn',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2J 3M 1D 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'in 3 Johr',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'vör 5M',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'vör 2J 3M 1D 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Week 10 Stünn',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Week 6 Dag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Week 6 Dag',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'in 1 Week and 6 Dag',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Week 1 Stünn',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'in een Stünn',
        // CarbonInterval::days(2)->forHumans()
        '2 Dag',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1D 3St',
    ];
}
