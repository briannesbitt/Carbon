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
class DjeTest extends LocalizationTestCase
{
    public const LOCALE = 'dje'; // Zarma

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Asibti at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Alhadi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Atinni at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Atalaata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Alarba at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Alhamisi at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Alzuma at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Atalaata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Alarba at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Alhamisi at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Alzuma at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Asibti at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Alhadi at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Atalaata at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Atalaata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Atinni at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Alhadi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Asibti at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Alzuma at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Alhamisi at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Alarba at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Alzuma at 00:00',
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
        '12:00 subbaahi CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Subbaahi, 12:00 subbaahi',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Subbaahi, 1:30 subbaahi',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Subbaahi, 2:00 subbaahi',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Subbaahi, 6:00 subbaahi',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Subbaahi, 10:00 subbaahi',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Zaarikay b, 12:00 zaarikay b',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Zaarikay b, 5:00 zaarikay b',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Zaarikay b, 9:30 zaarikay b',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Zaarikay b, 11:00 zaarikay b',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 atinni ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 atinni ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 atinni ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 atinni ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minute ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutes ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 hour ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1h ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 hours ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2h ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 day ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 days ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 alzuma ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 alzuma ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 alzuma ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 alzuma ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 month ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mo ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 months ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mos ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 hari ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 hari ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 hari ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 hari ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 atinni from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 atinni from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 atinni after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 atinni after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 atinni before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 atinni before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 atinni',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 atinni',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 atinni',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 atinni',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 atinni from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute 1 atinni',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 hari 3mos 1d 1 atinni',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 hari from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5mos ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 hari 3mos 1d 1 atinni ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 alzuma 10 hours',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 alzuma 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 alzuma 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 alzuma and 6 days from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 alzuma 1 hour',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'an hour from now',
        // CarbonInterval::days(2)->forHumans()
        '2 days',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3h',
    ];
}
