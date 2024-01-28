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
class TgTest extends LocalizationTestCase
{
    public const LOCALE = 'tg'; // Tajik

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Пагоҳ соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'шанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'якшанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'душанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сешанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'чоршанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'панҷшанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ҷумъаи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сешанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'чоршанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'панҷшанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ҷумъаи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'шанбеи ҳафтаи оянда соати 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'якшанбеи ҳафтаи гузашта соати 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Дирӯз соати 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Имрӯз соати 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Имрӯз соати 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Пагоҳ соати 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сешанбеи ҳафтаи оянда соати 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Дирӯз соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Дирӯз соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сешанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'душанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'якшанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'шанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ҷумъаи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'панҷшанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'чоршанбеи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ҷумъаи ҳафтаи гузашта соати 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-ум 1-ум 1-ум 1-ум 1-ум',
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
        '7-ум 1-ум',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-ум 2-юм',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-ум',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ум',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-ум',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 шаб CET',
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
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 шаб, 9:30 шаб',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 шаб, 11:00 шаб',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-ıncı',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'якчанд сония пеш',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'якчанд сония пеш',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 сония пеш',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 сония пеш',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'як дақиқа пеш',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'як дақиқа пеш',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 дақиқа пеш',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 дақиқа пеш',
        // Carbon::now()->subHours(1)->diffForHumans()
        'як соат пеш',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'як соат пеш',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 соат пеш',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 соат пеш',
        // Carbon::now()->subDays(1)->diffForHumans()
        'як рӯз пеш',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'як рӯз пеш',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 рӯз пеш',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 рӯз пеш',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'як ҳафта пеш',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'як ҳафта пеш',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ҳафта пеш',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ҳафта пеш',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'як моҳ пеш',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'як моҳ пеш',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 моҳ пеш',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 моҳ пеш',
        // Carbon::now()->subYears(1)->diffForHumans()
        'як сол пеш',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'як сол пеш',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 сол пеш',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 сол пеш',
        // Carbon::now()->addSecond()->diffForHumans()
        'баъди якчанд сония',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'баъди якчанд сония',
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
        'якчанд сония',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 сония',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сония',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'баъди якчанд сония',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'як дақиқа якчанд сония',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 сол 3 моҳ як рӯз якчанд сония',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'баъди 3 сол',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 моҳ пеш',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 сол 3 моҳ як рӯз якчанд сония пеш',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'як ҳафта 10 соат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'як ҳафта 6 рӯз',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'як ҳафта 6 рӯз',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'баъди як ҳафта ва 6 рӯз',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ҳафта як соат',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'баъди як соат',
        // CarbonInterval::days(2)->forHumans()
        '2 рӯз',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'як рӯз 3 соат',
    ];
}
