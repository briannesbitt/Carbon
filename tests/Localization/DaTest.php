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

class DaTest extends LocalizationTestCase
{
    const LOCALE = 'da'; // Danish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i lørdags kl. 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'på søndag kl. 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i morgen kl. 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'i dag kl. 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i dag kl. 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'i går kl. 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'i tirsdags kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på tirsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på fredag kl. 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'få sekunder siden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekund siden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekunder siden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'et minut siden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minut siden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutter siden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minutter siden',
        // Carbon::now()->subHours(1)->diffForHumans()
        'en time siden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 time siden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timer siden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 timer siden',
        // Carbon::now()->subDays(1)->diffForHumans()
        'en dag siden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dag siden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dage siden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dage siden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uge siden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 uge siden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uger siden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 uger siden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'en måned siden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 måned siden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 måneder siden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 måneder siden',
        // Carbon::now()->subYears(1)->diffForHumans()
        'et år siden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 år siden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år siden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 år siden',
        // Carbon::now()->addSecond()->diffForHumans()
        'om få sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'få sekunder efter',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekund efter',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'få sekunder før',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund før',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'få sekunder',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'et minut få sekunder',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 måneder 1 dag 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uge 10 timer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uge 6 dage',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uge 6 dage',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uger en time',
    ];
}
