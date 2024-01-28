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
class BgTest extends LocalizationTestCase
{
    public const LOCALE = 'bg'; // Bulgarian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утре в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'събота в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'неделя в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'понеделник в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'вторник в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сряда в 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'четвъртък в 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'петък в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'вторник в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сряда в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'четвъртък в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'петък в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'събота в 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'В изминалата неделя в 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера в 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Днес в 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Днес в 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Утре в 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'вторник в 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Вчера в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалия вторник в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалия понеделник в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалата неделя в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалата събота в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалия петък в 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'В изминалия четвъртък в 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'В изминалата сряда в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В изминалия петък в 0:00',
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
        '12:00 преди обяд CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 преди обяд, 12:00 преди обяд',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 преди обяд, 1:30 преди обяд',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 преди обяд, 2:00 преди обяд',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 преди обяд, 6:00 преди обяд',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 преди обяд, 10:00 преди обяд',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 следобед, 12:00 следобед',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 следобед, 5:00 следобед',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 следобед, 9:30 следобед',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 следобед, 11:00 следобед',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-ев',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'преди 1 секунда',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'преди 1 секунда',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'преди 2 секунди',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'преди 2 секунди',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'преди 1 минута',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'преди 1 минута',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'преди 2 минути',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'преди 2 минути',
        // Carbon::now()->subHours(1)->diffForHumans()
        'преди 1 час',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'преди 1 час',
        // Carbon::now()->subHours(2)->diffForHumans()
        'преди 2 часа',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'преди 2 часа',
        // Carbon::now()->subDays(1)->diffForHumans()
        'преди 1 ден',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'преди 1 ден',
        // Carbon::now()->subDays(2)->diffForHumans()
        'преди 2 дни',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'преди 2 дни',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'преди 1 седмица',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'преди 1 седмица',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'преди 2 седмици',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'преди 2 седмици',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'преди 1 месец',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'преди 1 месец',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'преди 2 месеца',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'преди 2 месеца',
        // Carbon::now()->subYears(1)->diffForHumans()
        'преди 1 година',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'преди 1 година',
        // Carbon::now()->subYears(2)->diffForHumans()
        'преди 2 години',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'преди 2 години',
        // Carbon::now()->addSecond()->diffForHumans()
        'след 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'след 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'след 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'след 1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'преди 1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'преди 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 секунди',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'след 1 секунда',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минута 1 секунда',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 години 3 месеца 1 ден 1 секунда',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'след 3 години',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'преди 5 месеца',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'преди 2 години 3 месеца 1 ден 1 секунда',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 седмица 10 часа',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дни',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дни',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'след 1 седмица и 6 дни',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 седмици 1 час',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'след час',
        // CarbonInterval::days(2)->forHumans()
        '2 дни',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ден 3 часа',
    ];
}
