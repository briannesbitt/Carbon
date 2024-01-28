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
class TetTest extends LocalizationTestCase
{
    public const LOCALE = 'tet'; // Tetum

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aban iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabadu iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Domingu iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Segunda iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tersa iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kuarta iha 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kinta iha 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Sesta iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tersa iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kuarta iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kinta iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sesta iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabadu iha 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Domingu semana kotuk iha 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Horiseik iha 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Ohin iha 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ohin iha 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Aban iha 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tersa iha 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Horiseik iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Horiseik iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tersa semana kotuk iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Segunda semana kotuk iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Domingu semana kotuk iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabadu semana kotuk iha 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sesta semana kotuk iha 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Kinta semana kotuk iha 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Kuarta semana kotuk iha 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sesta semana kotuk iha 00:00',
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
        'segundu 1 liuba',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'segundu 1 liuba',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'segundu 2 liuba',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'segundu 2 liuba',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'minutu 1 liuba',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'minutu 1 liuba',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'minutu 2 liuba',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'minutu 2 liuba',
        // Carbon::now()->subHours(1)->diffForHumans()
        'oras 1 liuba',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'oras 1 liuba',
        // Carbon::now()->subHours(2)->diffForHumans()
        'oras 2 liuba',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'oras 2 liuba',
        // Carbon::now()->subDays(1)->diffForHumans()
        'loron 1 liuba',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'loron 1 liuba',
        // Carbon::now()->subDays(2)->diffForHumans()
        'loron 2 liuba',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'loron 2 liuba',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'semana 1 liuba',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'semana 1 liuba',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'semana 2 liuba',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'semana 2 liuba',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'fulan 1 liuba',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'fulan 1 liuba',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'fulan 2 liuba',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'fulan 2 liuba',
        // Carbon::now()->subYears(1)->diffForHumans()
        'tinan 1 liuba',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'tinan 1 liuba',
        // Carbon::now()->subYears(2)->diffForHumans()
        'tinan 2 liuba',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'tinan 2 liuba',
        // Carbon::now()->addSecond()->diffForHumans()
        'iha segundu 1',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'iha segundu 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'segundu 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'segundu 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'segundu 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'segundu 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'iha segundu 1',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minutu 1 segundu 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'tinan 2 fulan 3 loron 1 segundu 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'iha tinan 3',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'fulan 5 liuba',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'tinan 2 fulan 3 loron 1 segundu 1 liuba',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'semana 1 oras 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'semana 1 loron 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'semana 1 loron 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'iha semana 1 loron 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'semana 2 oras 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'iha oras ida',
        // CarbonInterval::days(2)->forHumans()
        'loron 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'loron 1 oras 3',
    ];
}
