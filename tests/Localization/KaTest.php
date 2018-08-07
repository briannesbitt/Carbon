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

class KaTest extends LocalizationTestCase
{
    const LOCALE = 'ka'; // Georgian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ხვალ 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ შაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ კვირას 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ ორშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ სამშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'შემდეგ ოთხშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'შემდეგ ხუთშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'შემდეგ პარასკევს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ სამშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ ოთხშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ ხუთშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ პარასკევს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ შაბათს 12:00 AM-ზე',
        // Carbon::now()->subDays(2)->calendar()
        'წინა კვირას 8:49 PM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'გუშინ 10:00 PM-ზე',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'დღეს 10:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'დღეს 2:00 AM-ზე',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ხვალ 1:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'შემდეგ სამშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'გუშინ 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'გუშინ 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა სამშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა ორშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა კვირას 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა შაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'წინა პარასკევს 12:00 AM-ზე',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'წინა ხუთშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'წინა ოთხშაბათს 12:00 AM-ზე',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'წინა პარასკევს 12:00 AM-ზე',
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
        '12:00 am cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'რამდენიმე წამშიში',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 წამისში',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 წამშიში',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 წამისში',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'წუთშიში',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 წუთისში',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 წუთშიში',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 წუთისში',
        // Carbon::now()->subHours(1)->diffForHumans()
        'საათშიში',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 საათისში',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 საათშიში',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 საათისში',
        // Carbon::now()->subDays(1)->diffForHumans()
        'დღეში',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 დღისში',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 დღეში',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 დღისში',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 კვირისში',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 კვირისში',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 კვირისში',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 კვირისში',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'თვეში',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 თვისში',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 თვეში',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 თვისში',
        // Carbon::now()->subYears(1)->diffForHumans()
        'წელშიში',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 წლისში',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 წელშიში',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 წლისში',
        // Carbon::now()->addSecond()->diffForHumans()
        'რამდენიმე წამის წინ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 წამის',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'რამდენიმე წამი შემდეგ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 წამის შემდეგ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'რამდენიმე წამი უკან',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 წამის უკან',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'რამდენიმე წამი',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 წამის',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 წამი',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 წამის',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 წამის',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'წუთი რამდენიმე წამი',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 წლის 3 თვის 1 დღის 1 წამის',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 წლის წინ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 თვისში',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 წლის 3 თვის 1 დღის 1 წამისში',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 კვირის 10 საათი',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 კვირის 6 დღე',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 კვირის 6 დღე',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 კვირის საათი',
        // CarbonInterval::days(2)->forHumans()
        '2 დღე',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 დღის 3 საათის',
    ];
}
