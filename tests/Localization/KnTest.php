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

class KnTest extends LocalizationTestCase
{
    const LOCALE = 'kn'; // Kannada

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಕೊನೆಯ ಶನಿವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::now()->subDays(2)->calendar()
        'ಭಾನುವಾರ, ರಾತ್ರಿ 8:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ನಾಳೆ ರಾತ್ರಿ 10:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ಇಂದು ಮಧ್ಯಾಹ್ನ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಇಂದು ರಾತ್ರಿ 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ನಿನ್ನೆ ರಾತ್ರಿ 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಕೊನೆಯ ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ಮಂಗಳವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ಶುಕ್ರವಾರ, ರಾತ್ರಿ 12:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        ':1ನೇ :1ನೇ',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2ನೇ :1ನೇ',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3ನೇ :1ನೇ',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4ನೇ :1ನೇ',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5ನೇ :1ನೇ',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6ನೇ :1ನೇ',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7ನೇ :2ನೇ',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11ನೇ :2ನೇ',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40ನೇ',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41ನೇ',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ರಾತ್ರಿ, 11:00 ರಾತ್ರಿ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ಕೆಲವು ಕ್ಷಣಗಳು ಹಿಂದೆ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ಹಿಂದೆ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ಸೆಕೆಂಡುಗಳು ಹಿಂದೆ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ಹಿಂದೆ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ಒಂದು ನಿಮಿಷ ಹಿಂದೆ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ಹಿಂದೆ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ನಿಮಿಷ ಹಿಂದೆ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ಹಿಂದೆ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ಒಂದು ಗಂಟೆ ಹಿಂದೆ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ಹಿಂದೆ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ಗಂಟೆ ಹಿಂದೆ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ಹಿಂದೆ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ಒಂದು ದಿನ ಹಿಂದೆ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ಹಿಂದೆ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ದಿನ ಹಿಂದೆ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ಹಿಂದೆ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ಒಂದು ವಾರ ಹಿಂದೆ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ಹಿಂದೆ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ವಾರಗಳು ಹಿಂದೆ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ಹಿಂದೆ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ಒಂದು ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ಹಿಂದೆ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ತಿಂಗಳು ಹಿಂದೆ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ಹಿಂದೆ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ಒಂದು ವರ್ಷ ಹಿಂದೆ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ಹಿಂದೆ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ವರ್ಷ ಹಿಂದೆ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ಹಿಂದೆ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ಕೆಲವು ಕ್ಷಣಗಳು ನಂತರ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's ನಂತರ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ಕೆಲವು ಕ್ಷಣಗಳು',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ಸೆಕೆಂಡುಗಳು',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's ನಂತರ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ಒಂದು ನಿಮಿಷ ಕೆಲವು ಕ್ಷಣಗಳು',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ಒಂದು ವಾರ 10 ಗಂಟೆ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ಒಂದು ವಾರ 6 ದಿನ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ಒಂದು ವಾರ 6 ದಿನ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ವಾರಗಳು ಒಂದು ಗಂಟೆ',
    ];
}
