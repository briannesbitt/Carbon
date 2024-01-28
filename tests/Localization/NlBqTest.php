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
class NlBqTest extends LocalizationTestCase
{
    public const LOCALE = 'nl_BQ'; // Dutch

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'morgen om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'zaterdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'zondag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'maandag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'woensdag om 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'donderdag om 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'vrijdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dinsdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'woensdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'donderdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vrijdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'zaterdag om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'afgelopen zondag om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gisteren om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'vandaag om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'vandaag om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'morgen om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dinsdag om 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'gisteren om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gisteren om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen maandag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen zondag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen zaterdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen vrijdag om 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'afgelopen donderdag om 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'afgelopen woensdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'afgelopen vrijdag om 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1ste 1ste 1ste 1ste 1ste',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2de 1ste',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3de 1ste',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4de 1ste',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5de 1ste',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6de 1ste',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7de 1ste',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11de 2de',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40ste',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41ste',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100ste',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 \'s ochtends CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 \'s ochtends, 12:00 \'s ochtends',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 \'s ochtends, 1:30 \'s ochtends',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 \'s ochtends, 2:00 \'s ochtends',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 \'s ochtends, 6:00 \'s ochtends',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 \'s ochtends, 10:00 \'s ochtends',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 \'s middags, 12:00 \'s middags',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 \'s middags, 5:00 \'s middags',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 \'s middags, 9:30 \'s middags',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 \'s middags, 11:00 \'s middags',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0de',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 seconde geleden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s geleden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 seconden geleden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s geleden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuut geleden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1min geleden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuten geleden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2min geleden',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 uur geleden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1u geleden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 uur geleden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2u geleden',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dag geleden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d geleden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagen geleden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d geleden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 week geleden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1w geleden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 weken geleden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2w geleden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 maand geleden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mnd geleden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 maanden geleden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mnd geleden',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 jaar geleden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1j geleden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jaar geleden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2j geleden',
        // Carbon::now()->addSecond()->diffForHumans()
        'over 1 seconde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'over 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 seconde later',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s later',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 seconde eerder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s eerder',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 seconde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 seconden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'over 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuut 1 seconde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2j 3mnd 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'over 3 jaar',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5mnd geleden',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2j 3mnd 1d 1s geleden',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 week 10 uur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'over 1 week en 6 dagen',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 weken 1 uur',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'over een uur',
        // CarbonInterval::days(2)->forHumans()
        '2 dagen',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3u',
    ];
}
