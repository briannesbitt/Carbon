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
class SahRuTest extends LocalizationTestCase
{
    public const LOCALE = 'sah_RU'; // Sakha

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Завтра, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В субуота, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В баскыһыанньа, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В следующий понедельник, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В следующий вторник, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В следующую сэрэдэ, в 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'В следующий четверг, в 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'В следующую бээтинсэ, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующий вторник, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующую сэрэдэ, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующий четверг, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующую бээтинсэ, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующую субуота, в 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'В прошлое воскресенье, в 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера, в 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Сегодня, в 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Сегодня, в 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Завтра, в 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В следующий вторник, в 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Вчера, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчера, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Во вторник, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В бэнидиэнньик, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В прошлое воскресенье, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В прошлую субуота, в 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'В прошлую бээтинсэ, в 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'В прошлый четверг, в 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'В прошлую сэрэдэ, в 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'В бээтинсэ, в 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-й 1-й 1-го 1-я 1-я',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-го 1-я',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-го 1-я',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-го 1-я',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-го 1-я',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-го 1-я',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-го 1-я',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-го 2-я',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-й',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-й',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-й',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ночи CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ночи, 12:00 ночи',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ночи, 1:30 ночи',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ночи, 2:00 ночи',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 утра, 6:00 утра',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 утра, 10:00 утра',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 дня, 12:00 дня',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 вечера, 5:00 вечера',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 вечера, 9:30 вечера',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 вечера, 11:00 вечера',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секунду назад',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 сек. назад',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунду назад',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 сек. назад',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 минуту назад',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 мин. назад',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минуту назад',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 мин. назад',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 час назад',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ч. назад',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 час назад',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ч. назад',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 день назад',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 д. назад',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 день назад',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 д. назад',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 неделю назад',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 нед. назад',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 неделю назад',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 нед. назад',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 месяц назад',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 мес. назад',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 месяц назад',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 мес. назад',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 год назад',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 г. назад',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 год назад',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 г. назад',
        // Carbon::now()->addSecond()->diffForHumans()
        'через 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'через 1 сек.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секунду после',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 сек. после',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секунду до',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 сек. до',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 сек.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунда',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сек.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'через 1 сек.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минута 1 секунда',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 г. 3 мес. 1 д. 1 сек.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'через 3 год',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 мес. назад',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 г. 3 мес. 1 д. 1 сек. назад',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 неделя 10 час',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 неделя 6 день',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 неделя 6 день',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'через 1 неделю и 6 день',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 неделя 1 час',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'через час',
        // CarbonInterval::days(2)->forHumans()
        '2 день',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 д. 3 ч.',
    ];
}
