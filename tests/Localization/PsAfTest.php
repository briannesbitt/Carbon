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
class PsAfTest extends LocalizationTestCase
{
    public const LOCALE = 'ps_AF'; // Pashto

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'خالي at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اتوار at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ګل at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'نهه at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'شورو at 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'زيارت at 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'جمعه at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'نهه at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'شورو at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'زيارت at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعه at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'خالي at 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last اتوار at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'نهه at 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last نهه at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ګل at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last اتوار at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last خالي at 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last جمعه at 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last زيارت at 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last شورو at 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last جمعه at 0:00',
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
        '6 2',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 غ.م. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 غ.م., 12:00 غ.م.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 غ.م., 1:30 غ.م.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 غ.م., 2:00 غ.م.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 غ.م., 6:00 غ.م.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 غ.م., 10:00 غ.م.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 غ.و., 12:00 غ.و.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 غ.و., 5:00 غ.و.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 غ.و., 9:30 غ.و.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 غ.و., 11:00 غ.و.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ثانيه دمخه',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1ثانيه دمخه',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ثانيې دمخه',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2ثانيې دمخه',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 دقيقه دمخه',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1دقيقه دمخه',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 دقيقې دمخه',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2دقيقې دمخه',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ساعت دمخه',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1ساعت دمخه',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ساعته دمخه',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2ساعته دمخه',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ورځ دمخه',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1ورځ دمخه',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ورځي دمخه',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2ورځي دمخه',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 اونۍ دمخه',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1اونۍ دمخه',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 اونۍ دمخه',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2اونۍ دمخه',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 مياشت دمخه',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1مياشت دمخه',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 مياشتي دمخه',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2مياشتي دمخه',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 کال دمخه',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1کال دمخه',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 کاله دمخه',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2کاله دمخه',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ثانيه له اوس څخه',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1ثانيه له اوس څخه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ثانيه وروسته',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1ثانيه وروسته',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ثانيه دمخه',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1ثانيه دمخه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ثانيه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1ثانيه',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ثانيې',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2ثانيې',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1ثانيه له اوس څخه',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 دقيقه 1 ثانيه',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2کاله 3مياشتي 1ورځ 1ثانيه',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 کاله له اوس څخه',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5مياشتي دمخه',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2کاله 3مياشتي 1ورځ 1ثانيه دمخه',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 اونۍ 10 ساعته',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 اونۍ 6 ورځي',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 اونۍ 6 ورځي',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 اونۍ او 6 ورځي له اوس څخه',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 اونۍ 1 ساعت',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ساعت له اوس څخه',
        // CarbonInterval::days(2)->forHumans()
        '2 ورځي',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1ورځ 3ساعته',
    ];
}
