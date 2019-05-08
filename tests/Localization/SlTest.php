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

class SlTest extends LocalizationTestCase
{
    const LOCALE = 'sl'; // Slovenian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'jutri ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sobota ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Nedelja ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ponedeljek ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Torek ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sreda ob 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Četrtek ob 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Petek ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Torek ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sreda ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Četrtek ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Petek ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sobota ob 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'preteklo nedeljo ob 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'včeraj ob 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'danes ob 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'danes ob 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'jutri ob 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Torek ob 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'včeraj ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'včeraj ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pretekli torek ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pretekli ponedeljek ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'preteklo nedeljo ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'preteklo soboto ob 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pretekli petek ob 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'pretekli četrtek ob 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'preteklo sredo ob 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'pretekli petek ob 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 dopoldan cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 dopoldan, 12:00 dopoldan',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 dopoldan, 1:30 dopoldan',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 dopoldan, 2:00 dopoldan',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 dopoldan, 6:00 dopoldan',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 dopoldan, 10:00 dopoldan',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 popoldan, 12:00 popoldan',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 popoldan, 5:00 popoldan',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 popoldan, 9:30 popoldan',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 popoldan, 11:00 popoldan',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'pred 1 sekundo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'pred 1 sekundo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'pred 2 sekundama',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'pred 2 sekundi',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'pred 1 minuto',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'pred 1 minuto',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'pred 2 minutama',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'pred 2 minuti',
        // Carbon::now()->subHours(1)->diffForHumans()
        'pred 1 uro',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'pred 1 uro',
        // Carbon::now()->subHours(2)->diffForHumans()
        'pred 2 urama',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'pred 2 uri',
        // Carbon::now()->subDays(1)->diffForHumans()
        'pred 1 dnem',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'pred 1 dan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'pred 2 dnevoma',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'pred 2 dni',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'pred 1 tednom',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'pred 1 teden',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'pred 2 tednoma',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'pred 2 tedna',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'pred 1 mesecem',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'pred 1 mesec',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'pred 2 meseci',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'pred 2 meseca',
        // Carbon::now()->subYears(1)->diffForHumans()
        'pred 1 letom',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'pred 1 leto',
        // Carbon::now()->subYears(2)->diffForHumans()
        'pred 2 leti',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'pred 2 leti',
        // Carbon::now()->addSecond()->diffForHumans()
        'čez 1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'čez 1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'čez 1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'čez 1 sekundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'pred 1 sekundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'pred 1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekundo',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundi',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekundi',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'čez 1 sekundo',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuto 1 sekundo',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 leti 3 mesece 1 dan 1 sekundo',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'čez 3 leta',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'pred 5 mesecev',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'pred 2 leti 3 mesece 1 dan 1 sekundo',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 teden 10 ur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 teden 6 dni',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 teden 6 dni',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'čez 1 teden in 6 dni',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 tedna 1 uro',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'čez 1 uro',
        // CarbonInterval::days(2)->forHumans()
        '2 dni',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dan 3 ure',
    ];
}
