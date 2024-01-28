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
class KyKgTest extends LocalizationTestCase
{
    public const LOCALE = 'ky_KG'; // Kirghiz

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Эртең саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ишемби саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Жекшемби саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Дүйшөмбү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Шейшемби саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Шаршемби саат 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Бейшемби саат 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Жума саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Шейшемби саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Шаршемби саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Бейшемби саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Жума саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ишемби саат 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Өткен аптанын Жекшемби күнү саат 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кече саат 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Бүгүн саат 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Бүгүн саат 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Эртең саат 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Шейшемби саат 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Кече саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кече саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Шейшемби күнү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Дүйшөмбү күнү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Жекшемби күнү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Ишемби күнү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Жума күнү саат 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Өткен аптанын Бейшемби күнү саат 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Өткен аптанын Шаршемби күнү саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Өткен аптанын Жума күнү саат 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-чи 1-чи 1-чи 1-чи 1-чи',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-чи 1-чи',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-чү 1-чи',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-чү 1-чи',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-чи 1-чи',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-чы 1-чи',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-чи 1-чи',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-чи 2-чи',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-чы',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-чи',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-чү',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 таңкы CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 таңкы, 12:00 таңкы',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 таңкы, 1:30 таңкы',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 таңкы, 2:00 таңкы',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 таңкы, 6:00 таңкы',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 таңкы, 10:00 таңкы',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 түштөн кийинки, 12:00 түштөн кийинки',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 түштөн кийинки, 5:00 түштөн кийинки',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 түштөн кийинки, 9:30 түштөн кийинки',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 түштөн кийинки, 11:00 түштөн кийинки',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-чү',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секунд мурун',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 сек. мурун',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунд мурун',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 сек. мурун',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 мүнөт мурун',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 мүн. мурун',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 мүнөт мурун',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 мүн. мурун',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 саат мурун',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 саат. мурун',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 саат мурун',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 саат. мурун',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 күн мурун',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 күн мурун',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 күн мурун',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 күн мурун',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 апта мурун',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 апт. мурун',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 апта мурун',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 апт. мурун',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ай мурун',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ай мурун',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ай мурун',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ай мурун',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 жыл мурун',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 жыл мурун',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 жыл мурун',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 жыл мурун',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 секунд ичинде',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 сек. ичинде',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунд',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 сек.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунд',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сек.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 сек. ичинде',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 мүнөт 1 секунд',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 жыл 3 ай 1 күн 1 сек.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 жыл ичинде',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ай мурун',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 жыл 3 ай 1 күн 1 сек. мурун',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 апта 10 саат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 апта 6 күн',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 апта 6 күн',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 апта 6 күн ичинде',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 апта 1 саат',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'бир саат ичинде',
        // CarbonInterval::days(2)->forHumans()
        '2 күн',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 күн 3 саат.',
    ];
}
