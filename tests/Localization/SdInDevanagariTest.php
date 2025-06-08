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
class SdInDevanagariTest extends LocalizationTestCase
{
    public const LOCALE = 'sd_IN@devanagari'; // Sindhi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سڀاڻي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'छंछस اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आर्तवारू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सूमरू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगलू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ॿुधरू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'विस्पति اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'जुमो اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ॿुधरू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'विस्पति اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'जुमो اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'छंछस اڳين هفتي تي 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'گزريل هفتي आर्तवारू تي 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ڪالهه 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'اڄ 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اڄ 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'سڀاڻي 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलू اڳين هفتي تي 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ڪالهه 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ڪالهه 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي मंगलू تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي सूमरू تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي आर्तवारू تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي छंछस تي 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گزريل هفتي जुमो تي 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'گزريل هفتي विस्पति تي 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'گزريل هفتي ॿुधरू تي 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'گزريل هفتي जुमो تي 00:00',
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
        '12:00 म.पू. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 म.पू., 12:00 म.पू.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 म.पू., 1:30 म.पू.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 म.पू., 2:00 म.पू.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 म.पू., 6:00 म.पू.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 म.पू., 10:00 म.पू.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 म.नं., 12:00 म.नं.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 म.नं., 5:00 म.नं.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 म.नं., 9:30 म.नं.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 म.नं., 11:00 म.नं.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سيڪنڊ اڳ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 سيڪنڊ اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 منٽ اڳ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 منٽ اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 منٽ اڳ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 منٽ اڳ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ڪلاڪ اڳ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ڪلاڪ اڳ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ڪلاڪ اڳ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ڪلاڪ اڳ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ڏينهن اڳ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ڏينهن اڳ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ڏينهن اڳ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ڏينهن اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 هفتا اڳ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 هفتا اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 هفتا اڳ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 هفتا اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 مهينا اڳ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 مهينا اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 مهينا اڳ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 مهينا اڳ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 سال اڳ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 سال اڳ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال اڳ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 سال اڳ',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 سيڪنڊ پوء',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 سيڪنڊ پوء',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 سيڪنڊ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 سيڪنڊ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سيڪنڊ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 سيڪنڊ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 سيڪنڊ پوء',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 منٽ 1 سيڪنڊ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 سال 3 مهينا 1 ڏينهن 1 سيڪنڊ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 سال پوء',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 مهينا اڳ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 سال 3 مهينا 1 ڏينهن 1 سيڪنڊ اڳ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 هفتا 10 ڪلاڪ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفتا 6 ڏينهن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفتا 6 ڏينهن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 هفتا ۽ 6 ڏينهن پوء',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 هفتا 1 ڪلاڪ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'هڪ ڪلاڪ پوء',
        // CarbonInterval::days(2)->forHumans()
        '2 ڏينهن',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ڏينهن 3 ڪلاڪ',
    ];
}
