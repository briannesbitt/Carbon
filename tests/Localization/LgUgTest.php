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
class LgUgTest extends LocalizationTestCase
{
    public const LOCALE = 'lg_UG'; // Ganda

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lwamukaaga at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabiiti at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Balaza at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lwakubiri at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lwakusatu at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Lwakuna at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Lwakutaano at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwakubiri at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwakusatu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwakuna at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwakutaano at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwamukaaga at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sabiiti at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lwakubiri at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Lwakubiri at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Balaza at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sabiiti at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Lwamukaaga at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Lwakutaano at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Lwakuna at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Lwakusatu at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Lwakutaano at 12:00 AM',
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
        '1 kyʼokubiri ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 kyʼokubiri ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 kyʼokubiri ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 kyʼokubiri ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ddakiika 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ddakiika 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ddakiika 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ddakiika 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'saawa 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'saawa 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'saawa 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'saawa 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 lunaku ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 lunaku ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 lunaku ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 lunaku ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 sabbiiti ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 sabbiiti ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 sabbiiti ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 sabbiiti ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 njuba ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 njuba ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 njuba ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 njuba ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 mwaaka ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 mwaaka ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 mwaaka ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 mwaaka ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 kyʼokubiri from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 kyʼokubiri from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 kyʼokubiri after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 kyʼokubiri after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 kyʼokubiri before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 kyʼokubiri before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 kyʼokubiri',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 kyʼokubiri',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 kyʼokubiri',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 kyʼokubiri',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 kyʼokubiri from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ddakiika 1 1 kyʼokubiri',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 mwaaka 3 njuba 1 lunaku 1 kyʼokubiri',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 mwaaka from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 njuba ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 mwaaka 3 njuba 1 lunaku 1 kyʼokubiri ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sabbiiti saawa 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sabbiiti 6 lunaku',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sabbiiti 6 lunaku',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 sabbiiti and 6 lunaku from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sabbiiti saawa 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'saawa 1 from now',
        // CarbonInterval::days(2)->forHumans()
        '2 lunaku',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 lunaku saawa 3',
    ];
}
