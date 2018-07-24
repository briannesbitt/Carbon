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

class CsTest extends LocalizationTestCase
{
    const LOCALE = 'cs'; // Czech

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Saturday at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sunday at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Yesterday at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Friday at 12:00 AM',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekundu nazpět',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekundu nazpět',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekundy nazpět',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekundy nazpět',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minutu nazpět',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutu nazpět',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuty nazpět',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuty nazpět',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 hodinu nazpět',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 hodinu nazpět',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 hodiny nazpět',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 hodiny nazpět',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 den nazpět',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 den nazpět',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dny nazpět',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dny nazpět',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 týden nazpět',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 týden nazpět',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 týdny nazpět',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 týdny nazpět',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 měsíc nazpět',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 měsíc nazpět',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 měsíce nazpět',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 měsíce nazpět',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 rok nazpět',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 rok nazpět',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 roky nazpět',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 roky nazpět',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekundu',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sekundu',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekundu později',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekundu později',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekundu předtím',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekundu předtím',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekundu',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekundu',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundy',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekundy',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1 sekundu',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutu 1 sekundu',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 roky 3 měsíce 1 den 1 sekundu',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 týden 10 hodin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 týden 6 dní',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 týden 6 dní',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 týdny 1 hodinu',
    ];
}
