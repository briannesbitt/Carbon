<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Josh Soref
 * - Shakib Hossain
 * - Raju
 * - Aniruddha Adhikary
 * - JD Isaacks
 * - Saiful Islam
 * - Faisal Islam
 */
return [
    'year' => ':count বছর',
    'a_year' => 'এক বছর|:count বছর',
    'y' => '১ বছর|:count বছর',
    'month' => ':count মাস',
    'a_month' => 'এক মাস|:count মাস',
    'm' => '১ মাস|:count মাস',
    'week' => ':count সপ্তাহ',
    'a_week' => '১ সপ্তাহ|:count সপ্তাহ',
    'w' => '১ সপ্তাহ|:count সপ্তাহ',
    'day' => ':count দিন',
    'a_day' => 'এক দিন|:count দিন',
    'd' => '১ দিন|:count দিন',
    'hour' => ':count ঘন্টা',
    'a_hour' => 'এক ঘন্টা|:count ঘন্টা',
    'h' => '১ ঘন্টা|:count ঘন্টা',
    'minute' => ':count মিনিট',
    'a_minute' => 'এক মিনিট|:count মিনিট',
    'min' => '১ মিনিট|:count মিনিট',
    'second' => ':count সেকেন্ড',
    'a_second' => 'কয়েক সেকেন্ড|:count সেকেন্ড',
    's' => '১ সেকেন্ড|:count সেকেন্ড',
    'ago' => ':time আগে',
    'from_now' => ':time পরে',
    'after' => ':time পরে',
    'before' => ':time আগে',
    'diff_now' => 'এখন',
    'diff_today' => 'আজ',
    'diff_yesterday' => 'গতকাল',
    'diff_tomorrow' => 'আগামীকাল',
    'period_recurrences' => ':count বার|:count বার',
    'period_interval' => 'প্রতি :interval',
    'period_start_date' => ':date থেকে',
    'period_end_date' => ':date পর্যন্ত',
    'formats' => [
        'LT' => 'A Oh:Om সময়',
        'LTS' => 'A Oh:Om:Os সময়',
        'L' => 'OD/OM/OY',
        'LL' => 'OD MMMM OY',
        'LLL' => 'OD MMMM OY, A Oh:Om সময়',
        'LLLL' => 'dddd, OD MMMM OY, A Oh:Om সময়',
    ],
    'calendar' => [
        'sameDay' => '[আজ] LT',
        'nextDay' => '[আগামীকাল] LT',
        'nextWeek' => 'dddd, LT',
        'lastDay' => '[গতকাল] LT',
        'lastWeek' => '[গত] dddd, LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour) {
        if ($hour < 4) {
            return 'রাত';
        }
        if ($hour < 10) {
            return 'সকাল';
        }
        if ($hour < 17) {
            return 'দুপুর';
        }
        if ($hour < 20) {
            return 'বিকাল';
        }

        return 'রাত';
    },
    'months' => ['জানুয়ারী', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'],
    'months_short' => ['জানু', 'ফেব', 'মার্চ', 'এপ্র', 'মে', 'জুন', 'জুল', 'আগ', 'সেপ্ট', 'অক্টো', 'নভে', 'ডিসে'],
    'weekdays' => ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার'],
    'weekdays_short' => ['রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহস্পতি', 'শুক্র', 'শনি'],
    'weekdays_min' => ['রবি', 'সোম', 'মঙ্গ', 'বুধ', 'বৃহঃ', 'শুক্র', 'শনি'],
    'list' => [', ', ' এবং '],
    'first_day_of_week' => 0,
    'day_of_first_week_of_year' => 1,
    'weekdays_standalone' => ['রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহষ্পতিবার', 'শুক্রবার', 'শনিবার'],
    'weekdays_min_standalone' => ['রঃ', 'সোঃ', 'মঃ', 'বুঃ', 'বৃঃ', 'শুঃ', 'শনি'],
    'months_short_standalone' => ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'],
    'alt_numbers' => ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'],
];
