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
class IwTest extends LocalizationTestCase
{
    public const LOCALE = 'iw'; // iw

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'יום שבת at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'יום ראשון at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'יום שני at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'יום שלישי at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'יום רביעי at 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'יום חמישי at 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'יום שישי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום שלישי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום רביעי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום חמישי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום שישי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום שבת at 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last יום ראשון at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'יום שלישי at 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last יום שלישי at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last יום שני at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last יום ראשון at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last יום שבת at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last יום שישי at 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last יום חמישי at 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last יום רביעי at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last יום שישי at 0:00',
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
        '12:00 לפנה״צ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 לפנה״צ, 12:00 לפנה״צ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 לפנה״צ, 1:30 לפנה״צ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 לפנה״צ, 2:00 לפנה״צ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 לפנה״צ, 6:00 לפנה״צ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 לפנה״צ, 10:00 לפנה״צ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 אחה״צ, 12:00 אחה״צ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 אחה״צ, 5:00 אחה״צ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 אחה״צ, 9:30 אחה״צ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 אחה״צ, 11:00 אחה״צ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'לפני 1 שניה',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'לפני 1 שניה',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'לפני 2 שניה',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'לפני 2 שניה',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'לפני 1 דקה',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'לפני 1 דקה',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'לפני 2 דקה',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'לפני 2 דקה',
        // Carbon::now()->subHours(1)->diffForHumans()
        'לפני 1 שעה',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'לפני 1 שעה',
        // Carbon::now()->subHours(2)->diffForHumans()
        'לפני 2 שעה',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'לפני 2 שעה',
        // Carbon::now()->subDays(1)->diffForHumans()
        'לפני 1 יום',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'לפני 1 יום',
        // Carbon::now()->subDays(2)->diffForHumans()
        'לפני 2 יום',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'לפני 2 יום',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'לפני 1 שבוע',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'לפני 1 שבוע',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'לפני 2 שבוע',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'לפני 2 שבוע',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'לפני 1 חודש',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'לפני 1 חודש',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'לפני 2 חודש',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'לפני 2 חודש',
        // Carbon::now()->subYears(1)->diffForHumans()
        'לפני 1 שנה',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'לפני 1 שנה',
        // Carbon::now()->subYears(2)->diffForHumans()
        'לפני 2 שנה',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'לפני 2 שנה',
        // Carbon::now()->addSecond()->diffForHumans()
        'בעוד 1 שניה',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'בעוד 1 שניה',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 שניה after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 שניה after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 שניה before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 שניה before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 שניה',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 שניה',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 שניה',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 שניה',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'בעוד 1 שניה',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 דקה 1 שניה',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 שנה 3 חודש 1 יום 1 שניה',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'בעוד 3 שנה',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'לפני 5 חודש',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'לפני 2 שנה 3 חודש 1 יום 1 שניה',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 שבוע 10 שעה',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 שבוע 6 יום',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 שבוע 6 יום',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'בעוד 1 שבוע and 6 יום',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 שבוע 1 שעה',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'בעוד 1 שעה',
        // CarbonInterval::days(2)->forHumans()
        '2 יום',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 יום 3 שעה',
    ];
}
