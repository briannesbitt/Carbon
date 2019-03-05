<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Localization;

class LuyTest extends LocalizationTestCase
{
    const LOCALE = 'luy';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumamosi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumapiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumatatu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumanne at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumatano at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Murwa wa Kanne at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Murwa wa Katano at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumanne at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumatano at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Murwa wa Kanne at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Murwa wa Katano at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumamosi at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Jumapiri at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumanne at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumanne at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumatatu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumapiri at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumamosi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Murwa wa Katano at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Murwa wa Kanne at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Jumatano at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Murwa wa Katano at 00:00',
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
        '12:00 am cet',
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
        '1 liliino ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 liliino ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 liliino ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 liliino ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 omundu ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 omundu ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 omundu ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 omundu ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ekengele ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ekengele ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ekengele ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ekengele ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 luno ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 luno ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 luno ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 luno ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 olutambi ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 olutambi ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 olutambi ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 olutambi ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 kumwesi ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 kumwesi ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 kumwesi ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 kumwesi ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 liliino ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 liliino ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 liliino ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 liliino ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 liliino from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 liliino from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 liliino after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 liliino after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 liliino before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 liliino before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 liliino',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 liliino',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 liliino',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 liliino',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 liliino from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 omundu 1 liliino',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 liliino 3 kumwesi 1 luno 1 liliino',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 liliino from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 kumwesi ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 liliino 3 kumwesi 1 luno 1 liliino ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 olutambi 10 ekengele',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 olutambi 6 luno',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 olutambi 6 luno',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 olutambi and 6 luno from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 olutambi 1 ekengele',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ekengele from now',
        // CarbonInterval::days(2)->forHumans()
        '2 luno',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 luno 3 ekengele',
    ];
}
