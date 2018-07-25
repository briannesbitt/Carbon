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

class PtTest extends LocalizationTestCase
{
    const LOCALE = 'pt'; // Portuguese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Último Sábado às 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Domingo às 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Amanhã às 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hoje às 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hoje às 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ontem às 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Última Terça-feira às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Terça-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sexta-feira às 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        ':1º :1º',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2º :1º',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3º :1º',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4º :1º',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5º :1º',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6º :1º',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7º :2º',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11º :2º',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40º',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41º',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'há segundos',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'há 1 segundo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'há 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'há 2 segundos',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'há um minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'há 1 minuto',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'há 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'há 2 minutos',
        // Carbon::now()->subHours(1)->diffForHumans()
        'há uma hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'há 1 hora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'há 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'há 2 horas',
        // Carbon::now()->subDays(1)->diffForHumans()
        'há um dia',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'há 1 dia',
        // Carbon::now()->subDays(2)->diffForHumans()
        'há 2 dias',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'há 2 dias',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'há 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'há 1 semana',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'há 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'há 2 semanas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'há um mês',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'há 1 mês',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'há 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'há 2 meses',
        // Carbon::now()->subYears(1)->diffForHumans()
        'há um ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'há 1 ano',
        // Carbon::now()->subYears(2)->diffForHumans()
        'há 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'há 2 anos',
        // Carbon::now()->addSecond()->diffForHumans()
        'em segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'em 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'segundos depois',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 segundo depois',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'segundos antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 segundo antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'em 1 segundo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'um minuto segundos',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 anos 3 meses 1 dia 1 segundo',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 dias',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 dias',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas uma hora',
    ];
}
