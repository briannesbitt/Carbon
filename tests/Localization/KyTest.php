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

class KyTest extends LocalizationTestCase
{
    const LOCALE = 'ky'; // Kirghiz

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Өткен аптанын Ишемби күнү саат 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Жекшемби саат 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Эртең саат 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Бүгүн саат 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Бүгүн саат 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Кече саат 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Өткен аптанын Шейшемби күнү саат 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Шейшемби саат 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Жума саат 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'бирнече секунд мурун',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's мурун',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунд мурун',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's мурун',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'бир мүнөт мурун',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min мурун',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 мүнөт мурун',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min мурун',
        // Carbon::now()->subHours(1)->diffForHumans()
        'бир саат мурун',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h мурун',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 саат мурун',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h мурун',
        // Carbon::now()->subDays(1)->diffForHumans()
        'бир күн мурун',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd мурун',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 күн мурун',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd мурун',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'бир жума мурун',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w мурун',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 жума мурун',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w мурун',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'бир ай мурун',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm мурун',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ай мурун',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm мурун',
        // Carbon::now()->subYears(1)->diffForHumans()
        'бир жыл мурун',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y мурун',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 жыл мурун',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y мурун',
        // Carbon::now()->addSecond()->diffForHumans()
        'бирнече секунд ичинде',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's ичинде',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'бирнече секунд',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунд',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's ичинде',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'бир мүнөт бирнече секунд',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'бир жума 10 саат',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'бир жума 6 күн',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'бир жума 6 күн',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 жума бир саат',
    ];
}
