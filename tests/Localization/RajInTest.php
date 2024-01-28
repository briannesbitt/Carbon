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
class RajInTest extends LocalizationTestCase
{
    public const LOCALE = 'raj_IN'; // Rajasthani

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शनिवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'रविवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगल्लवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'बुधवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'बृहस्पतिवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'शुक्रवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगल्लवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बुधवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बृहस्पतिवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शनिवार at 12:00 पूर्वाह्न',
        // Carbon::now()->subDays(2)->calendar()
        'Last रविवार at 8:49 अपराह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 अपराह्न',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगल्लवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last मंगल्लवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सोमवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last रविवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शनिवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शुक्रवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last बृहस्पतिवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last बुधवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last शुक्रवार at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 पूर्वाह्न CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 पूर्वाह्न, 12:00 पूर्वाह्न',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 पूर्वाह्न, 1:30 पूर्वाह्न',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 पूर्वाह्न, 2:00 पूर्वाह्न',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 पूर्वाह्न, 6:00 पूर्वाह्न',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 पूर्वाह्न, 10:00 पूर्वाह्न',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 अपराह्न, 12:00 अपराह्न',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 अपराह्न, 5:00 अपराह्न',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 अपराह्न, 9:30 अपराह्न',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 अपराह्न, 11:00 अपराह्न',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 second ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 seconds ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minute ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutes ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 दुनियांण ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 दुनियांण ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 दुनियांण ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 दुनियांण ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 अेक ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 अेक ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 अेक ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 अेक ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 निवाज ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 निवाज ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 निवाज ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 निवाज ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 सूरज ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 सूरज ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 सूरज ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 सूरज ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 आंहू ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 आंहू ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 आंहू ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 आंहू ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 second from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1s from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 second after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 second before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 second',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 seconds',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1s from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute 1 second',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 आंहू 3 सूरज 1 अेक 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 आंहू from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 सूरज ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 आंहू 3 सूरज 1 अेक 1s ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 निवाज 10 दुनियांण',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 निवाज 6 अेक',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 निवाज 6 अेक',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 निवाज and 6 अेक from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 निवाज 1 दुनियांण',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 दुनियांण from now',
        // CarbonInterval::days(2)->forHumans()
        '2 अेक',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 अेक 3 दुनियांण',
    ];
}
