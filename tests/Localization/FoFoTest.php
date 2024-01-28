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
class FoFoTest extends LocalizationTestCase
{
    public const LOCALE = 'fo_FO'; // Faroese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Í morgin kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'leygardagur kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sunnudagur kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mánadagur kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'týsdagur kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mikudagur kl. 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'hósdagur kl. 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'fríggjadagur kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'týsdagur kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mikudagur kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'hósdagur kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fríggjadagur kl. 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'leygardagur kl. 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'síðstu sunnudagur kl 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Í gjár kl. 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Í dag kl. 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Í dag kl. 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Í morgin kl. 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'týsdagur kl. 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Í gjár kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Í gjár kl. 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'síðstu týsdagur kl 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'síðstu mánadagur kl 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'síðstu sunnudagur kl 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'síðstu leygardagur kl 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'síðstu fríggjadagur kl 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'síðstu hósdagur kl 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'síðstu mikudagur kl 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'síðstu fríggjadagur kl 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1. 1. 1. 1. 1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2. 1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3. 1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4. 1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5. 1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6. 1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7. 1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11. 2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100.',
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
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'fá sekund síðani',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekund síðani',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekundir síðani',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekundir síðani',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ein minutt síðani',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutt síðani',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuttir síðani',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuttir síðani',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ein tími síðani',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 tími síðani',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 tímar síðani',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 tímar síðani',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ein dagur síðani',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dag síðani',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagar síðani',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dagar síðani',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 vika síðani',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 vika síðani',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 vikur síðani',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 vikur síðani',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ein mánaði síðani',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mánaður síðani',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mánaðir síðani',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mánaðir síðani',
        // Carbon::now()->subYears(1)->diffForHumans()
        'eitt ár síðani',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ár síðani',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ár síðani',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ár síðani',
        // Carbon::now()->addSecond()->diffForHumans()
        'um fá sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'um 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'fá sekund aftaná',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekund aftaná',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'fá sekund áðrenn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund áðrenn',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'fá sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundir',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekundir',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'um 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ein minutt fá sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ár 3 mánaðir 1 dag 1 sekund',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'um 3 ár',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 mánaðir síðani',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ár 3 mánaðir 1 dag 1 sekund síðani',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vika 10 tímar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vika 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vika 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'um 1 vika og 6 dagar',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 vikur ein tími',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'um ein tími',
        // CarbonInterval::days(2)->forHumans()
        '2 dagar',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dag 3 tímar',
    ];
}
