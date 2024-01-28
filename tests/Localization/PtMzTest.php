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
class PtMzTest extends LocalizationTestCase
{
    public const LOCALE = 'pt_MZ'; // Portuguese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Amanhã às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sábado às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'domingo às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'segunda-feira às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'terça-feira às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'quarta-feira às 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'quinta-feira às 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'sexta-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'terça-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'quarta-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'quinta-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sexta-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sábado às 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Último domingo às 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ontem às 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hoje às 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hoje às 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Amanhã às 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'terça-feira às 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Ontem às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ontem às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Última terça-feira às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Última segunda-feira às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Último domingo às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Último sábado às 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Última sexta-feira às 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Última quinta-feira às 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Última quarta-feira às 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Última sexta-feira às 00:00',
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
        '7º 2º',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11º 2º',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40º',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41º',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100º',
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
        '0º',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'há 1 segundo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'há 1s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'há 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'há 2s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'há 1 minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'há 1min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'há 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'há 2min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'há 1 hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'há 1h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'há 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'há 2h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'há 1 dia',
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
        'há 1 mês',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'há 1m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'há 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'há 2m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'há 1 ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'há 1a',
        // Carbon::now()->subYears(2)->diffForHumans()
        'há 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'há 2a',
        // Carbon::now()->addSecond()->diffForHumans()
        'em 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'em 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 segundo depois',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s depois',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 segundo antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'em 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuto 1 segundo',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2a 3m 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'em 3 anos',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'há 5m',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'há 2a 3m 1d 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 dias',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 dias',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'em 1 semana e 6 dias',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas 1 hora',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'em uma hora',
        // CarbonInterval::days(2)->forHumans()
        '2 dias',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3h',
    ];
}
