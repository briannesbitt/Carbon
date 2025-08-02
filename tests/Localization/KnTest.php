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
class KnTest extends LocalizationTestCase
{
    public const LOCALE = 'kn'; // Kannada

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ನಾಳೆ ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಶನಿವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಭಾನುವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಸೋಮವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಬುಧವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ಗುರುವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ಶುಕ್ರವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಬುಧವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಗುರುವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಶುಕ್ರವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಶನಿವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::now()->subDays(2)->calendar()
        'ಕೊನೆಯ ಭಾನುವಾರ, ರಾತ್ರಿ 8:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ನಿನ್ನೆ ರಾತ್ರಿ 10:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ಇಂದು ಮಧ್ಯಾಹ್ನ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಇಂದು ರಾತ್ರಿ 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ನಾಳೆ ರಾತ್ರಿ 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ನಿನ್ನೆ ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ನಿನ್ನೆ ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಸೋಮವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಭಾನುವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಶನಿವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಶುಕ್ರವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ಕೊನೆಯ ಗುರುವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ಕೊನೆಯ ಬುಧವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಕೊನೆಯ ಶುಕ್ರವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1ನೇ 1ನೇ 1ನೇ 1ನೇ 1ನೇ',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2ನೇ 1ನೇ',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3ನೇ 1ನೇ',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4ನೇ 1ನೇ',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5ನೇ 1ನೇ',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6ನೇ 1ನೇ',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7ನೇ 2ನೇ',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11ನೇ 2ನೇ',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40ನೇ',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41ನೇ',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100ನೇ',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ರಾತ್ರಿ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ರಾತ್ರಿ, 12:00 ರಾತ್ರಿ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ರಾತ್ರಿ, 1:30 ರಾತ್ರಿ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ರಾತ್ರಿ, 2:00 ರಾತ್ರಿ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ಬೆಳಿಗ್ಗೆ, 6:00 ಬೆಳಿಗ್ಗೆ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ಮಧ್ಯಾಹ್ನ, 10:00 ಮಧ್ಯಾಹ್ನ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ಮಧ್ಯಾಹ್ನ, 12:00 ಮಧ್ಯಾಹ್ನ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ಸಂಜೆ, 5:00 ಸಂಜೆ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ರಾತ್ರಿ, 9:30 ರಾತ್ರಿ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ರಾತ್ರಿ, 11:00 ರಾತ್ರಿ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0ನೇ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ಸೆಕೆಂಡ್ ಹಿಂದೆ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ಸೆಕೆಂಡ್ ಹಿಂದೆ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ಸೆಕೆಂಡುಗಳು ಹಿಂದೆ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ಸೆಕೆಂಡುಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ನಿಮಿಷ ಹಿಂದೆ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ನಿಮಿಷ ಹಿಂದೆ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ನಿಮಿಷಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ನಿಮಿಷಗಳು ಹಿಂದೆ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ಗಂಟೆ ಹಿಂದೆ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ಗಂಟೆ ಹಿಂದೆ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ಗಂಟೆಗಳು ಹಿಂದೆ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ಗಂಟೆಗಳು ಹಿಂದೆ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ದಿನ ಹಿಂದೆ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ದಿನ ಹಿಂದೆ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ದಿನಗಳು ಹಿಂದೆ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ದಿನಗಳು ಹಿಂದೆ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ವಾರ ಹಿಂದೆ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ವಾರ ಹಿಂದೆ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ವಾರಗಳು ಹಿಂದೆ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ವಾರಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ವರ್ಷ ಹಿಂದೆ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ವರ್ಷ ಹಿಂದೆ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ವರ್ಷಗಳು ಹಿಂದೆ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ವರ್ಷಗಳು ಹಿಂದೆ',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ಸೆಕೆಂಡ್ ನಂತರ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ಸೆಕೆಂಡ್ ನಂತರ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ಸೆಕೆಂಡ್',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ಸೆಕೆಂಡ್',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ಸೆಕೆಂಡುಗಳು',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ಸೆಕೆಂಡುಗಳು',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ಸೆಕೆಂಡ್ ನಂತರ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ನಿಮಿಷ 1 ಸೆಕೆಂಡ್',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ವರ್ಷಗಳು 3 ತಿಂಗಳು 1 ದಿನ 1 ಸೆಕೆಂಡ್',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ವರ್ಷಗಳು ನಂತರ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ವರ್ಷಗಳು 3 ತಿಂಗಳು 1 ದಿನ 1 ಸೆಕೆಂಡ್ ಹಿಂದೆ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ವಾರ 10 ಗಂಟೆಗಳು',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ವಾರ 6 ದಿನಗಳು',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ವಾರ 6 ದಿನಗಳು',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ವಾರ, 6 ದಿನಗಳು ನಂತರ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ವಾರಗಳು 1 ಗಂಟೆ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ಒಂದು ಗಂಟೆ ನಂತರ',
        // CarbonInterval::days(2)->forHumans()
        '2 ದಿನಗಳು',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ದಿನ 3 ಗಂಟೆಗಳು',
    ];
}
