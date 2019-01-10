<?php

/**
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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i morgen kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lørdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'søndag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mandag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tirsdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'onsdag kl. 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'torsdag kl. 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'fredag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tirsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'onsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'torsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fredag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lørdag kl. 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'forrige søndag kl. 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i går kl. 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'i dag kl. 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i dag kl. 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'i morgen kl. 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tirsdag kl. 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'i går kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'i går kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige tirsdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige mandag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige søndag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige lørdag kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'forrige fredag kl. 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'forrige torsdag kl. 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'forrige onsdag kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'forrige fredag kl. 00:00',
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
        '12:00 am cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'noen sekunder siden',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'noen sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekunder siden',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekunder siden',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ett minutt siden',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ett minutt siden',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutter siden',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minutter siden',
        // Carbon::now()->subHours(1)->diffForHumans()
        'en time siden',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'en time siden',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timer siden',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 timer siden',
        // Carbon::now()->subDays(1)->diffForHumans()
        'en dag siden',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'en dag siden',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dager siden',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dager siden',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uke siden',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 uke siden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uker siden',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 uker siden',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'en måned siden',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'en måned siden',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 måneder siden',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 måneder siden',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ett år siden',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ett år siden',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år siden',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 år siden',
        // Carbon::now()->addSecond()->diffForHumans()
        'om noen sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om noen sekunder',
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
        'noen sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om noen sekunder',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ett minutt noen sekunder',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 måneder en dag noen sekunder',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'om 3 år',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 måneder siden',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 år 3 måneder en dag noen sekunder siden',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uke 10 timer',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dager',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uker en time',
        // CarbonInterval::days(2)->forHumans()
        '2 dager',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'en dag 3 timer',
    ];
}
