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
class BeTest extends LocalizationTestCase
{
    public const LOCALE = 'be'; // Belarusian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Заўтра ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У субота ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У нядзеля ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У панядзелак ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У аўторак ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У серада ў 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'У чацвер ў 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'У пятніца ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У аўторак ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У серада ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У чацвер ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У пятніца ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У субота ў 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'У мінулую нядзеля ў 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Учора ў 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Сёння ў 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Сёння ў 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Заўтра ў 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У аўторак ў 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Учора ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Учора ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулы аўторак ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулы панядзелак ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулую нядзеля ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулую субота ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулую пятніца ў 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'У мінулы чацвер ў 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'У мінулую серада ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У мінулую пятніца ў 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-ы 1-ы 1-га 1-ы 1-ы',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-га 1-ы',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-га 1-ы',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-га 1-ы',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-га 1-ы',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-га 1-ы',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-га 1-ы',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-га 2-і',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-ы',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ы',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-ы',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ночы CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ночы, 12:00 ночы',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ночы, 1:30 ночы',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ночы, 2:00 ночы',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 раніцы, 6:00 раніцы',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 раніцы, 10:00 раніцы',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 дня, 12:00 дня',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 вечара, 5:00 вечара',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 вечара, 9:30 вечара',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 вечара, 11:00 вечара',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секунду таму',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 секунду таму',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунды таму',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 секунды таму',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 хвіліну таму',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 хвіліну таму',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 хвіліны таму',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 хвіліны таму',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 гадзіну таму',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 гадзіну таму',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 гадзіны таму',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 гадзіны таму',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 дзень таму',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 дн таму',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 дні таму',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 дн таму',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 тыдзень таму',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 тыдзень таму',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 тыдні таму',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 тыдні таму',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 месяц таму',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 месяц таму',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 месяцы таму',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 месяцы таму',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 год таму',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 год таму',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 гады таму',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 гады таму',
        // Carbon::now()->addSecond()->diffForHumans()
        'праз 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'праз 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секунду пасля',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 секунду пасля',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секунду да',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 секунду да',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 сек',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунды',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сек',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'праз 1 секунду',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 хвіліна 1 секунда',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 гады 3 месяцы 1 дн 1 сек',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'праз 3 гады',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 месяцаў таму',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 гады 3 месяцы 1 дн 1 секунду таму',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 тыдзень 10 гадзін',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тыдзень 6 дзён',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тыдзень 6 дзён',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'праз 1 тыдзень і 6 дзён',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 тыдні 1 гадзіну',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'праз гадзіну',
        // CarbonInterval::days(2)->forHumans()
        '2 дні',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 дн 3 гадзіны',
    ];
}
