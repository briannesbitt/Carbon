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

class BnTest extends LocalizationTestCase
{
    const LOCALE = 'bn'; // Bengali

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'গত শনিবার, রাত 12:00 সময়',
        // Carbon::now()->subDays(2)->calendar()
        'রবিবার, রাত 8:49 সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'আগামীকাল রাত 10:00 সময়',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'আজ দুপুর 10:00 সময়',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'আজ রাত 2:00 সময়',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'গতকাল রাত 1:00 সময়',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'গত মঙ্গলবার, রাত 12:00 সময়',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'মঙ্গলবার, রাত 12:00 সময়',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'শুক্রবার, রাত 12:00 সময়',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'কয়েক সেকেন্ড আগে',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '১ সেকেন্ড আগে',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 সেকেন্ড আগে',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 সেকেন্ড আগে',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'এক মিনিট আগে',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '১ মিনিট আগে',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 মিনিট আগে',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 মিনিট আগে',
        // Carbon::now()->subHours(1)->diffForHumans()
        'এক ঘন্টা আগে',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '১ ঘন্টা আগে',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ঘন্টা আগে',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ঘন্টা আগে',
        // Carbon::now()->subDays(1)->diffForHumans()
        'এক দিন আগে',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '১ দিন আগে',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 দিন আগে',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 দিন আগে',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '১ সপ্তাহ আগে',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '১ সপ্তাহ আগে',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 সপ্তাহ আগে',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 সপ্তাহ আগে',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'এক মাস আগে',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '১ মাস আগে',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 মাস আগে',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 মাস আগে',
        // Carbon::now()->subYears(1)->diffForHumans()
        'এক বছর আগে',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '১ বছর আগে',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 বছর আগে',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 বছর আগে',
        // Carbon::now()->addSecond()->diffForHumans()
        'কয়েক সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '১ সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'কয়েক সেকেন্ড পরে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '১ সেকেন্ড পরে',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'কয়েক সেকেন্ড আগে',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '১ সেকেন্ড আগে',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'কয়েক সেকেন্ড',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '১ সেকেন্ড',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 সেকেন্ড',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 সেকেন্ড',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '১ সেকেন্ড পরে',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'এক মিনিট কয়েক সেকেন্ড',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 বছর 3 মাস ১ দিন ১ সেকেন্ড',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '১ সপ্তাহ 10 ঘন্টা',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '১ সপ্তাহ 6 দিন',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '১ সপ্তাহ 6 দিন',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 সপ্তাহ এক ঘন্টা',
    ];
}
