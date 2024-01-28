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
class RnTest extends LocalizationTestCase
{
    public const LOCALE = 'rn'; // Kirundi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ku wa gatandatu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ku w’indwi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ku wa mbere at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ku wa kabiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ku wa gatatu at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Ku wa kane at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Ku wa gatanu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa kabiri at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa gatatu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa kane at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa gatanu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa gatandatu at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Ku w’indwi at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ku wa kabiri at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ku wa kabiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ku wa mbere at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ku w’indwi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ku wa gatandatu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ku wa gatanu at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Ku wa kane at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Ku wa gatatu at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Ku wa gatanu at 00:00',
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
        '12:00 z.mu. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Z.MU., 12:00 z.mu.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Z.MU., 1:30 z.mu.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Z.MU., 2:00 z.mu.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Z.MU., 6:00 z.mu.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Z.MU., 10:00 z.mu.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Z.MW., 12:00 z.mw.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Z.MW., 5:00 z.mw.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Z.MW., 9:30 z.mw.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Z.MW., 11:00 z.mw.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'inguvu 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'inguvu 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'inguvu 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'inguvu 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'iminuta 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'iminuta 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'iminuta 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'iminuta 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'amasaha 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'amasaha 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'amasaha 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'amasaha 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'imisi 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'imisi 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'imisi 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'imisi 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'indwi 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'indwi 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'indwi 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'indwi 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'amezi 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'amezi 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'amezi 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'amezi 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'imyaka 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'imyaka 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'imyaka 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'imyaka 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'inguvu 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'inguvu 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'inguvu 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'inguvu 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'inguvu 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'inguvu 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'inguvu 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'inguvu 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'inguvu 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'inguvu 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'inguvu 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'iminuta 1 inguvu 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'imyaka 2 amezi 3 imisi 1 inguvu 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'imyaka 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'amezi 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'imyaka 2 amezi 3 imisi 1 inguvu 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'indwi 1 amasaha 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'indwi 1 imisi 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'indwi 1 imisi 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'indwi 1 and imisi 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'indwi 2 amasaha 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'amasaha 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'imisi 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'imisi 1 amasaha 3',
    ];
}
