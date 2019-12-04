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

class KuTest extends LocalizationTestCase
{
    const LOCALE = 'ku'; // Kurdish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'یەک شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'دوو شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سێ شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'چوار شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'پێنج شەممە at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'هەینی at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'شەممە at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'چوار شەممە at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'پێنج شەممە at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'هەینی at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'شەممە at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'یەک شەممە at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last دوو شەممە at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'چوار شەممە at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last چوار شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last سێ شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last دوو شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last یەک شەممە at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last شەممە at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last هەینی at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last پێنج شەممە at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last شەممە at 12:00 AM',
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
        '6 2',
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
        '12:00 am CET',
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
        'لەمەوبەر چرکە',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'لەمەوبەر چرکە',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'لەمەوبەر چرکە',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'لەمەوبەر چرکە',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'لەمەوبەر خولەک',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'لەمەوبەر خولەک',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'لەمەوبەر خولەک',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'لەمەوبەر خولەک',
        // Carbon::now()->subHours(1)->diffForHumans()
        'لەمەوبەر کاژێر',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'لەمەوبەر کاژێر',
        // Carbon::now()->subHours(2)->diffForHumans()
        'لەمەوبەر کاژێر',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'لەمەوبەر کاژێر',
        // Carbon::now()->subDays(1)->diffForHumans()
        'لەمەوبەر ڕۆژ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'لەمەوبەر ڕۆژ',
        // Carbon::now()->subDays(2)->diffForHumans()
        'لەمەوبەر ڕۆژ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'لەمەوبەر ڕۆژ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'لەمەوبەر هەفتە',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'لەمەوبەر هەفتە',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'لەمەوبەر هەفتە',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'لەمەوبەر هەفتە',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'لەمەوبەر مانگ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'لەمەوبەر مانگ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'لەمەوبەر مانگ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'لەمەوبەر مانگ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'لەمەوبەر ساڵ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'لەمەوبەر ساڵ',
        // Carbon::now()->subYears(2)->diffForHumans()
        'لەمەوبەر ساڵ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'لەمەوبەر ساڵ',
        // Carbon::now()->addSecond()->diffForHumans()
        'چرکە لە ئێستاوە',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'چرکە لە ئێستاوە',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'دوای چرکە',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'دوای چرکە',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'پێش چرکە',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'پێش چرکە',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'چرکە',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'چرکە',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'چرکە',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'چرکە',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'چرکە لە ئێستاوە',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'خولەک چرکە',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'ساڵ 3 مانگ ڕۆژ چرکە',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ساڵ لە ئێستاوە',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'لەمەوبەر 5 مانگ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'لەمەوبەر ساڵ 3 مانگ ڕۆژ چرکە',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'هەفتە 10 کاژێر',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'هەفتە 6 ڕۆژ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'هەفتە 6 ڕۆژ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'هەفتە û 6 ڕۆژ لە ئێستاوە',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'هەفتە کاژێر',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'کاژێر لە ئێستاوە',
        // CarbonInterval::days(2)->forHumans()
        'ڕۆژ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ڕۆژ 3 کاژێر',
    ];
}
