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

class YavTest extends LocalizationTestCase
{
    const LOCALE = 'yav'; // yav

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'séselé at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sɔ́ndiɛ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'móndie at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'muányáŋmóndie at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'metúkpíápɛ at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'kúpélimetúkpiapɛ at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'feléte at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'muányáŋmóndie at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'metúkpíápɛ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kúpélimetúkpiapɛ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'feléte at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'séselé at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last sɔ́ndiɛ at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'muányáŋmóndie at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last muányáŋmóndie at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last móndie at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sɔ́ndiɛ at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last séselé at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last feléte at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last kúpélimetúkpiapɛ at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last metúkpíápɛ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last feléte at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 kiɛmɛ́ɛm cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 kiɛmɛ́ɛm, 12:00 kiɛmɛ́ɛm',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 kiɛmɛ́ɛm, 1:30 kiɛmɛ́ɛm',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 kiɛmɛ́ɛm, 2:00 kiɛmɛ́ɛm',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 kiɛmɛ́ɛm, 6:00 kiɛmɛ́ɛm',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 kiɛmɛ́ɛm, 10:00 kiɛmɛ́ɛm',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 kisɛ́ndɛ, 12:00 kisɛ́ndɛ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 kisɛ́ndɛ, 5:00 kisɛ́ndɛ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 kisɛ́ndɛ, 9:30 kisɛ́ndɛ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 kisɛ́ndɛ, 11:00 kisɛ́ndɛ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'second',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'second',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'second',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'second',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'from_now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minute second',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'year month day second',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'from_now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'week hour',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'week day',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'week day',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'from_now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'week hour',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'from_now',
        // CarbonInterval::days(2)->forHumans()
        'day',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'day hour',
    ];
}
