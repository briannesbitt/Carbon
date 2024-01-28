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
class OmKeTest extends LocalizationTestCase
{
    public const LOCALE = 'om_KE'; // Oromo

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sanbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dilbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wiixata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Roobii at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kamiisa at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jimaata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Roobii at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kamiisa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jimaata at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sanbata at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Dilbata at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Qibxata at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Qibxata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Wiixata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Dilbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sanbata at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jimaata at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Kamiisa at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Roobii at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Jimaata at 00:00',
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
        '12:00 wd CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 WD, 12:00 wd',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 WD, 1:30 wd',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 WD, 2:00 wd',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 WD, 6:00 wd',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 WD, 10:00 wd',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 WB, 12:00 wb',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 WB, 5:00 wb',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 WB, 9:30 wb',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 WB, 11:00 wb',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'sekoondii 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'sekoondii 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'sekoondii 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'sekoondii 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'daqiiqaa 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'daqiiqaa 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'daqiiqaa 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'daqiiqaa 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'saʼaatii 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'saʼaatii 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'saʼaatii 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'saʼaatii 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'guyyaa 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'guyyaa 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'guyyaa 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'guyyaa 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'torban 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'torban 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'torban 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'torban 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ji’a 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ji’a 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ji’a 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ji’a 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'wggoota 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'wggoota 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'wggoota 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'wggoota 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'sekoondii 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sekoondii 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'sekoondii 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'sekoondii 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'sekoondii 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'sekoondii 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sekoondii 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'sekoondii 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'sekoondii 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'sekoondii 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sekoondii 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'daqiiqaa 1 sekoondii 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'wggoota 2 ji’a 3 guyyaa 1 sekoondii 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'wggoota 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ji’a 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'wggoota 2 ji’a 3 guyyaa 1 sekoondii 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'torban 1 saʼaatii 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'torban 1 guyyaa 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'torban 1 guyyaa 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'torban 1 and guyyaa 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'torban 2 saʼaatii 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'saʼaatii 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'guyyaa 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'guyyaa 1 saʼaatii 3',
    ];
}
