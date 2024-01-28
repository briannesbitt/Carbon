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
class PaTest extends LocalizationTestCase
{
    public const LOCALE = 'pa'; // Panjabi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਐਤਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਸੋਮਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਗਲਾ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ਅਗਲਾ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ਅਗਲਾ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::now()->subDays(2)->calendar()
        'ਪਿਛਲੇ ਐਤਵਾਰ, ਰਾਤ 8:49 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਕਲ ਰਾਤ 10:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ਅਜ ਦੁਪਹਿਰ 10:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਅਜ ਰਾਤ 2:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ਕਲ ਰਾਤ 1:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਸੋਮਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਐਤਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ਪਿਛਲੇ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ਪਿਛਲੇ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ਪਿਛਲੇ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ਪਿਛਲੇ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',
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
        '12:00 ਰਾਤ CET',
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
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ਰਾਤ, 9:30 ਰਾਤ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ਰਾਤ, 11:00 ਰਾਤ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ਸਕਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ਸਕਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ਇਕ ਮਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ਇਕ ਮਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ਮਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ਮਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ਇੱਕ ਘੰਟਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ਇੱਕ ਘੰਟਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ਘੰਟੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ਘੰਟੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ਇੱਕ ਦਿਨ ਪਹਿਲਾਂ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ਇੱਕ ਦਿਨ ਪਹਿਲਾਂ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ਦਿਨ ਪਹਿਲਾਂ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ਦਿਨ ਪਹਿਲਾਂ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ਹਫਤਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ਹਫਤਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ਹਫ਼ਤੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ਹਫ਼ਤੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ਇੱਕ ਮਹੀਨਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ਇੱਕ ਮਹੀਨਾ ਪਹਿਲਾਂ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ਮਹੀਨੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ਮਹੀਨੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ਇੱਕ ਸਾਲ ਪਹਿਲਾਂ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ਇੱਕ ਸਾਲ ਪਹਿਲਾਂ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ਸਾਲ ਪਹਿਲਾਂ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ਸਾਲ ਪਹਿਲਾਂ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਬਾਅਦ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਬਾਅਦ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਪਹਿਲਾਂ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਪਹਿਲਾਂ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ਸਕਿੰਟ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ਸਕਿੰਟ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ਇਕ ਮਿੰਟ ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ਸਾਲ 3 ਮਹੀਨੇ ਇੱਕ ਦਿਨ ਕੁਝ ਸਕਿੰਟ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ਸਾਲ ਵਿੱਚ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ਮਹੀਨੇ ਪਹਿਲਾਂ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ਸਾਲ 3 ਮਹੀਨੇ ਇੱਕ ਦਿਨ ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 10 ਘੰਟੇ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 6 ਦਿਨ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ਹਫਤਾ 6 ਦਿਨ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ਹਫਤਾ ਅਤੇ 6 ਦਿਨ ਵਿੱਚ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ਹਫ਼ਤੇ ਇੱਕ ਘੰਟਾ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ਇੱਕ ਘੰਟਾ ਵਿੱਚ',
        // CarbonInterval::days(2)->forHumans()
        '2 ਦਿਨ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ਇੱਕ ਦਿਨ 3 ਘੰਟੇ',
    ];
}
