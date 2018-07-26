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

class KkTest extends LocalizationTestCase
{
    const LOCALE = 'kk'; // Kazakh

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ертең сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'жексенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'дүйсенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сейсенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сәрсенбі сағат 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'бейсенбі сағат 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'жұма сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сейсенбі сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сәрсенбі сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'бейсенбі сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'жұма сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сенбі сағат 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Өткен аптаның жексенбі сағат 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кеше сағат 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Бүгін сағат 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Бүгін сағат 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ертең сағат 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сейсенбі сағат 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Кеше сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кеше сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптаның сейсенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптаның дүйсенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптаның жексенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптаның сенбі сағат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптаның жұма сағат 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Өткен аптаның бейсенбі сағат 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Өткен аптаның сәрсенбі сағат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Өткен аптаның жұма сағат 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-ші 1-ші 1-ші 1-ші 1-ші',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-ші 1-ші',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-ші 1-ші',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-ші 1-ші',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-ші 1-ші',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-шы 1-ші',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-ші 1-ші',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-ші 2-ші',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-шы',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ші',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-ші',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-ші',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'бірнеше секунд бұрын',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 секунд бұрын',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунд бұрын',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 секунд бұрын',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'бір минут бұрын',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 минут бұрын',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минут бұрын',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 минут бұрын',
        // Carbon::now()->subHours(1)->diffForHumans()
        'бір сағат бұрын',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 сағат бұрын',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 сағат бұрын',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 сағат бұрын',
        // Carbon::now()->subDays(1)->diffForHumans()
        'бір күн бұрын',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 күн бұрын',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 күн бұрын',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 күн бұрын',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 апта бұрын',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 апта бұрын',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 апта бұрын',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 апта бұрын',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'бір ай бұрын',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ай бұрын',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ай бұрын',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ай бұрын',
        // Carbon::now()->subYears(1)->diffForHumans()
        'бір жыл бұрын',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 жыл бұрын',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 жыл бұрын',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 жыл бұрын',
        // Carbon::now()->addSecond()->diffForHumans()
        'бірнеше секунд ішінде',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 секунд ішінде',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'бірнеше секунд кейін',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 секунд кейін',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'бірнеше секунд бұрын',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 секунд бұрын',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'бірнеше секунд',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 секунд',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунд',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 секунд',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 секунд ішінде',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'бір минут бірнеше секунд',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 жыл 3 ай 1 күн 1 секунд',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 жыл ішінде',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ай бұрын',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 жыл 3 ай 1 күн 1 секунд бұрын',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 апта 10 сағат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 апта 6 күн',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 апта 6 күн',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 апта бір сағат',
        // CarbonInterval::days(2)->forHumans()
        '2 күн',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 күн 3 сағат',
    ];
}
