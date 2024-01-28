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
class CrhUaTest extends LocalizationTestCase
{
    public const LOCALE = 'crh_UA'; // Crimean Turkish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Cumaertesi at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Bazar at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Bazarertesi at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Salı at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Çarşembe at 12:00 ÜE',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Cumaaqşamı at 12:00 ÜE',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Cuma at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Salı at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Çarşembe at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Cumaaqşamı at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Cuma at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Cumaertesi at 12:00 ÜE',
        // Carbon::now()->subDays(2)->calendar()
        'Last Bazar at 8:49 ÜS',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ÜS',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ÜE',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Salı at 12:00 ÜE',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Salı at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Bazarertesi at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Bazar at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Cumaertesi at 12:00 ÜE',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Cuma at 12:00 ÜE',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Cumaaqşamı at 12:00 ÜE',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Çarşembe at 12:00 ÜE',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Cuma at 12:00 ÜE',
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
        '12:00 üe CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ÜE, 12:00 üe',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ÜE, 1:30 üe',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ÜE, 2:00 üe',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ÜE, 6:00 üe',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ÜE, 10:00 üe',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ÜS, 12:00 üs',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ÜS, 5:00 üs',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ÜS, 9:30 üs',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ÜS, 11:00 üs',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ekinci ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ekinci ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ekinci ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ekinci ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 daqqa ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 daqqa ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 daqqa ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 daqqa ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 saat ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 saat ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 saat ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 saat ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 kün ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 kün ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 kün ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 kün ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 afta ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 afta ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 afta ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 afta ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ay ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ay ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ay ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ay ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 yıl ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 yıl ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 yıl ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 yıl ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ekinci from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ekinci from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ekinci after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ekinci after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ekinci before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ekinci before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ekinci',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ekinci',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ekinci',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ekinci',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ekinci from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 daqqa 1 ekinci',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 yıl 3 ay 1 kün 1 ekinci',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 yıl from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ay ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 yıl 3 ay 1 kün 1 ekinci ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 afta 10 saat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 afta 6 kün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 afta 6 kün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 afta and 6 kün from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 afta 1 saat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 saat from now',
        // CarbonInterval::days(2)->forHumans()
        '2 kün',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 kün 3 saat',
    ];
}
