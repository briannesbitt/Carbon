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

class BeTest extends LocalizationTestCase
{
    const LOCALE = 'be'; // Belarusian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У мінулую суботу ў 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'У нядзелю ў 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Заўтра ў 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Сёння ў 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Сёння ў 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Учора ў 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У мінулы аўторак ў 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У аўторак ў 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У пятніцу ў 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        '1-га 1-ы',
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
        '7-га 2-і',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-га 2-і',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-ы',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ы',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 вечара, 11:00 вечара',
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
        '1 дзень таму',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ні таму',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ні таму',
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
        '1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 секунду',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунды',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 секунды',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'праз 1 секунду',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 хвіліну 1 секунду',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 гады 3 месяцы 1 дзень 1 секунду',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 тыдзень 10 гадзін',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тыдзень 6 дзён',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тыдзень 6 дзён',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 тыдні 1 гадзіну',
    ];
}
