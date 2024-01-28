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
class MasTzTest extends LocalizationTestCase
{
    public const LOCALE = 'mas_TZ'; // Masai

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumamósi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumapílí at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumatátu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumane at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumatánɔ at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Alaámisi at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jumáa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumane at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumatánɔ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Alaámisi at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumáa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumamósi at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Jumapílí at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumane at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumane at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumatátu at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumapílí at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumamósi at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumáa at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Alaámisi at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Jumatánɔ at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Jumáa at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ɛnkakɛnyá CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Ɛnkakɛnyá, 12:00 ɛnkakɛnyá',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 Ɛnkakɛnyá, 1:30 ɛnkakɛnyá',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 Ɛnkakɛnyá, 2:00 ɛnkakɛnyá',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 Ɛnkakɛnyá, 6:00 ɛnkakɛnyá',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 Ɛnkakɛnyá, 10:00 ɛnkakɛnyá',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 Ɛndámâ, 12:00 ɛndámâ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 Ɛndámâ, 5:00 ɛndámâ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 Ɛndámâ, 9:30 ɛndámâ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 Ɛndámâ, 11:00 ɛndámâ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 are ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 are ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 are ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 are ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minute ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutes ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 esahabu ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 esahabu ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 esahabu ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 esahabu ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 enkolongʼ ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 enkolongʼ ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 enkolongʼ ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 enkolongʼ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 engolongeare orwiki ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 engolongeare orwiki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 engolongeare orwiki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 engolongeare orwiki ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 olapa ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 olapa ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 olapa ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 olapa ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 olameyu ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 olameyu ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 olameyu ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 olameyu ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 are from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 are from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 are after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 are after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 are before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 are before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 are',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 are',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 are',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 are',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 are from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute 1 are',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 olameyu 3 olapa 1 enkolongʼ 1 are',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 olameyu from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 olapa ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 olameyu 3 olapa 1 enkolongʼ 1 are ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 engolongeare orwiki 10 esahabu',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 engolongeare orwiki 6 enkolongʼ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 engolongeare orwiki 6 enkolongʼ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 engolongeare orwiki and 6 enkolongʼ from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 engolongeare orwiki 1 esahabu',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 esahabu from now',
        // CarbonInterval::days(2)->forHumans()
        '2 enkolongʼ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 enkolongʼ 3 esahabu',
    ];
}
