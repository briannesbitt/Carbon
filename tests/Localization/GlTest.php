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

class GlTest extends LocalizationTestCase
{
    const LOCALE = 'gl'; // Galician

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mañá ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sábado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'domingo ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'luns ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'martes ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mércores ás 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'xoves ás 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'venres ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martes ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mércores ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'xoves ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'venres ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sábado ás 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'o domingo pasado ás 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'onte á 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'hoxe ás 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hoxe ás 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'mañá ás 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'martes ás 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'onte á 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'onte á 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o martes pasado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o luns pasado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o domingo pasado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o sábado pasado ás 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'o venres pasado ás 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'o xoves pasado ás 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'o mércores pasado ás 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'o venres pasado ás 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1º 1º 1º 1º 1º',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2º 1º',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3º 1º',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4º 1º',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5º 1º',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6º 1º',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7º 1º',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11º 2º',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40º',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41º',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100º',
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
        '0º',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'hai uns segundos',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'hai uns segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'hai 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'hai 2 segundos',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'hai un minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'hai un minuto',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'hai 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'hai 2 minutos',
        // Carbon::now()->subHours(1)->diffForHumans()
        'hai unha hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'hai unha hora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'hai 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'hai 2 horas',
        // Carbon::now()->subDays(1)->diffForHumans()
        'hai un día',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'hai un día',
        // Carbon::now()->subDays(2)->diffForHumans()
        'hai 2 días',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'hai 2 días',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'hai 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'hai 1 semana',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'hai 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'hai 2 semanas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'hai un mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'hai un mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'hai 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'hai 2 meses',
        // Carbon::now()->subYears(1)->diffForHumans()
        'hai un ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'hai un ano',
        // Carbon::now()->subYears(2)->diffForHumans()
        'hai 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'hai 2 anos',
        // Carbon::now()->addSecond()->diffForHumans()
        'nuns segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'nuns segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'uns segundos despois',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'uns segundos despois',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'uns segundos antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'uns segundos antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'uns segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'uns segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'nuns segundos',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'un minuto uns segundos',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 anos 3 meses un día uns segundos',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'en 3 anos',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'hai 5 meses',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'hai 2 anos 3 meses un día uns segundos',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas unha hora',
        // CarbonInterval::days(2)->forHumans()
        '2 días',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'un día 3 horas',
    ];
}
