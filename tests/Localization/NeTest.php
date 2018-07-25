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

class NeTest extends LocalizationTestCase
{
    const LOCALE = 'ne'; // Nepali

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'हिजो रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'गएको शनिबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'गएको आइतबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'गएको सोमबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'गएको मङ्गलबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'गएको बुधबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'गएको बिहिबार, रातिको 12:00 बजे',
        // Carbon::now()->subDays(2)->calendar()
        'आउँदो आइतबार, रातिको 8:49 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'भोलि रातिको 10:00 बजे',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'आज बिहानको 10:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आज रातिको 2:00 बजे',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'हिजो रातिको 1:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'गएको मङ्गलबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'भोलि रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आउँदो मङ्गलबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आउँदो सोमबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आउँदो आइतबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आउँदो शनिबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'आउँदो शुक्रबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'आउँदो बिहिबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'आउँदो शुक्रबार, रातिको 12:00 बजे',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        'ordinal ordinal ordinal ordinal ordinal',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 राति, 12:00 राति',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 राति, 1:30 राति',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 राति, 2:00 राति',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 बिहान, 6:00 बिहान',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 बिहान, 10:00 बिहान',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 दिउँसो, 12:00 दिउँसो',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 साँझ, 5:00 साँझ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 राति, 11:00 राति',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        'ordinal',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'केही क्षण अगाडि',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 सेकेण्ड अगाडि',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 सेकेण्ड अगाडि',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 सेकेण्ड अगाडि',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'एक मिनेट अगाडि',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 मिनेट अगाडि',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 मिनेट अगाडि',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 मिनेट अगाडि',
        // Carbon::now()->subHours(1)->diffForHumans()
        'एक घण्टा अगाडि',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 घण्टा अगाडि',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 घण्टा अगाडि',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 घण्टा अगाडि',
        // Carbon::now()->subDays(1)->diffForHumans()
        'एक दिन अगाडि',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 दिन अगाडि',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 दिन अगाडि',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 दिन अगाडि',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 हप्ता अगाडि',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 हप्ता अगाडि',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 हप्ता अगाडि',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 हप्ता अगाडि',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'एक महिना अगाडि',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 महिना अगाडि',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 महिना अगाडि',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 महिना अगाडि',
        // Carbon::now()->subYears(1)->diffForHumans()
        'एक बर्ष अगाडि',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 वर्ष अगाडि',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 बर्ष अगाडि',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 वर्ष अगाडि',
        // Carbon::now()->addSecond()->diffForHumans()
        'केही क्षणमा',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 सेकेण्डमा',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'केही क्षण पछि',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 सेकेण्ड पछि',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'केही क्षण अघि',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 सेकेण्ड अघि',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'केही क्षण',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 सेकेण्ड',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 सेकेण्ड',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 सेकेण्ड',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 सेकेण्डमा',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'एक मिनेट केही क्षण',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 वर्ष 3 महिना 1 दिन 1 सेकेण्ड',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 हप्ता 10 घण्टा',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 हप्ता 6 दिन',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 हप्ता 6 दिन',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 हप्ता एक घण्टा',
    ];
}
