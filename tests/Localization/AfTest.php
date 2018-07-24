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

class AfTest extends LocalizationTestCase
{
    const LOCALE = 'af'; // Afrikaans

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Saterdag om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Sondag om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Môre om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Vandag om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Vandag om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Gister om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Laas Dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dinsdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Vrydag om 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '\'n paar sekondes gelede',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekond gelede',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekondes gelede',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekondes gelede',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '\'n minuut gelede',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minuut gelede',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minute gelede',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minute gelede',
        // Carbon::now()->subHours(1)->diffForHumans()
        '\'n uur gelede',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 uur gelede',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ure gelede',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ure gelede',
        // Carbon::now()->subDays(1)->diffForHumans()
        '\'n dag gelede',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dag gelede',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dae gelede',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dae gelede',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 week gelede',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 week gelede',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 weke gelede',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 weke gelede',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '\'n maand gelede',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 maand gelede',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 maande gelede',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 maande gelede',
        // Carbon::now()->subYears(1)->diffForHumans()
        '\'n jaar gelede',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 jaar gelede',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jare gelede',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 jare gelede',
        // Carbon::now()->addSecond()->diffForHumans()
        'oor \'n paar sekondes',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'oor 1 sekond',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '\'n paar sekondes na',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekond na',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '\'n paar sekondes voor',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekond voor',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '\'n paar sekondes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekond',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekondes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekondes',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'oor 1 sekond',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '\'n minuut \'n paar sekondes',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 jare 3 maande 1 dag 1 sekond',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 week 10 ure',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dae',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dae',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 weke \'n uur',
    ];
}
