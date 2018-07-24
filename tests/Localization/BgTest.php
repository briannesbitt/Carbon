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

class BgTest extends LocalizationTestCase
{
    const LOCALE = 'bg'; // Bulgarian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В изминалата събота в 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'неделя в 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утре в 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Днес в 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Днес в 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Вчера в 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В изминалия вторник в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'вторник в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'петък в 0:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'преди няколко секунди',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'преди 1 секунда',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'преди 2 секунди',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'преди 2 секунди',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'преди минута',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'преди 1 минута',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'преди 2 минути',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'преди 2 минути',
        // Carbon::now()->subHours(1)->diffForHumans()
        'преди час',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'преди 1 час',
        // Carbon::now()->subHours(2)->diffForHumans()
        'преди 2 часа',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'преди 2 часа',
        // Carbon::now()->subDays(1)->diffForHumans()
        'преди ден',
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
        'преди месец',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'преди 1 месец',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'преди 2 месеца',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'преди 2 месеца',
        // Carbon::now()->subYears(1)->diffForHumans()
        'преди година',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'преди 1 година',
        // Carbon::now()->subYears(2)->diffForHumans()
        'преди 2 години',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'преди 2 години',
        // Carbon::now()->addSecond()->diffForHumans()
        'след няколко секунди',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'след 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'след няколко секунди',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'след 1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'преди няколко секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'преди 1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'няколко секунди',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 секунди',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'след 1 секунда',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'минута няколко секунди',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 години 3 месеца 1 ден 1 секунда',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 седмица 10 часа',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дни',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 седмица 6 дни',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 седмици час',
    ];
}
