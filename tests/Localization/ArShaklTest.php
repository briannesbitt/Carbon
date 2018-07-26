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

class ArShaklTest extends LocalizationTestCase
{
    const LOCALE = 'ar_Shakl'; // Arabic

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'غدًا عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'السبت عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الأحد عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الإثنين عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الثلاثاء عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الأربعاء عند الساعة 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'الخميس عند الساعة 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'الجمعة عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الثلاثاء عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الأربعاء عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الخميس عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الجمعة عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'السبت عند الساعة 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'الأحد عند الساعة 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'أمس عند الساعة 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'اليوم عند الساعة 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اليوم عند الساعة 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'غدًا عند الساعة 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الثلاثاء عند الساعة 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'أمس عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'أمس عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الثلاثاء عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الإثنين عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الأحد عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'السبت عند الساعة 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'الجمعة عند الساعة 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'الخميس عند الساعة 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'الأربعاء عند الساعة 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'الجمعة عند الساعة 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 52 52',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 52',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 52',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 52',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 52',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 1',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ص cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ص, 12:00 ص',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ص, 1:30 ص',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ص, 2:00 ص',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ص, 6:00 ص',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ص, 10:00 ص',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 م, 12:00 م',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 م, 5:00 م',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 م, 9:30 م',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 م, 11:00 م',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'مُنْذُ ثَانِيَة',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'مُنْذُ s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'مُنْذُ ثَانِيَتَيْن',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'مُنْذُ s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'مُنْذُ دَقِيقَة',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'مُنْذُ min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'مُنْذُ دَقِيقَتَيْن',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'مُنْذُ min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'مُنْذُ سَاعَة',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'مُنْذُ h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'مُنْذُ سَاعَتَيْن',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'مُنْذُ h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'مُنْذُ يَوْم',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'مُنْذُ d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'مُنْذُ يَوْمَيْن',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'مُنْذُ d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'مُنْذُ أُسْبُوع',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'مُنْذُ w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'مُنْذُ أُسْبُوعَيْن',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'مُنْذُ w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'مُنْذُ شَهْرَ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'مُنْذُ m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'مُنْذُ شَهْرَيْن',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'مُنْذُ m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'مُنْذُ سَنَة',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'مُنْذُ y',
        // Carbon::now()->subYears(2)->diffForHumans()
        'مُنْذُ سَنَتَيْن',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'مُنْذُ y',
        // Carbon::now()->addSecond()->diffForHumans()
        'مِنَ الْآن ثَانِيَة',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'مِنَ الْآن s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'بَعْدَ ثَانِيَة',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'بَعْدَ s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'قَبْلَ ثَانِيَة',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'قَبْلَ s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ثَانِيَة',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'ثَانِيَتَيْن',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'مِنَ الْآن s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'دَقِيقَة ثَانِيَة',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'مِنَ الْآن سَنَوَات 3',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'مُنْذُ m',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'مُنْذُ y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'أُسْبُوع سَاعَات 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'أُسْبُوع أَيَّام 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'أُسْبُوع أَيَّام 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'أُسْبُوعَيْن سَاعَة',
        // CarbonInterval::days(2)->forHumans()
        'يَوْمَيْن',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'يَوْم سَاعَات 3',
    ];
}
