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

class UzCyrlTest extends LocalizationTestCase
{
    const LOCALE = 'uz_Cyrl'; // Uzbek

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Эртага 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'шанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'якшанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'душанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сешанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'чоршанба куни соат 00:00 да',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'пайшанба куни соат 00:00 да',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'жума куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сешанба куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'чоршанба куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'пайшанба куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'жума куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'шанба куни соат 00:00 да',
        // Carbon::now()->subDays(2)->calendar()
        'Утган якшанба куни соат 20:49 да',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кеча соат 22:00 да',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Бугун соат 10:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Бугун соат 02:00 да',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Эртага 01:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'сешанба куни соат 00:00 да',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Кеча соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кеча соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утган сешанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утган душанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утган якшанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утган шанба куни соат 00:00 да',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Утган жума куни соат 00:00 да',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Утган пайшанба куни соат 00:00 да',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Утган чоршанба куни соат 00:00 да',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Утган жума куни соат 00:00 да',
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
        '12:00 то CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ТО, 12:00 то',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ТО, 1:30 то',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ТО, 2:00 то',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ТО, 6:00 то',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ТО, 10:00 то',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ТК, 12:00 тк',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ТК, 5:00 тк',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ТК, 9:30 тк',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ТК, 11:00 тк',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'Бир неча 1 фурсат олдин',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'Бир неча 1 ф олдин',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'Бир неча 2 фурсат олдин',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'Бир неча 2 ф олдин',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'Бир неча 1 дакика олдин',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'Бир неча 1 д олдин',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'Бир неча 2 дакика олдин',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'Бир неча 2 д олдин',
        // Carbon::now()->subHours(1)->diffForHumans()
        'Бир неча 1 соат олдин',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'Бир неча 1 с олдин',
        // Carbon::now()->subHours(2)->diffForHumans()
        'Бир неча 2 соат олдин',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'Бир неча 2 с олдин',
        // Carbon::now()->subDays(1)->diffForHumans()
        'Бир неча 1 кун олдин',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'Бир неча 1 к олдин',
        // Carbon::now()->subDays(2)->diffForHumans()
        'Бир неча 2 кун олдин',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'Бир неча 2 к олдин',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'Бир неча 1 ҳафта олдин',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'Бир неча 1 ҳ олдин',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'Бир неча 2 ҳафта олдин',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'Бир неча 2 ҳ олдин',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'Бир неча 1 ой олдин',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'Бир неча 1 о олдин',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'Бир неча 2 ой олдин',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'Бир неча 2 о олдин',
        // Carbon::now()->subYears(1)->diffForHumans()
        'Бир неча 1 йил олдин',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'Бир неча 1 й олдин',
        // Carbon::now()->subYears(2)->diffForHumans()
        'Бир неча 2 йил олдин',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'Бир неча 2 й олдин',
        // Carbon::now()->addSecond()->diffForHumans()
        'Якин 1 фурсат ичида',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'Якин 1 ф ичида',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 фурсат пас аз он',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ф пас аз он',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 фурсат пеш аз он',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ф пеш аз он',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 фурсат',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ф',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 фурсат',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ф',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'Якин 1 ф ичида',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 дакика 1 фурсат',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 й 3 о 1 к 1 ф',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'Якин 3 йил ичида',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'Бир неча 5 о олдин',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'Бир неча 2 й 3 о 1 к 1 ф олдин',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ҳафта 10 соат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ҳафта 6 кун',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ҳафта 6 кун',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'Якин 1 ҳафта va 6 кун ичида',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ҳафта 1 соат',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'Якин бир соат ичида',
        // CarbonInterval::days(2)->forHumans()
        '2 кун',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 к 3 с',
    ];
}
