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

class NbTest extends LocalizationTestCase
{
    const LOCALE = 'nb'; // NorwegianBokmal

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige lørdag kl. 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'søndag kl. 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i morgen kl. 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'i dag kl. 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i dag kl. 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'i går kl. 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'forrige tirsdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tirsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fredag kl. 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'noen sekunder siden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's siden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's siden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ett minutt siden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min siden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutter siden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min siden',
        // Carbon::now()->subHours(1)->diffForHumans()
        'en time siden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h siden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timer siden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h siden',
        // Carbon::now()->subDays(1)->diffForHumans()
        'en dag siden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd siden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dager siden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd siden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uke siden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w siden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uker siden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w siden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'en måned siden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm siden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 måneder siden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm siden',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ett år siden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y siden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år siden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y siden',
        // Carbon::now()->addSecond()->diffForHumans()
        'om noen sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'noen sekunder',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ett minutt noen sekunder',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uke 10 timer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uker en time',
    ];
}
