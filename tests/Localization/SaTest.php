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
class SaTest extends LocalizationTestCase
{
    public const LOCALE = 'sa'; // Sanskrit

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'शनिवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'रविवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगलवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'बुधवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'बृहस्पतिवासरः at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'शुक्रवासर at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बुधवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बृहस्पतिवासरः at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शुक्रवासर at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'शनिवासर: at 12:00 पूर्वाह्न',
        // Carbon::now()->subDays(2)->calendar()
        'Last रविवासर: at 8:49 अपराह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 अपराह्न',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last मंगलवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सोमवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last रविवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शनिवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last शुक्रवासर at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last बृहस्पतिवासरः at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last बुधवासर: at 12:00 पूर्वाह्न',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last शुक्रवासर at 12:00 पूर्वाह्न',
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
        '1 द्वितीयः ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 द्वितीयः ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 द्वितीयः ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 द्वितीयः ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 होरा ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 होरा ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 होरा ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 होरा ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 घण्टा ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 घण्टा ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 घण्टा ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 घण्टा ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 दिन ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 दिन ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 दिन ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 दिन ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 सप्ताहः saptahaĥ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 सप्ताहः saptahaĥ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 सप्ताहः saptahaĥ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 सप्ताहः saptahaĥ ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 मास ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 मास ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 मास ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 मास ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 वर्ष ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 वर्ष ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 वर्ष ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 वर्ष ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 द्वितीयः from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 द्वितीयः from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 द्वितीयः after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 द्वितीयः after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 द्वितीयः before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 द्वितीयः before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 द्वितीयः',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 द्वितीयः',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 द्वितीयः',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 द्वितीयः',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 द्वितीयः from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 होरा 1 द्वितीयः',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 वर्ष 3 मास 1 दिन 1 द्वितीयः',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 वर्ष from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 मास ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 वर्ष 3 मास 1 दिन 1 द्वितीयः ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 सप्ताहः saptahaĥ 10 घण्टा',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताहः saptahaĥ 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 सप्ताहः saptahaĥ 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 सप्ताहः saptahaĥ and 6 दिन from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 सप्ताहः saptahaĥ 1 घण्टा',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 घण्टा from now',
        // CarbonInterval::days(2)->forHumans()
        '2 दिन',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 दिन 3 घण्टा',
    ];
}
