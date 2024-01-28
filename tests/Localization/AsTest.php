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
class AsTest extends LocalizationTestCase
{
    public const LOCALE = 'as'; // Assamese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'শনিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'দেওবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'সোমবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'মঙ্গলবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'বুধবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'বৃহষ্পতিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'শুক্ৰবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'মঙ্গলবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'বুধবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'বৃহষ্পতিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'শুক্ৰবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'শনিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::now()->subDays(2)->calendar()
        'Last দেওবাৰ at 8:49 অপৰাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 অপৰাহ্ন',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'মঙ্গলবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last মঙ্গলবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last সোমবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last দেওবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last শনিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last শুক্ৰবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last বৃহষ্পতিবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last বুধবাৰ at 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last শুক্ৰবাৰ at 12:00 পূৰ্ব্বাহ্ন',
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
        '12:00 পূৰ্ব্বাহ্ন CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 পূৰ্ব্বাহ্ন, 12:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 পূৰ্ব্বাহ্ন, 1:30 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 পূৰ্ব্বাহ্ন, 2:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 পূৰ্ব্বাহ্ন, 6:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 পূৰ্ব্বাহ্ন, 10:00 পূৰ্ব্বাহ্ন',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 অপৰাহ্ন, 12:00 অপৰাহ্ন',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 অপৰাহ্ন, 5:00 অপৰাহ্ন',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 অপৰাহ্ন, 9:30 অপৰাহ্ন',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 অপৰাহ্ন, 11:00 অপৰাহ্ন',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 দ্বিতীয় ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 দ্বিতীয় ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 দ্বিতীয় ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 দ্বিতীয় ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 মিনিট ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 মিনিট ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 মিনিট ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 মিনিট ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ঘণ্টা ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ঘণ্টা ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ঘণ্টা ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ঘণ্টা ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 বাৰ ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 বাৰ ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 বাৰ ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 বাৰ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 সপ্তাহ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 সপ্তাহ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 সপ্তাহ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 সপ্তাহ ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 মাহ ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 মাহ ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 মাহ ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 মাহ ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 বছৰ ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 বছৰ ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 বছৰ ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 বছৰ ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 দ্বিতীয় from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 দ্বিতীয় from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 দ্বিতীয় after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 দ্বিতীয় after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 দ্বিতীয় before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 দ্বিতীয় before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 দ্বিতীয়',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 দ্বিতীয়',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 দ্বিতীয়',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 দ্বিতীয়',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 দ্বিতীয় from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 মিনিট 1 দ্বিতীয়',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 বছৰ 3 মাহ 1 বাৰ 1 দ্বিতীয়',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 বছৰ from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 মাহ ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 বছৰ 3 মাহ 1 বাৰ 1 দ্বিতীয় ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 10 ঘণ্টা',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 6 বাৰ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 6 বাৰ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 সপ্তাহ and 6 বাৰ from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 সপ্তাহ 1 ঘণ্টা',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ঘণ্টা from now',
        // CarbonInterval::days(2)->forHumans()
        '2 বাৰ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 বাৰ 3 ঘণ্টা',
    ];
}
