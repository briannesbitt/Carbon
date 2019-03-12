<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Localization;

class BnInTest extends LocalizationTestCase
{
    const LOCALE = 'bn_IN'; // Bengali

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'আগামীকাল রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'শনিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'রবিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'সোমবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'মঙ্গলবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'বুধবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'বৃহস্পতিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'শুক্রবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'মঙ্গলবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'বুধবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'বৃহস্পতিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'শুক্রবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'শনিবার, রাত ১২:০ সময়',
        // Carbon::now()->subDays(2)->calendar()
        'গত রবিবার, রাত 08:৪৯ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গতকাল রাত ১০:০ সময়',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'আজ দুপুর ১০:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'আজ রাত 02:০ সময়',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'আগামীকাল রাত 01:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'মঙ্গলবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'গতকাল রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গতকাল রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত মঙ্গলবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত সোমবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত রবিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত শনিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত শুক্রবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'গত বৃহস্পতিবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'গত বুধবার, রাত ১২:০ সময়',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'গত শুক্রবার, রাত ১২:০ সময়',
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
        '6 1',
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
        '12:00 রাত cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 রাত, 12:00 রাত',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 রাত, 1:30 রাত',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 রাত, 2:00 রাত',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 সকাল, 6:00 সকাল',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 দুপুর, 10:00 দুপুর',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 দুপুর, 12:00 দুপুর',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 বিকাল, 5:00 বিকাল',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 রাত, 9:30 রাত',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 রাত, 11:00 রাত',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 সেকেন্ড আগে',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '১ সেকেন্ড আগে',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 সেকেন্ড আগে',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 সেকেন্ড আগে',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 মিনিট আগে',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '১ মিনিট আগে',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 মিনিট আগে',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 মিনিট আগে',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ঘন্টা আগে',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '১ ঘন্টা আগে',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ঘন্টা আগে',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ঘন্টা আগে',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 দিন আগে',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '১ দিন আগে',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 দিন আগে',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 দিন আগে',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 সপ্তাহ আগে',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '১ সপ্তাহ আগে',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 সপ্তাহ আগে',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 সপ্তাহ আগে',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 মাস আগে',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '১ মাস আগে',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 মাস আগে',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 মাস আগে',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 বছর আগে',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '১ বছর আগে',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 বছর আগে',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 বছর আগে',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '১ সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '১ সেকেন্ড পরে',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 সেকেন্ড আগে',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '১ সেকেন্ড আগে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 সেকেন্ড',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '১ সেকেন্ড',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 সেকেন্ড',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 সেকেন্ড',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '১ সেকেন্ড পরে',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 মিনিট 1 সেকেন্ড',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 বছর 3 মাস ১ দিন ১ সেকেন্ড',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 বছর পরে',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 মাস আগে',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 বছর 3 মাস ১ দিন ১ সেকেন্ড আগে',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 10 ঘন্টা',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 6 দিন',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 সপ্তাহ 6 দিন',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 সপ্তাহ এবং 6 দিন পরে',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 সপ্তাহ 1 ঘন্টা',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'এক ঘন্টা পরে',
        // CarbonInterval::days(2)->forHumans()
        '2 দিন',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '১ দিন 3 ঘন্টা',
    ];
}
