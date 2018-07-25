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

class TgTest extends LocalizationTestCase
{
    const LOCALE = 'tg'; // Tajik

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'шанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'якшанбеи ҳафтаи оянда соати 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Пагоҳ соати 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Имрӯз соати 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Имрӯз соати 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Дирӯз соати 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сешанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сешанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ҷумъаи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        '1-ум 1-ум',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-юм 1-ум',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-юм 1-ум',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-ум 1-ум',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-ум 1-ум',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-ум 1-ум',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-ум 2-юм',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-ум 2-юм',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-ум',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ум',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 шаб, 12:00 шаб',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 шаб, 1:30 шаб',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 шаб, 2:00 шаб',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 субҳ, 6:00 субҳ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 субҳ, 10:00 субҳ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 рӯз, 12:00 рӯз',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 бегоҳ, 5:00 бегоҳ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 шаб, 11:00 шаб',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'якчанд сония пеш',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's пеш',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 сония пеш',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's пеш',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'як дақиқа пеш',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min пеш',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 дақиқа пеш',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min пеш',
        // Carbon::now()->subHours(1)->diffForHumans()
        'як соат пеш',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h пеш',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 соат пеш',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h пеш',
        // Carbon::now()->subDays(1)->diffForHumans()
        'як рӯз пеш',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd пеш',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 рӯз пеш',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd пеш',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'як ҳафта пеш',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w пеш',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ҳафта пеш',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w пеш',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'як моҳ пеш',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm пеш',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 моҳ пеш',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm пеш',
        // Carbon::now()->subYears(1)->diffForHumans()
        'як сол пеш',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y пеш',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 сол пеш',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y пеш',
        // Carbon::now()->addSecond()->diffForHumans()
        'баъди якчанд сония',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'баъди s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'якчанд сония',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 сония',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'баъди s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'як дақиқа якчанд сония',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'як ҳафта 10 соат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'як ҳафта 6 рӯз',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'як ҳафта 6 рӯз',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ҳафта як соат',
    ];
}
