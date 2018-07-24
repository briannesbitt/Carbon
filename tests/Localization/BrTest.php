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

class BrTest extends LocalizationTestCase
{
    const LOCALE = 'br'; // Breton

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sadorn paset da 12e00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sul da 8e49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Warc\'hoazh da 10e00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hiziv da 10e00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hiziv da 2e00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Dec\'h da 1e00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Meurzh paset da 12e00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Meurzh da 12e00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Gwener da 12e00 AM',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'un nebeud segondennoù \'zo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 eilenn \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ur vunutenn \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 vunutenn \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min \'zo',
        // Carbon::now()->subHours(1)->diffForHumans()
        'un eur \'zo',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h \'zo',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 eur \'zo',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h \'zo',
        // Carbon::now()->subDays(1)->diffForHumans()
        'un devezh \'zo',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd \'zo',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 zevezh \'zo',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 sizhun \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 sizhun \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ur miz \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 viz \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm \'zo',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 bloaz \'zo',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y \'zo',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 vloaz \'zo',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y \'zo',
        // Carbon::now()->addSecond()->diffForHumans()
        'a-benn un nebeud segondennoù',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'a-benn s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'un nebeud segondennoù',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 eilenn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'a-benn s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ur vunutenn un nebeud segondennoù',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sizhun 10 eur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sizhun un eur',
    ];
}
