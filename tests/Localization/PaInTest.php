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

class PaInTest extends LocalizationTestCase
{
    const LOCALE = 'pa_IN'; // Panjabi

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::now()->subDays(2)->calendar()
        'ਅਗਲਾ ਐਤਵਾਰ, ਰਾਤ 8:49 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਕਲ ਰਾਤ 10:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ਅਜ ਦੁਪਹਿਰ 10:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਜ ਰਾਤ 2:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ਕਲ ਰਾਤ 1:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਪਿਛਲੇ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
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
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ਰਾਤ, 12:00 ਰਾਤ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ਰਾਤ, 1:30 ਰਾਤ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ਰਾਤ, 2:00 ਰਾਤ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ਸਵੇਰ, 6:00 ਸਵੇਰ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ਦੁਪਹਿਰ, 10:00 ਦੁਪਹਿਰ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ਦੁਪਹਿਰ, 12:00 ਦੁਪਹਿਰ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ਸ਼ਾਮ, 5:00 ਸ਼ਾਮ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ਰਾਤ, 11:00 ਰਾਤ',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ਕੁਝ ਸਕਿੰਟ ਪਿਛਲੇ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ਪਿਛਲੇ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ਸਕਿੰਟ ਪਿਛਲੇ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ਪਿਛਲੇ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ਇਕ ਮਿੰਟ ਪਿਛਲੇ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ਪਿਛਲੇ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ਮਿੰਟ ਪਿਛਲੇ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ਪਿਛਲੇ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ਇੱਕ ਘੰਟਾ ਪਿਛਲੇ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ਪਿਛਲੇ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ਘੰਟੇ ਪਿਛਲੇ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ਪਿਛਲੇ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ਇੱਕ ਦਿਨ ਪਿਛਲੇ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ਪਿਛਲੇ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ਦਿਨ ਪਿਛਲੇ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ਪਿਛਲੇ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ਹਫਤਾ ਪਿਛਲੇ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ਪਿਛਲੇ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ਹਫ਼ਤੇ ਪਿਛਲੇ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ਪਿਛਲੇ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ਇੱਕ ਮਹੀਨਾ ਪਿਛਲੇ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ਪਿਛਲੇ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ਮਹੀਨੇ ਪਿਛਲੇ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ਪਿਛਲੇ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ਇੱਕ ਸਾਲ ਪਿਛਲੇ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ਪਿਛਲੇ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ਸਾਲ ਪਿਛਲੇ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ਪਿਛਲੇ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's ਵਿੱਚ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ਸਕਿੰਟ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's ਵਿੱਚ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ਇਕ ਮਿੰਟ ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 10 ਘੰਟੇ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 6 ਦਿਨ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 6 ਦਿਨ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ਹਫ਼ਤੇ ਇੱਕ ਘੰਟਾ',
    ];
}
