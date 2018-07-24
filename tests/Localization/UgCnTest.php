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

class UgCnTest extends LocalizationTestCase
{
    const LOCALE = 'ug_CN'; // Uighur

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئالدىنقى شەنبە سائەت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'كېلەركى يەكشەنبە سائەت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ئەتە سائەت 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'بۈگۈن سائەت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بۈگۈن سائەت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'تۆنۈگۈن 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ئالدىنقى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'كېلەركى سەيشەنبە سائەت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'كېلەركى جۈمە سائەت 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'نەچچە سېكونت بۇرۇن',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's بۇرۇن',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سېكونت بۇرۇن',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's بۇرۇن',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'بىر مىنۇت بۇرۇن',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min بۇرۇن',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 مىنۇت بۇرۇن',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min بۇرۇن',
        // Carbon::now()->subHours(1)->diffForHumans()
        'بىر سائەت بۇرۇن',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h بۇرۇن',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 سائەت بۇرۇن',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h بۇرۇن',
        // Carbon::now()->subDays(1)->diffForHumans()
        'بىر كۈن بۇرۇن',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd بۇرۇن',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 كۈن بۇرۇن',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd بۇرۇن',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'بىر ھەپتە بۇرۇن',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w بۇرۇن',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ھەپتە بۇرۇن',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w بۇرۇن',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'بىر ئاي بۇرۇن',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm بۇرۇن',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ئاي بۇرۇن',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm بۇرۇن',
        // Carbon::now()->subYears(1)->diffForHumans()
        'بىر يىل بۇرۇن',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y بۇرۇن',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 يىل بۇرۇن',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y بۇرۇن',
        // Carbon::now()->addSecond()->diffForHumans()
        'نەچچە سېكونت كېيىن',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's كېيىن',
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
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سېكونت',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's كېيىن',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'بىر مىنۇت نەچچە سېكونت',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 10 سائەت',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 6 كۈن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'بىر ھەپتە 6 كۈن',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ھەپتە بىر سائەت',
    ];
}
