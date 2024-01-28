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
class GlEsTest extends LocalizationTestCase
{
    public const LOCALE = 'gl_ES'; // Galician

    public const CASES = [
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
        '0º',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'hai 1 segundo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'hai 1 seg.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'hai 2 segundos',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'hai 2 seg.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'hai 1 minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'hai 1 min.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'hai 2 minutos',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'hai 2 min.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'hai 1 hora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'hai 1 h.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'hai 2 horas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'hai 2 h.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'hai 1 día',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'hai 1 d.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'hai 2 días',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'hai 2 d.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'hai 1 semana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'hai 1 sem.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'hai 2 semanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'hai 2 sem.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'hai 1 mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'hai 1 mes.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'hai 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'hai 2 mes.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'hai 1 ano',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'hai 1 a.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'hai 2 anos',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'hai 2 a.',
        // Carbon::now()->addSecond()->diffForHumans()
        'en 1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'en 1 seg.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 segundo despois',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 seg. despois',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 segundo antes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 seg. antes',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 segundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 seg.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundos',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 seg.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'en 1 seg.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuto 1 segundo',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 a. 3 mes. 1 d. 1 seg.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'en 3 anos',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'hai 5 mes.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'hai 2 a. 3 mes. 1 d. 1 seg.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 semana 10 horas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 semana 6 días',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'en 1 semana e 6 días',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 semanas 1 hora',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'nunha hora',
        // CarbonInterval::days(2)->forHumans()
        '2 días',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 h.',
    ];
}
