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

class PtBrTest extends LocalizationTestCase
{
    const LOCALE = 'pt_BR'; // Portuguese

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
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'há poucos segundos',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'há 1s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'há 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'há 2s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'há um minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'há 1min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'há 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'há 2min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'há uma hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'há 1h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'há 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'há 2h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'há um dia',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'há 1d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'há 2 dias',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'há 2d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'há 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'há 1sem',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'há 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'há 2sem',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'há um mês',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'há 1m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'há 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'há 2m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'há um ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'há 1a',
        // Carbon::now()->subYears(2)->diffForHumans()
        'há 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'há 2a',
        // Carbon::now()->addSecond()->diffForHumans()
        'em poucos segundos',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'em 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'após poucos segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'após 1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'poucos segundos atrás',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s atrás',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'poucos segundos',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'em 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'um minuto poucos segundos',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2a 3m 1d 1s',
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
