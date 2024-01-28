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
class FrGpTest extends LocalizationTestCase
{
    public const LOCALE = 'fr_GP'; // French

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Demain à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'samedi à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimanche à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lundi à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mardi à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mercredi à 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'jeudi à 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'vendredi à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mardi à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mercredi à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'jeudi à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vendredi à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'samedi à 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'dimanche dernier à 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hier à 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Aujourd’hui à 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aujourd’hui à 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Demain à 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mardi à 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Hier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mardi dernier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lundi dernier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimanche dernier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'samedi dernier à 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'vendredi dernier à 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'jeudi dernier à 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'mercredi dernier à 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'vendredi dernier à 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1er 1er 1er 1re 1re',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1re',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1re',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1re',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1re',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1re',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1re',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2e',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40e',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41e',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100e',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am CET',
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
        '0e',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'il y a 1 seconde',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'il y a 1 s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'il y a 2 secondes',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'il y a 2 s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'il y a 1 minute',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'il y a 1 min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'il y a 2 minutes',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'il y a 2 min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'il y a 1 heure',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'il y a 1 h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'il y a 2 heures',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'il y a 2 h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'il y a 1 jour',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'il y a 1 j',
        // Carbon::now()->subDays(2)->diffForHumans()
        'il y a 2 jours',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'il y a 2 j',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'il y a 1 semaine',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'il y a 1 sem.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'il y a 2 semaines',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'il y a 2 sem.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'il y a 1 mois',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'il y a 1 mois',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'il y a 2 mois',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'il y a 2 mois',
        // Carbon::now()->subYears(1)->diffForHumans()
        'il y a 1 an',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'il y a 1 an',
        // Carbon::now()->subYears(2)->diffForHumans()
        'il y a 2 ans',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'il y a 2 ans',
        // Carbon::now()->addSecond()->diffForHumans()
        'dans 1 seconde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'dans 1 s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 seconde après',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s après',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 seconde avant',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s avant',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 seconde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 secondes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'dans 1 s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute 1 seconde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ans 3 mois 1 j 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'dans 3 ans',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'il y a 5 mois',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'il y a 2 ans 3 mois 1 j 1 s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semaine 10 heures',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semaine 6 jours',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semaine 6 jours',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'dans 1 semaine et 6 jours',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semaines 1 heure',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'dans une heure',
        // CarbonInterval::days(2)->forHumans()
        '2 jours',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 j 3 h',
    ];
}
