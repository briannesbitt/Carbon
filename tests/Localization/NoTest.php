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
class NoTest extends LocalizationTestCase
{
    public const LOCALE = 'no'; // Norwegian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i morgen kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på lørdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på søndag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på mandag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på tirsdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'på onsdag kl. 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'på torsdag kl. 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'på fredag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på tirsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på onsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på torsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på fredag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på lørdag kl. 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'i søndags kl. 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i går kl. 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'i dag kl. 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i dag kl. 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'i morgen kl. 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'på tirsdag kl. 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'i går kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i går kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i tirsdags kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i mandags kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i søndags kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i lørdags kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i fredags kl. 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'i torsdags kl. 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'i onsdags kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'i fredags kl. 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1. 1. 1. 1. 1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2. 1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3. 1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4. 1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5. 1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6. 1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7. 1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11. 2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100.',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 a.m. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a.m., 12:00 a.m.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 a.m., 1:30 a.m.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 a.m., 2:00 a.m.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 a.m., 6:00 a.m.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 a.m., 10:00 a.m.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 p.m., 12:00 p.m.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 p.m., 5:00 p.m.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 p.m., 9:30 p.m.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 p.m., 11:00 p.m.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekund siden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sek siden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sek siden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minutt siden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min siden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutter siden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min siden',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 time siden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 t siden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timer siden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 t siden',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dag siden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 d. siden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dager siden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 d. siden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uke siden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 u. siden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uker siden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 u. siden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 måned siden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 md. siden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 måneder siden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 md. siden',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 år siden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 år siden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år siden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 år siden',
        // Carbon::now()->addSecond()->diffForHumans()
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 sek',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekund etter',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sek etter',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund før',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sek før',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sek',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sek',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 sek',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutt 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 md. 1 d. 1 sek',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'om 3 år',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 md. siden',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 år 3 md. 1 d. 1 sek siden',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uke 10 timer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'om 1 uke og 6 dager',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uker 1 time',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'om en time',
        // CarbonInterval::days(2)->forHumans()
        '2 dager',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 t',
    ];
}
