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
class BnBdTest extends LocalizationTestCase
{
    public const LOCALE = 'bn_BD'; // Bengali

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM',
        'আগামীকাল রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM',
        'শনিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM',
        'রবিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM',
        'সোমবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'মঙ্গলবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'বুধবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM',
        'বৃহস্পতিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM',
        'শুক্রবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'মঙ্গলবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'বুধবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM',
        'বৃহস্পতিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM',
        'শুক্রবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM',
        'শনিবার, রাত ১২:০ সময়',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM',
        'গত রবিবার, রাত ৮:৪৯ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM',
        'গতকাল রাত ১০:০ সময়',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM',
        'আজ দুপুর ১০:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM',
        'আজ রাত ২:০ সময়',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM',
        'আগামীকাল রাত ১:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'মঙ্গলবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'গতকাল রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'গতকাল রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM',
        'গত মঙ্গলবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM',
        'গত সোমবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM',
        'গত রবিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM',
        'গত শনিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'গত শুক্রবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM',
        'গত বৃহস্পতিবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM',
        'গত বুধবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'গত শুক্রবার, রাত ১২:০ সময়',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st',
        '1 1 1 1 1',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st',
        '2 1',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st',
        '3 1',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st',
        '4 1',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st',
        '5 2',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st',
        '6 2',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 2nd',
        '7 2',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd',
        '11 2',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th',
        '40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st',
        '41',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th',
        '100',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET',
        '12:00 রাত CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am',
        '12:00 রাত, 12:00 রাত',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am',
        '1:30 রাত, 1:30 রাত',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am',
        '2:00 রাত, 2:00 রাত',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am',
        '6:00 সকাল, 6:00 সকাল',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am',
        '10:00 দুপুর, 10:00 দুপুর',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm',
        '12:00 দুপুর, 12:00 দুপুর',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm',
        '5:00 বিকাল, 5:00 বিকাল',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm',
        '9:30 রাত, 9:30 রাত',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm',
        '11:00 রাত, 11:00 রাত',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th',
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago',
        '1 সেকেন্ড আগে',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago',
        '১ সেকেন্ড আগে',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago',
        '2 সেকেন্ড আগে',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago',
        '2 সেকেন্ড আগে',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago',
        '1 মিনিট আগে',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago',
        '১ মিনিট আগে',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago',
        '2 মিনিট আগে',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago',
        '2 মিনিট আগে',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago',
        '1 ঘন্টা আগে',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago',
        '১ ঘন্টা আগে',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago',
        '2 ঘন্টা আগে',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago',
        '2 ঘন্টা আগে',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago',
        '1 দিন আগে',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago',
        '১ দিন আগে',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago',
        '2 দিন আগে',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago',
        '2 দিন আগে',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago',
        '1 সপ্তাহ আগে',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago',
        '১ সপ্তাহ আগে',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago',
        '2 সপ্তাহ আগে',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago',
        '2 সপ্তাহ আগে',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago',
        '1 মাস আগে',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago',
        '১ মাস আগে',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago',
        '2 মাস আগে',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago',
        '2 মাস আগে',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago',
        '1 বছর আগে',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago',
        '১ বছর আগে',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago',
        '2 বছর আগে',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago',
        '2 বছর আগে',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now',
        '1 সেকেন্ড পরে',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now',
        '১ সেকেন্ড পরে',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after',
        '1 সেকেন্ড পরে',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after',
        '১ সেকেন্ড পরে',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before',
        '1 সেকেন্ড আগে',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before',
        '১ সেকেন্ড আগে',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second',
        '1 সেকেন্ড',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s',
        '১ সেকেন্ড',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds',
        '2 সেকেন্ড',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s',
        '2 সেকেন্ড',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now',
        '১ সেকেন্ড পরে',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second',
        '1 মিনিট 1 সেকেন্ড',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s',
        '2 বছর 3 মাস ১ দিন ১ সেকেন্ড',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now',
        '3 বছর পরে',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago',
        '5 মাস আগে',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago',
        '2 বছর 3 মাস ১ দিন ১ সেকেন্ড আগে',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours',
        '1 সপ্তাহ 10 ঘন্টা',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 সপ্তাহ 6 দিন',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 সপ্তাহ 6 দিন',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now',
        '1 সপ্তাহ এবং 6 দিন পরে',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour',
        '2 সপ্তাহ 1 ঘন্টা',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now',
        'এক ঘন্টা পরে',

        // CarbonInterval::days(2)->forHumans()
        // '2 days',
        '2 দিন',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h',
        '১ দিন 3 ঘন্টা',
    ];
}
