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

class MiTest extends LocalizationTestCase
{
    const LOCALE = 'mi'; // Maori

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hātarei whakamutunga i 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Rātapu i 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'apopo i 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'i teie mahana, i 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i teie mahana, i 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'inanahi i 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tūrei whakamutunga i 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tūrei i 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Paraire i 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'te hēkona ruarua i mua',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's i mua',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 hēkona i mua',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's i mua',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'he meneti i mua',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min i mua',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 meneti i mua',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min i mua',
        // Carbon::now()->subHours(1)->diffForHumans()
        'te haora i mua',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h i mua',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 haora i mua',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h i mua',
        // Carbon::now()->subDays(1)->diffForHumans()
        'he ra i mua',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd i mua',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ra i mua',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd i mua',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'he wiki i mua',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w i mua',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 wiki i mua',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w i mua',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'he marama i mua',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm i mua',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 marama i mua',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm i mua',
        // Carbon::now()->subYears(1)->diffForHumans()
        'he tau i mua',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y i mua',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 tau i mua',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y i mua',
        // Carbon::now()->addSecond()->diffForHumans()
        'i roto i te hēkona ruarua',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'i roto i s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'te hēkona ruarua',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 hēkona',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'i roto i s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'he meneti te hēkona ruarua',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'he wiki 10 haora',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'he wiki 6 ra',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'he wiki 6 ra',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wiki te haora',
    ];
}
