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
class UkUaTest extends LocalizationTestCase
{
    public const LOCALE = 'uk_UA'; // Ukrainian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Завтра о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У суботу о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У неділю о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У понеділок о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У вівторок о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У середу о 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'У четвер о 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'У п’ятницю о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У вівторок о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У середу о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У четвер о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У п’ятницю о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У суботу о 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Минулої неділі о 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчора о 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Сьогодні о 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Сьогодні о 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Завтра о 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У вівторок о 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Вчора о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вчора о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулого вівторка о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулого понеділка о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулої неділі о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулої суботи о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулої п’ятниці о 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Минулого четверга о 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Минулої середи о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Минулої п’ятниці о 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-й 1-й 1-го 1-й 1-й',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-го 1-й',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-го 1-й',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-го 1-й',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-го 1-й',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-го 1-й',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-го 1-й',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-го 2-й',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-й',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-й',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-й',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ночі CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ночі, 12:00 ночі',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ночі, 1:30 ночі',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ночі, 2:00 ночі',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ранку, 6:00 ранку',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ранку, 10:00 ранку',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 дня, 12:00 дня',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 вечора, 5:00 вечора',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 вечора, 9:30 вечора',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 вечора, 11:00 вечора',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секунду тому',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1сек тому',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунди тому',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2сек тому',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 хвилину тому',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1хв тому',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 хвилини тому',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2хв тому',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 годину тому',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1г тому',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 години тому',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2г тому',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 день тому',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1д тому',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 дні тому',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2д тому',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 тиждень тому',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1т тому',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 тижні тому',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2т тому',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 місяць тому',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1м тому',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 місяці тому',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2м тому',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 рік тому',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1р тому',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 роки тому',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2рр тому',
        // Carbon::now()->addSecond()->diffForHumans()
        'за 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'за 1сек',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секунду після',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1сек після',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секунду до',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1сек до',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунда',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1сек',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2сек',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'за 1сек',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 хвилина 1 секунда',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2рр 3м 1д 1сек',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'за 3 роки',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5м тому',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2рр 3м 1д 1сек тому',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 тиждень 10 годин',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тиждень 6 днів',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тиждень 6 днів',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'за 1 тиждень i 6 днів',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 тижні 1 година',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'за годину',
        // CarbonInterval::days(2)->forHumans()
        '2 дні',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1д 3г',
    ];
}
