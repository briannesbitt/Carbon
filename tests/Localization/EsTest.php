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

class EsTest extends LocalizationTestCase
{
    const LOCALE = 'es'; // Spanish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'el sábado pasado a las 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'domingo a las 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mañana a las 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'hoy a las 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hoy a las 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ayer a las 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'el martes pasado a las 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martes a las 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'viernes a las 0:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'hace unos segundos',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'hace 1 segundo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'hace 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'hace 2 segundos',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'hace un minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'hace 1 minuto',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'hace 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'hace 2 minutos',
        // Carbon::now()->subHours(1)->diffForHumans()
        'hace una hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'hace 1 hora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'hace 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'hace 2 horas',
        // Carbon::now()->subDays(1)->diffForHumans()
        'hace un día',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'hace 1 día',
        // Carbon::now()->subDays(2)->diffForHumans()
        'hace 2 días',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'hace 2 días',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'hace 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'hace 1 semana',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'hace 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'hace 2 semanas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'hace un mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'hace 1 mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'hace 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'hace 2 meses',
        // Carbon::now()->subYears(1)->diffForHumans()
        'hace un año',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'hace 1 año',
        // Carbon::now()->subYears(2)->diffForHumans()
        'hace 2 años',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'hace 2 años',
        // Carbon::now()->addSecond()->diffForHumans()
        'en unos segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'en 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'unos segundos después',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 segundo después',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'unos segundos antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 segundo antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'unos segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'en 1 segundo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'un minuto unos segundos',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 años 3 meses 1 día 1 segundo',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas una hora',
    ];
}
