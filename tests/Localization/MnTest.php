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
class MnTest extends LocalizationTestCase
{
    public const LOCALE = 'mn'; // Mongolian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Бямба at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ням at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Даваа at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Мягмар at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Лхагва at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Пүрэв at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Баасан at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Мягмар at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Лхагва at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Пүрэв at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Баасан at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Бямба at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Ням at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Мягмар at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Мягмар at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Даваа at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ням at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Бямба at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Баасан at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Пүрэв at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Лхагва at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Баасан at 00:00',
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
        '12:00 өглөө CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 өглөө, 12:00 өглөө',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 өглөө, 1:30 өглөө',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 өглөө, 2:00 өглөө',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 өглөө, 6:00 өглөө',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 өглөө, 10:00 өглөө',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 орой, 12:00 орой',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 орой, 5:00 орой',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 орой, 9:30 орой',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 орой, 11:00 орой',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секундын өмнө',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1с өмнө',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секундын өмнө',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2с өмнө',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 минутын өмнө',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1м өмнө',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минутын өмнө',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2м өмнө',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 цагийн өмнө',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1ц өмнө',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 цагийн өмнө',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2ц өмнө',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 хоногийн өмнө',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 хоногийн өмнө',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 хоногийн өмнө',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 хоногийн өмнө',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 долоо хоногийн өмнө',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 долоо хоногийн өмнө',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 долоо хоногийн өмнө',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 долоо хоногийн өмнө',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 сарын өмнө',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 сарын өмнө',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 сарын өмнө',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 сарын өмнө',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 жилийн өмнө',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 жилийн өмнө',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 жилийн өмнө',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 жилийн өмнө',
        // Carbon::now()->addSecond()->diffForHumans()
        'одоогоос 1 секундын дараа',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'одоогоос 1с',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секундын дараа',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1с дараа',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секундын өмнө',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1с өмнө',
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
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'одоогоос 3 жилийн дараа',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 сарын өмнө',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 жил 3 сар 1 өдөр 1с өмнө',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 10 цаг',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 6 өдөр',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 долоо хоног 6 өдөр',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'одоогоос 1 долоо хоног, 6 хоногийн дараа',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 долоо хоног 1 цаг',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'одоогоос 1 цагийн дараа',
        // CarbonInterval::days(2)->forHumans()
        '2 өдөр',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 өдөр 3ц',
    ];
}
