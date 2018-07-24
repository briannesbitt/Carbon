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

class MnTest extends LocalizationTestCase
{
    const LOCALE = 'mn'; // Mongolian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Saturday at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sunday at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Yesterday at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Friday at 12:00 AM',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секундын өмнө',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1сн өмнө',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секундын өмнө',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2сн өмнө',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 минутын өмнө',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1мн өмнө',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минутын өмнө',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2мн өмнө',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 цагийн өмнө',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1цн өмнө',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 цагийн өмнө',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2цн өмнө',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 хоногийн өмнө',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 өдөрн өмнө',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 хоногийн өмнө',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 өдөрн өмнө',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 долоо хоногн өмнө',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 долоо хоногн өмнө',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 долоо хоногн өмнө',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 долоо хоногн өмнө',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 сарын өмнө',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 сарн өмнө',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 сарын өмнө',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 сарн өмнө',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 жилийн өмнө',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 жилн өмнө',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 жилийн өмнө',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 жилн өмнө',
        // Carbon::now()->addSecond()->diffForHumans()
        'одоогоос 1 секундын дараа',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'одоогоос 1с',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секундын дараа',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1сн дараа',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секундын өмнө',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1сн өмнө',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунд',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1с',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунд',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2с',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'одоогоос 1с',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минут 1 секунд',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 жил 3 сар 1 өдөр 1с',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 10 цаг',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 6 өдөр',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 6 өдөр',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 долоо хоног 1 цаг',
    ];
}
