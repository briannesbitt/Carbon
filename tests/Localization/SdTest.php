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

class SdTest extends LocalizationTestCase
{
    const LOCALE = 'sd'; // Sindhi

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي ڇنڇر تي 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'آچر اڳين هفتي تي 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سڀاڻي 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'اڄ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اڄ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ڪالهه 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'گزريل هفتي اڱارو تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اڱارو اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمع اڳين هفتي تي 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'چند سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'هڪ منٽ اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 منٽ اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min اڳ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'هڪ ڪلاڪ اڳ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h اڳ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ڪلاڪ اڳ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h اڳ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'هڪ ڏينهن اڳ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd اڳ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ڏينهن اڳ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ھڪ ھفتو اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 هفتا اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'هڪ مهينو اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 مهينا اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm اڳ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'هڪ سال اڳ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y اڳ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال اڳ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y اڳ',
        // Carbon::now()->addSecond()->diffForHumans()
        'چند سيڪنڊ پوء',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's پوء',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'چند سيڪنڊ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سيڪنڊ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's پوء',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'هڪ منٽ چند سيڪنڊ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 10 ڪلاڪ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 6 ڏينهن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 6 ڏينهن',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 هفتا هڪ ڪلاڪ',
    ];
}
