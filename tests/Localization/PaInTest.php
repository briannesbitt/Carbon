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
class PaInTest extends LocalizationTestCase
{
    public const LOCALE = 'pa_IN'; // Panjabi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM'
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM'
        'ਅਗਲਾ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM'
        'ਅਗਲਾ ਐਤਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM'
        'ਅਗਲਾ ਸੋਮਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'ਅਗਲਾ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM'
        'ਅਗਲਾ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM'
        'ਅਗਲਾ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'ਅਗਲਾ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM'
        'ਅਗਲਾ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM'
        'ਅਗਲਾ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM'
        'ਅਗਲਾ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM'
        'ਪਿਛਲੇ ਐਤਵਾਰ, ਰਾਤ 8:49 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM'
        'ਕਲ ਰਾਤ 10:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM'
        'ਅਜ ਦੁਪਹਿਰ 10:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM'
        'ਅਜ ਰਾਤ 2:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM'
        'ਕਲ ਰਾਤ 1:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'ਅਗਲਾ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'ਕਲ ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM'
        'ਪਿਛਲੇ ਮੰਗਲਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM'
        'ਪਿਛਲੇ ਸੋਮਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM'
        'ਪਿਛਲੇ ਐਤਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM'
        'ਪਿਛਲੇ ਸ਼ਨੀਚਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'ਪਿਛਲੇ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM'
        'ਪਿਛਲੇ ਵੀਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM'
        'ਪਿਛਲੇ ਬੁਧਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'ਪਿਛਲੇ ਸ਼ੁੱਕਰਵਾਰ, ਰਾਤ 12:00 ਵਜੇ',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st'
        '1 1 1 1 1',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st'
        '2 1',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st'
        '3 1',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st'
        '4 1',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st'
        '5 1',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st'
        '6 1',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 1st'
        '7 2',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd'
        '11 2',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th'
        '40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st'
        '41',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th'
        '100',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET'
        '12:00 ਰਾਤ CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am'
        '12:00 ਰਾਤ, 12:00 ਰਾਤ',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am'
        '1:30 ਰਾਤ, 1:30 ਰਾਤ',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am'
        '2:00 ਰਾਤ, 2:00 ਰਾਤ',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am'
        '6:00 ਸਵੇਰ, 6:00 ਸਵੇਰ',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am'
        '10:00 ਦੁਪਹਿਰ, 10:00 ਦੁਪਹਿਰ',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm'
        '12:00 ਦੁਪਹਿਰ, 12:00 ਦੁਪਹਿਰ',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm'
        '5:00 ਸ਼ਾਮ, 5:00 ਸ਼ਾਮ',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm'
        '9:30 ਰਾਤ, 9:30 ਰਾਤ',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm'
        '11:00 ਰਾਤ, 11:00 ਰਾਤ',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th'
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago'
        'ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago'
        'ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago'
        '2 ਸਕਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago'
        '2 ਸਕਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago'
        'ਇਕ ਮਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago'
        'ਇਕ ਮਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago'
        '2 ਮਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago'
        '2 ਮਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago'
        'ਇੱਕ ਘੰਟਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago'
        'ਇੱਕ ਘੰਟਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago'
        '2 ਘੰਟੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago'
        '2 ਘੰਟੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago'
        'ਇੱਕ ਦਿਨ ਪਹਿਲਾਂ',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago'
        'ਇੱਕ ਦਿਨ ਪਹਿਲਾਂ',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago'
        '2 ਦਿਨ ਪਹਿਲਾਂ',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago'
        '2 ਦਿਨ ਪਹਿਲਾਂ',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago'
        'ਹਫਤਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago'
        'ਹਫਤਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago'
        '2 ਹਫ਼ਤੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago'
        '2 ਹਫ਼ਤੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago'
        'ਇੱਕ ਮਹੀਨਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago'
        'ਇੱਕ ਮਹੀਨਾ ਪਹਿਲਾਂ',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago'
        '2 ਮਹੀਨੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago'
        '2 ਮਹੀਨੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago'
        'ਇੱਕ ਸਾਲ ਪਹਿਲਾਂ',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago'
        'ਇੱਕ ਸਾਲ ਪਹਿਲਾਂ',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago'
        '2 ਸਾਲ ਪਹਿਲਾਂ',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago'
        '2 ਸਾਲ ਪਹਿਲਾਂ',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now'
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now'
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after'
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਬਾਅਦ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after'
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਬਾਅਦ',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before'
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਪਹਿਲਾਂ',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before'
        'ਕੁਝ ਸਕਿੰਟ ਤੋਂ ਪਹਿਲਾਂ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second'
        'ਕੁਝ ਸਕਿੰਟ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s'
        'ਕੁਝ ਸਕਿੰਟ',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds'
        '2 ਸਕਿੰਟ',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s'
        '2 ਸਕਿੰਟ',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now'
        'ਕੁਝ ਸਕਿੰਟ ਵਿੱਚ',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second'
        'ਇਕ ਮਿੰਟ ਕੁਝ ਸਕਿੰਟ',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s'
        '2 ਸਾਲ 3 ਮਹੀਨੇ ਇੱਕ ਦਿਨ ਕੁਝ ਸਕਿੰਟ',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now'
        '3 ਸਾਲ ਵਿੱਚ',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago'
        '5 ਮਹੀਨੇ ਪਹਿਲਾਂ',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago'
        '2 ਸਾਲ 3 ਮਹੀਨੇ ਇੱਕ ਦਿਨ ਕੁਝ ਸਕਿੰਟ ਪਹਿਲਾਂ',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours'
        'ਹਫਤਾ 10 ਘੰਟੇ',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        'ਹਫਤਾ 6 ਦਿਨ',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        'ਹਫਤਾ 6 ਦਿਨ',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now'
        'ਹਫਤਾ ਅਤੇ 6 ਦਿਨ ਵਿੱਚ',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour'
        '2 ਹਫ਼ਤੇ ਇੱਕ ਘੰਟਾ',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now'
        'ਇੱਕ ਘੰਟਾ ਵਿੱਚ',

        // CarbonInterval::days(2)->forHumans()
        // '2 days'
        '2 ਦਿਨ',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h'
        'ਇੱਕ ਦਿਨ 3 ਘੰਟੇ',
    ];
}
