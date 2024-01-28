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
class MkMkTest extends LocalizationTestCase
{
    public const LOCALE = 'mk_MK'; // Macedonian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утре во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во сабота во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во недела во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во понеделник во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во вторник во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во среда во 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Во четврток во 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Во петок во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во вторник во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во среда во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во четврток во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во петок во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во сабота во 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'Изминатата недела во 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера во 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Денес во 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Денес во 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Утре во 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Во вторник во 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Вчера во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Изминатиот вторник во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Изминатиот понеделник во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Изминатата недела во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Изминатата сабота во 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Изминатиот петок во 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Изминатиот четврток во 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Изминатата среда во 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Изминатиот петок во 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-ви 1-ви 1-ви 1-ви 1-ви',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-ри 1-ви',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-ти 1-ви',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-ти 1-ви',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-ти 1-ви',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-ти 1-ви',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-ми 1-ви',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-ти 2-ри',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-ти',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ви',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-ен',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ам CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 АМ, 12:00 ам',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 АМ, 1:30 ам',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 АМ, 2:00 ам',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 АМ, 6:00 ам',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 АМ, 10:00 ам',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ПМ, 12:00 пм',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ПМ, 5:00 пм',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ПМ, 9:30 пм',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ПМ, 11:00 пм',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-ев',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'пред 1 секунда',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'пред 1 сек.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'пред 2 секунди',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'пред 2 сек.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'пред 1 минута',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'пред 1 мин.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'пред 2 минути',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'пред 2 мин.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'пред 1 час',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'пред 1 час',
        // Carbon::now()->subHours(2)->diffForHumans()
        'пред 2 часа',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'пред 2 часа',
        // Carbon::now()->subDays(1)->diffForHumans()
        'пред 1 ден',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'пред 1 ден',
        // Carbon::now()->subDays(2)->diffForHumans()
        'пред 2 дена',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'пред 2 дена',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'пред 1 седмица',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'пред 1 седмица',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'пред 2 седмици',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'пред 2 седмици',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'пред 1 месец',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'пред 1 месец',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'пред 2 месеци',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'пред 2 месеци',
        // Carbon::now()->subYears(1)->diffForHumans()
        'пред 1 година',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'пред 1 год.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'пред 2 години',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'пред 2 год.',
        // Carbon::now()->addSecond()->diffForHumans()
        'после 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'после 1 сек.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'по 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'по 1 сек.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'пред 1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'пред 1 сек.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 сек.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сек.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'после 1 сек.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минута 1 секунда',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 год. 3 месеци 1 ден 1 сек.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'после 3 години',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'пред 5 месеци',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'пред 2 год. 3 месеци 1 ден 1 сек.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 седмица 10 часа',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дена',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дена',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'после 1 седмица и 6 дена',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 седмици 1 час',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'после час',
        // CarbonInterval::days(2)->forHumans()
        '2 дена',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ден 3 часа',
    ];
}
