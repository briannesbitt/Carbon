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
class UgCnTest extends LocalizationTestCase
{
    public const LOCALE = 'ug_CN'; // Uighur

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئەتە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى شەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى يەكشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى دۈشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى چارشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'كېلەركى پەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'كېلەركى جۈمە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى چارشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى پەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى جۈمە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى شەنبە سائەت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'ئالدىنقى يەكشەنبە سائەت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'تۆنۈگۈن 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'بۈگۈن سائەت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بۈگۈن سائەت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ئەتە سائەت 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'تۆنۈگۈن 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'تۆنۈگۈن 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى دۈشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى يەكشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى شەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى جۈمە سائەت 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ئالدىنقى پەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ئالدىنقى چارشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ئالدىنقى جۈمە سائەت 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1-كۈنى 1-ھەپتە 1-ھەپتە',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-كۈنى 1-ھەپتە',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-كۈنى 2-ھەپتە',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-كۈنى',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-كۈنى',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-كۈنى',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 يېرىم كېچە CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 يېرىم كېچە, 12:00 يېرىم كېچە',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 يېرىم كېچە, 1:30 يېرىم كېچە',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 يېرىم كېچە, 2:00 يېرىم كېچە',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 سەھەر, 6:00 سەھەر',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 چۈشتىن بۇرۇن, 10:00 چۈشتىن بۇرۇن',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 چۈش, 12:00 چۈش',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 چۈشتىن كېيىن, 5:00 چۈشتىن كېيىن',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 كەچ, 9:30 كەچ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 كەچ, 11:00 كەچ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'نەچچە سېكونت بۇرۇن',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'نەچچە سېكونت بۇرۇن',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سېكونت بۇرۇن',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 سېكونت بۇرۇن',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'بىر مىنۇت بۇرۇن',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'بىر مىنۇت بۇرۇن',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 مىنۇت بۇرۇن',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 مىنۇت بۇرۇن',
        // Carbon::now()->subHours(1)->diffForHumans()
        'بىر سائەت بۇرۇن',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'بىر سائەت بۇرۇن',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 سائەت بۇرۇن',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 سائەت بۇرۇن',
        // Carbon::now()->subDays(1)->diffForHumans()
        'بىر كۈن بۇرۇن',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'بىر كۈن بۇرۇن',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 كۈن بۇرۇن',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 كۈن بۇرۇن',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'بىر ھەپتە بۇرۇن',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'بىر ھەپتە بۇرۇن',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ھەپتە بۇرۇن',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ھەپتە بۇرۇن',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'بىر ئاي بۇرۇن',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'بىر ئاي بۇرۇن',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ئاي بۇرۇن',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ئاي بۇرۇن',
        // Carbon::now()->subYears(1)->diffForHumans()
        'بىر يىل بۇرۇن',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'بىر يىل بۇرۇن',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 يىل بۇرۇن',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 يىل بۇرۇن',
        // Carbon::now()->addSecond()->diffForHumans()
        'نەچچە سېكونت كېيىن',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'نەچچە سېكونت كېيىن',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'نەچچە سېكونت',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'نەچچە سېكونت',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سېكونت',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 سېكونت',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'نەچچە سېكونت كېيىن',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'بىر مىنۇت نەچچە سېكونت',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 يىل 3 ئاي بىر كۈن نەچچە سېكونت',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 يىل كېيىن',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ئاي بۇرۇن',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 يىل 3 ئاي بىر كۈن نەچچە سېكونت بۇرۇن',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 10 سائەت',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 6 كۈن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 6 كۈن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'بىر ھەپتە ۋە 6 كۈن كېيىن',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ھەپتە بىر سائەت',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'بىر سائەت كېيىن',
        // CarbonInterval::days(2)->forHumans()
        '2 كۈن',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'بىر كۈن 3 سائەت',
    ];
}
