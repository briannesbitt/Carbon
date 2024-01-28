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
class NaqTest extends LocalizationTestCase
{
    public const LOCALE = 'naq'; // Nama

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Satertaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sontaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mantaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Denstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wunstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Dondertaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Fraitaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Denstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Wunstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dondertaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Fraitaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Satertaxtsees at 12:00 ǁgoagas',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sontaxtsees at 8:49 ǃuias',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ǃuias',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ǁgoagas',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Denstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Denstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mantaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sontaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Satertaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Fraitaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Dondertaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Wunstaxtsees at 12:00 ǁgoagas',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Fraitaxtsees at 12:00 ǁgoagas',
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
        '12:00 ǁgoagas CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ǁgoagas, 12:00 ǁgoagas',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ǁgoagas, 1:30 ǁgoagas',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ǁgoagas, 2:00 ǁgoagas',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ǁgoagas, 6:00 ǁgoagas',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ǁgoagas, 10:00 ǁgoagas',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ǃuias, 12:00 ǃuias',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ǃuias, 5:00 ǃuias',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ǃuias, 9:30 ǃuias',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ǃuias, 11:00 ǃuias',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 second ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 seconds ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minutga ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutga ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutga ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minutga ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ǂgaes ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ǂgaes ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ǂgaes ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ǂgaes ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ǀhobas ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ǀhobas ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ǀhobas ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ǀhobas ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 hû ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 hû ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hû ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 hû ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ǁaub ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ǁaub ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ǁaub ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ǁaub ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 kurigu ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 kurigu ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 kurigu ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 kurigu ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 second from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1s from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 second after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 second before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 second',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 seconds',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1s from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutga 1 second',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 kurigu 3 ǁaub 1 ǀhobas 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 kurigu from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ǁaub ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 kurigu 3 ǁaub 1 ǀhobas 1s ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 hû 10 ǂgaes',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hû 6 ǀhobas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hû 6 ǀhobas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 hû and 6 ǀhobas from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hû 1 ǂgaes',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ǂgaes from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ǀhobas',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ǀhobas 3 ǂgaes',
    ];
}
