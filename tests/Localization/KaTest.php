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

class KaTest extends LocalizationTestCase
{
    const LOCALE = 'ka'; // Georgian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ხვალ, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'კვირას, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ ორშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ სამშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ ოთხშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'შემდეგ ხუთშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'შემდეგ პარასკევს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ სამშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ ოთხშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ ხუთშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ პარასკევს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ შაბათს, 00:00-ზე',
        // Carbon::now()->subDays(2)->calendar()
        'წინა კვირას, 20:49-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'გუშინ, 22:00-ზე',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'დღეს, 10:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'დღეს, 02:00-ზე',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ხვალ, 01:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ სამშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'გუშინ, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'გუშინ, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა სამშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა ორშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა კვირას, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა შაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა პარასკევს, 00:00-ზე',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'წინა ხუთშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'წინა ოთხშაბათს, 00:00-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'წინა პარასკევს, 00:00-ზე',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-ლი 1-ლი 1-ლი 1-ლი 1-ლი',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'მე-2 1-ლი',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'მე-3 1-ლი',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'მე-4 1-ლი',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'მე-5 1-ლი',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'მე-6 1-ლი',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'მე-7 1-ლი',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'მე-11 მე-2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'მე-40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-ე',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'მე-100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ღამის cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ღამის, 12:00 ღამის',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ღამის, 1:30 ღამის',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ღამის, 2:00 ღამის',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 დილის, 6:00 დილის',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 დილის, 10:00 დილის',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 შუადღის, 12:00 შუადღის',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 საღამოს, 5:00 საღამოს',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 საღამოს, 9:30 საღამოს',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ღამის, 11:00 ღამის',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 წამის წინ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 წამის წინ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 წამის წინ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 წამის წინ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 წუთის წინ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 წუთის წინ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 წუთის წინ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 წუთის წინ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 საათის წინ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 საათის წინ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 საათის წინ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 საათის წინ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 დღის წინ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 დღის წინ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 დღის წინ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 დღის წინ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 კვირის წინ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 კვირის წინ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 კვირის წინ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 კვირის წინ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 თვის წინ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 თვის წინ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 თვის წინ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 თვის წინ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 წლის წინ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 წლის წინ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 წლის წინ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 წლის წინ',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 წამში',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 წამში',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 წამის შემდეგ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 წამის შემდეგ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 წამი',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 წამი',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 წამი',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 წამი',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 წამი',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 წამი',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 წამში',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 წუთი 1 წამი',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 წელი 3 თვე 1 დღე 1 წამი',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 წლის შემდეგ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 თვის წინ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 წლის 3 თვის 1 დღის 1 წამის წინ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 კვირა 10 საათი',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 კვირა 6 დღე',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 კვირა 6 დღე',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 კვირის და 6 დღის შემდეგ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 კვირა 1 საათი',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 საათში',
        // CarbonInterval::days(2)->forHumans()
        '2 დღე',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 დღე 3 საათი',
    ];
}
