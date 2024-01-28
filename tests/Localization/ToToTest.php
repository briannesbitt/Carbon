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
class ToToTest extends LocalizationTestCase
{
    public const LOCALE = 'to_TO'; // Tonga

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tokonaki at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sāpate at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Mōnite at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tūsite at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Pulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Tuʻapulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Falaite at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tūsite at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Pulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tuʻapulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Falaite at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tokonaki at 12:00 hengihengi',
        // Carbon::now()->subDays(2)->calendar()
        'Last Sāpate at 8:49 efiafi',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 efiafi',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 hengihengi',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tūsite at 12:00 hengihengi',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tūsite at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Mōnite at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sāpate at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tokonaki at 12:00 hengihengi',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Falaite at 12:00 hengihengi',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Tuʻapulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Pulelulu at 12:00 hengihengi',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Falaite at 12:00 hengihengi',
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
        '12:00 hengihengi CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 hengihengi, 12:00 hengihengi',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 hengihengi, 1:30 hengihengi',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 hengihengi, 2:00 hengihengi',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 hengihengi, 6:00 hengihengi',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 hengihengi, 10:00 hengihengi',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 efiafi, 12:00 efiafi',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 efiafi, 5:00 efiafi',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 efiafi, 9:30 efiafi',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 efiafi, 11:00 efiafi',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekoni ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekoni ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekoni ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekoni ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 miniti ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 miniti ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 miniti ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 miniti ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 houa ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 houa ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 houa ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 houa ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ʻaho ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ʻaho ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ʻaho ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ʻaho ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 Sapate ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 Sapate ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 Sapate ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 Sapate ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mahina ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mahina ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mahina ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mahina ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 fitu ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 fitu ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 fitu ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 fitu ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekoni from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 sekoni from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekoni after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekoni after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekoni before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekoni before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekoni',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekoni',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekoni',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekoni',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 sekoni from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 miniti 1 sekoni',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 fitu 3 mahina 1 ʻaho 1 sekoni',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 fitu from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mahina ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 fitu 3 mahina 1 ʻaho 1 sekoni ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Sapate 10 houa',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Sapate 6 ʻaho',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Sapate 6 ʻaho',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 Sapate and 6 ʻaho from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Sapate 1 houa',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 houa from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ʻaho',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ʻaho 3 houa',
    ];
}
