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

class NlBeTest extends LocalizationTestCase
{
    const LOCALE = 'nl_BE'; // Dutch

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'afgelopen zaterdag om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'zondag om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'morgen om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'vandaag om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'vandaag om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'gisteren om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'afgelopen dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dinsdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vrijdag om 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'een paar seconden geleden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s geleden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 seconden geleden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s geleden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'één minuut geleden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1mi geleden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuten geleden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2mi geleden',
        // Carbon::now()->subHours(1)->diffForHumans()
        'één uur geleden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1u geleden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 uur geleden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2u geleden',
        // Carbon::now()->subDays(1)->diffForHumans()
        'één dag geleden',
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
        'één maand geleden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1ma geleden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 maanden geleden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2ma geleden',
        // Carbon::now()->subYears(1)->diffForHumans()
        'één jaar geleden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1j geleden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jaar geleden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2j geleden',
        // Carbon::now()->addSecond()->diffForHumans()
        'over een paar seconden',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'over 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'een paar seconden later',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s later',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'een paar seconden eerder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s eerder',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'een paar seconden',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 seconden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'over 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'één minuut een paar seconden',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2j 3ma 1d 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 week 10 uur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dagen',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 weken één uur',
    ];
}
