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
class ShnTest extends LocalizationTestCase
{
    public const LOCALE = 'shn'; // Shan

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဝၼ်းသဝ် at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဝၼ်းဢႃးတိတ်ႉ at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဝၼ်းၸၼ် at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဝၼ်း​ဢၢင်း​ၵၢၼ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဝၼ်းပူတ်ႉ at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ဝၼ်းၽတ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ဝၼ်းသုၵ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်း​ဢၢင်း​ၵၢၼ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်းပူတ်ႉ at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်းၽတ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်းသုၵ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်းသဝ် at 12:00 ၵၢင်ၼႂ်',
        // Carbon::now()->subDays(2)->calendar()
        'Last ဝၼ်းဢႃးတိတ်ႉ at 8:49 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဝၼ်း​ဢၢင်း​ၵၢၼ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ဝၼ်း​ဢၢင်း​ၵၢၼ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ဝၼ်းၸၼ် at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ဝၼ်းဢႃးတိတ်ႉ at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ဝၼ်းသဝ် at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ဝၼ်းသုၵ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ဝၼ်းၽတ်း at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ဝၼ်းပူတ်ႉ at 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ဝၼ်းသုၵ်း at 12:00 ၵၢင်ၼႂ်',
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
        '12:00 ၵၢင်ၼႂ် CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ၵၢင်ၼႂ်, 12:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ၵၢင်ၼႂ်, 1:30 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ၵၢင်ၼႂ်, 2:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ၵၢင်ၼႂ်, 6:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ၵၢင်ၼႂ်, 10:00 ၵၢင်ၼႂ်',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 တၢမ်းၶမ်ႈ, 12:00 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 တၢမ်းၶမ်ႈ, 5:00 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 တၢမ်းၶမ်ႈ, 9:30 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 တၢမ်းၶမ်ႈ, 11:00 တၢမ်းၶမ်ႈ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ဢိုၼ်ႇ ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ဢိုၼ်ႇ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ဢိုၼ်ႇ ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ဢိုၼ်ႇ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ເດັກ ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ເດັກ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ເດັກ ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ເດັກ ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ຕີ ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ຕີ ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ຕີ ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ຕີ ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ກາງວັນ ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ກາງວັນ ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ກາງວັນ ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ກາງວັນ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ဝၼ်း ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ဝၼ်း ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ဝၼ်း ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ဝၼ်း ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 လိူၼ် ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 လိူၼ် ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 လိူၼ် ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 လိူၼ် ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ပီ ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ပီ ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ပီ ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ပီ ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ဢိုၼ်ႇ from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ဢိုၼ်ႇ from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ဢိုၼ်ႇ after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ဢိုၼ်ႇ after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ဢိုၼ်ႇ before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ဢိုၼ်ႇ before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ဢိုၼ်ႇ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ဢိုၼ်ႇ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ဢိုၼ်ႇ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ဢိုၼ်ႇ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ဢိုၼ်ႇ from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ເດັກ 1 ဢိုၼ်ႇ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ပီ 3 လိူၼ် 1 ກາງວັນ 1 ဢိုၼ်ႇ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ပီ from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 လိူၼ် ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ပီ 3 လိူၼ် 1 ກາງວັນ 1 ဢိုၼ်ႇ ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ဝၼ်း 10 ຕີ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ဝၼ်း 6 ກາງວັນ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ဝၼ်း 6 ກາງວັນ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ဝၼ်း and 6 ກາງວັນ from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ဝၼ်း 1 ຕີ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ຕີ from now',
        // CarbonInterval::days(2)->forHumans()
        '2 ກາງວັນ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ກາງວັນ 3 ຕີ',
    ];
}
