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
class KmKhTest extends LocalizationTestCase
{
    public const LOCALE = 'km_KH'; // Khmer

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ស្អែក ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'សៅរ៍ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'អាទិត្យ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ច័ន្ទ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'អង្គារ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ពុធ ម៉ោង 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ព្រហស្បតិ៍ ម៉ោង 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'សុក្រ ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'អង្គារ ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ពុធ ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ព្រហស្បតិ៍ ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'សុក្រ ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'សៅរ៍ ម៉ោង 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'អាទិត្យ សប្តាហ៍មុន ម៉ោង 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ម្សិលមិញ ម៉ោង 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ថ្ងៃនេះ ម៉ោង 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ថ្ងៃនេះ ម៉ោង 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ស្អែក ម៉ោង 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'អង្គារ ម៉ោង 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ម្សិលមិញ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ម្សិលមិញ ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'អង្គារ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ច័ន្ទ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'អាទិត្យ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'សៅរ៍ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'សុក្រ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ព្រហស្បតិ៍ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ពុធ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'សុក្រ សប្តាហ៍មុន ម៉ោង 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ទី1 ទី1 ទី1 ទី1 ទី1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ទី2 ទី1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ទី3 ទី1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ទី4 ទី1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ទី5 ទី1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ទី6 ទី1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ទី7 ទី1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ទី11 ទី2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ទី40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ទី41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ទី100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ព្រឹក CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ព្រឹក, 12:00 ព្រឹក',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ព្រឹក, 1:30 ព្រឹក',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ព្រឹក, 2:00 ព្រឹក',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ព្រឹក, 6:00 ព្រឹក',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ព្រឹក, 10:00 ព្រឹក',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ល្ងាច, 12:00 ល្ងាច',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ល្ងាច, 5:00 ល្ងាច',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ល្ងាច, 9:30 ល្ងាច',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ល្ងាច, 11:00 ល្ងាច',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ទី0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ប៉ុន្មានវិនាទីមុន',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 វិនាទីមុន',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 វិនាទីមុន',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 វិនាទីមុន',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'មួយនាទីមុន',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 នាទីមុន',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 នាទីមុន',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 នាទីមុន',
        // Carbon::now()->subHours(1)->diffForHumans()
        'មួយម៉ោងមុន',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ម៉ោងមុន',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ម៉ោងមុន',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ម៉ោងមុន',
        // Carbon::now()->subDays(1)->diffForHumans()
        'មួយថ្ងៃមុន',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ថ្ងៃមុន',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ថ្ងៃមុន',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ថ្ងៃមុន',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 សប្ដាហ៍មុន',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 សប្ដាហ៍មុន',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 សប្ដាហ៍មុន',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 សប្ដាហ៍មុន',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'មួយខែមុន',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ខែមុន',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ខែមុន',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ខែមុន',
        // Carbon::now()->subYears(1)->diffForHumans()
        'មួយឆ្នាំមុន',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ឆ្នាំមុន',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ឆ្នាំមុន',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ឆ្នាំមុន',
        // Carbon::now()->addSecond()->diffForHumans()
        'ប៉ុន្មានវិនាទីទៀត',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 វិនាទីទៀត',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'នៅ​ក្រោយ ប៉ុន្មានវិនាទី',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'នៅ​ក្រោយ 1 វិនាទី',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'នៅ​មុន ប៉ុន្មានវិនាទី',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'នៅ​មុន 1 វិនាទី',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ប៉ុន្មានវិនាទី',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 វិនាទី',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 វិនាទី',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 វិនាទី',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 វិនាទីទៀត',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'មួយនាទី ប៉ុន្មានវិនាទី',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ឆ្នាំ 3 ខែ 1 ថ្ងៃ 1 វិនាទី',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ឆ្នាំទៀត',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ខែមុន',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ឆ្នាំ 3 ខែ 1 ថ្ងៃ 1 វិនាទីមុន',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 សប្ដាហ៍ 10 ម៉ោង',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 សប្ដាហ៍ 6 ថ្ងៃ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 សប្ដាហ៍ 6 ថ្ងៃ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 សប្ដាហ៍និង 6 ថ្ងៃទៀត',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 សប្ដាហ៍ មួយម៉ោង',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'មួយម៉ោងទៀត',
        // CarbonInterval::days(2)->forHumans()
        '2 ថ្ងៃ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ថ្ងៃ 3 ម៉ោង',
    ];
}
