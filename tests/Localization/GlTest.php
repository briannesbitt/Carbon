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

class GlTest extends LocalizationTestCase
{
    const LOCALE = 'gl'; // Galician

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o sábado pasado ás 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'domingo ás 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mañá ás 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'hoxe ás 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hoxe ás 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'onte á 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'o martes pasado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martes ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'venres ás 0:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'hai uns segundos',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'hai s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'hai 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'hai s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'hai un minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'hai min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'hai 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'hai min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'hai unha hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'hai h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'hai 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'hai h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'hai un día',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'hai d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'hai 2 días',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'hai d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'hai 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'hai w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'hai 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'hai w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'hai un mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'hai m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'hai 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'hai m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'hai un ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'hai y',
        // Carbon::now()->subYears(2)->diffForHumans()
        'hai 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'hai y',
        // Carbon::now()->addSecond()->diffForHumans()
        'nuns segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'en s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'uns segundos despois',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        's despois',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'uns segundos antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        's antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'uns segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'en s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'un minuto uns segundos',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas unha hora',
    ];
}
