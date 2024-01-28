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
class KaGeTest extends LocalizationTestCase
{
    public const LOCALE = 'ka_GE'; // Georgian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM',
        'ხვალ, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM',
        'შაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM',
        'კვირას, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM',
        'შემდეგ ორშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'შემდეგ სამშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'შემდეგ ოთხშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM',
        'შემდეგ ხუთშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM',
        'შემდეგ პარასკევს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'შემდეგ სამშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'შემდეგ ოთხშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM',
        'შემდეგ ხუთშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM',
        'შემდეგ პარასკევს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM',
        'შემდეგ შაბათს, 00:00-ზე',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM',
        'წინა კვირას, 20:49-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM',
        'გუშინ, 22:00-ზე',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM',
        'დღეს, 10:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM',
        'დღეს, 02:00-ზე',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM',
        'ხვალ, 01:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'შემდეგ სამშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'გუშინ, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'გუშინ, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM',
        'წინა სამშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM',
        'წინა ორშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM',
        'წინა კვირას, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM',
        'წინა შაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'წინა პარასკევს, 00:00-ზე',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM',
        'წინა ხუთშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM',
        'წინა ოთხშაბათს, 00:00-ზე',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'წინა პარასკევს, 00:00-ზე',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st',
        '1-ლი 1-ლი 1-ლი 1-ლი 1-ლი',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st',
        'მე-2 1-ლი',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st',
        'მე-3 1-ლი',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st',
        'მე-4 1-ლი',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st',
        'მე-5 1-ლი',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st',
        'მე-6 1-ლი',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 2nd',
        'მე-7 1-ლი',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd',
        'მე-11 მე-2',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th',
        'მე-40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st',
        '41-ე',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th',
        'მე-100',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET',
        '12:00 ღამის CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am',
        '12:00 ღამის, 12:00 ღამის',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am',
        '1:30 ღამის, 1:30 ღამის',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am',
        '2:00 ღამის, 2:00 ღამის',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am',
        '6:00 დილის, 6:00 დილის',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am',
        '10:00 დილის, 10:00 დილის',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm',
        '12:00 შუადღის, 12:00 შუადღის',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm',
        '5:00 საღამოს, 5:00 საღამოს',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm',
        '9:30 საღამოს, 9:30 საღამოს',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm',
        '11:00 ღამის, 11:00 ღამის',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th',
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago',
        '1 წამის წინ',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago',
        '1 წამის წინ',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago',
        '2 წამის წინ',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago',
        '2 წამის წინ',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago',
        '1 წუთის წინ',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago',
        '1 წუთის წინ',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago',
        '2 წუთის წინ',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago',
        '2 წუთის წინ',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago',
        '1 საათის წინ',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago',
        '1 საათის წინ',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago',
        '2 საათის წინ',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago',
        '2 საათის წინ',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago',
        '1 დღის წინ',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago',
        '1 დღის წინ',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago',
        '2 დღის წინ',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago',
        '2 დღის წინ',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago',
        '1 კვირის წინ',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago',
        '1 კვირის წინ',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago',
        '2 კვირის წინ',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago',
        '2 კვირის წინ',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago',
        '1 თვის წინ',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago',
        '1 თვის წინ',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago',
        '2 თვის წინ',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago',
        '2 თვის წინ',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago',
        '1 წლის წინ',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago',
        '1 წლის წინ',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago',
        '2 წლის წინ',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago',
        '2 წლის წინ',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now',
        '1 წამში',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now',
        '1 წამში',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after',
        '1 წამის შემდეგ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after',
        '1 წამის შემდეგ',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before',
        '1 წამით ადრე',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before',
        '1 წამით ადრე',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second',
        '1 წამი',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s',
        '1 წამი',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds',
        '2 წამი',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s',
        '2 წამი',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now',
        '1 წამში',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second',
        '1 წუთი 1 წამი',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s',
        '2 წელი 3 თვე 1 დღე 1 წამი',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now',
        '3 წელიწადში',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago',
        '5 თვის წინ',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago',
        '2 წლის 3 თვის 1 დღის 1 წამის წინ',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours',
        '1 კვირა 10 საათი',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 კვირა 6 დღე',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 კვირა 6 დღე',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now',
        '1 კვირაში და 6 დღეში',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour',
        '2 კვირა 1 საათი',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now',
        'საათში',

        // CarbonInterval::days(2)->forHumans()
        // '2 days',
        '2 დღე',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h',
        '1 დღე 3 საათი',
    ];
}
