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
class SdTest extends LocalizationTestCase
{
    public const LOCALE = 'sd'; // Sindhi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سڀاڻي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ڇنڇر اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'آچر اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سومر اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اڱارو اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اربع اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'خميس اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'جمع اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'اڱارو اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'اربع اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'خميس اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمع اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ڇنڇر اڳين هفتي تي 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'گزريل هفتي آچر تي 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ڪالهه 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'اڄ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اڄ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'سڀاڻي 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'اڱارو اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ڪالهه 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ڪالهه 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي اڱارو تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي سومر تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي آچر تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي ڇنڇر تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي جمع تي 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'گزريل هفتي خميس تي 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'گزريل هفتي اربع تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'گزريل هفتي جمع تي 00:00',
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
        '12:00 صبح CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 صبح, 12:00 صبح',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 صبح, 1:30 صبح',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 صبح, 2:00 صبح',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 صبح, 6:00 صبح',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 صبح, 10:00 صبح',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 شام, 12:00 شام',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 شام, 5:00 شام',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 شام, 9:30 شام',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 شام, 11:00 شام',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'چند سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'چند سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 سيڪنڊ اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'هڪ منٽ اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'هڪ منٽ اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 منٽ اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 منٽ اڳ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'هڪ ڪلاڪ اڳ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'هڪ ڪلاڪ اڳ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ڪلاڪ اڳ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ڪلاڪ اڳ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'هڪ ڏينهن اڳ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'هڪ ڏينهن اڳ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ڏينهن اڳ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ڏينهن اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ھڪ ھفتو اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ھڪ ھفتو اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 هفتا اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 هفتا اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'هڪ مهينو اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'هڪ مهينو اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 مهينا اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 مهينا اڳ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'هڪ سال اڳ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'هڪ سال اڳ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال اڳ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 سال اڳ',
        // Carbon::now()->addSecond()->diffForHumans()
        'چند سيڪنڊ پوء',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'چند سيڪنڊ پوء',
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
        'چند سيڪنڊ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سيڪنڊ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 سيڪنڊ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'چند سيڪنڊ پوء',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'هڪ منٽ چند سيڪنڊ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 سال 3 مهينا هڪ ڏينهن چند سيڪنڊ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 سال پوء',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 مهينا اڳ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 سال 3 مهينا هڪ ڏينهن چند سيڪنڊ اڳ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 10 ڪلاڪ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 6 ڏينهن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ھڪ ھفتو 6 ڏينهن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ھڪ ھفتو ۽ 6 ڏينهن پوء',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 هفتا هڪ ڪلاڪ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'هڪ ڪلاڪ پوء',
        // CarbonInterval::days(2)->forHumans()
        '2 ڏينهن',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'هڪ ڏينهن 3 ڪلاڪ',
    ];
}
