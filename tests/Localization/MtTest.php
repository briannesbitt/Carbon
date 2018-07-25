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

class MtTest extends LocalizationTestCase
{
    const LOCALE = 'mt'; // Maltese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Is-Sibt li għadda fil-00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Il-Ħadd fil-20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Għada fil-22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Illum fil-10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Illum fil-02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Il-bieraħ fil-01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'It-Tlieta li għadda fil-00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'It-Tlieta fil-00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Il-Ġimgħa fil-00:00',
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
        'ftit sekondi ilu',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ilu',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekondi ilu',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ilu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'minuta ilu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ilu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuti ilu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ilu',
        // Carbon::now()->subHours(1)->diffForHumans()
        'siegħa ilu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ilu',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 siegħat ilu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ilu',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ġurnata ilu',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ilu',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ġranet ilu',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ilu',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'gimgħa ilu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ilu',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ġimgħat ilu',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ilu',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'xahar ilu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ilu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 xhur ilu',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ilu',
        // Carbon::now()->subYears(1)->diffForHumans()
        'sena ilu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ilu',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 sni ilu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ilu',
        // Carbon::now()->addSecond()->diffForHumans()
        'f’ ftit sekondi',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'f’ s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ftit sekondi',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekondi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'f’ s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minuta ftit sekondi',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'gimgħa 10 siegħat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'gimgħa 6 ġranet',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'gimgħa 6 ġranet',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ġimgħat siegħa',
    ];
}
