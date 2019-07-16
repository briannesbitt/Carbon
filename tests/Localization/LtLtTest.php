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

class LtLtTest extends LocalizationTestCase
{
    const LOCALE = 'lt_LT'; // Lithuanian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'šeštadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sekmadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pirmadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'antradienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'trečiadienis at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ketvirtadienis at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'penktadienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'antradienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'trečiadienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ketvirtadienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'penktadienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'šeštadienis at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last sekmadienis at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'antradienis at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last antradienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last pirmadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sekmadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last šeštadienis at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last penktadienis at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ketvirtadienis at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last trečiadienis at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last penktadienis at 00:00',
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
        '12:00 priešpiet cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 priešpiet, 12:00 priešpiet',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 priešpiet, 1:30 priešpiet',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 priešpiet, 2:00 priešpiet',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 priešpiet, 6:00 priešpiet',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 priešpiet, 10:00 priešpiet',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 popiet, 12:00 popiet',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 popiet, 5:00 popiet',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 popiet, 9:30 popiet',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 popiet, 11:00 popiet',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'prieš 1 sekundę',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'prieš 1 sek.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'prieš 2 sekundes',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'prieš 2 sek.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'prieš 1 minutę',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'prieš 1 min.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'prieš 2 minutes',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'prieš 2 min.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'prieš 1 valandą',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'prieš 1 val.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'prieš 2 valandas',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'prieš 2 val.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'prieš 1 dieną',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'prieš 1 d.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'prieš 2 dienas',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'prieš 2 d.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'prieš 1 savaitę',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'prieš 1 sav.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'prieš 2 savaites',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'prieš 2 sav.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'prieš 1 mėnesį',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'prieš 1 mėn.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'prieš 2 mėnesius',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'prieš 2 mėn.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'prieš 1 metus',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'prieš 1 m.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'prieš 2 metus',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'prieš 2 m.',
        // Carbon::now()->addSecond()->diffForHumans()
        'už 1 sekundės',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'už 1 sek.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'po 1 sekundę',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'po 1 sek.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekundę nuo dabar',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sek. nuo dabar',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekundę',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sek.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sek.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'už 1 sek.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutę 1 sekundę',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 m. 3 mėn. 1 d. 1 sek.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'už 3 metus',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'prieš 5 mėn.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'prieš 2 m. 3 mėn. 1 d. 1 sek.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 savaitę 10 valandų',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 savaitę 6 dienas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 savaitę 6 dienas',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'už 1 savaitę ir 6 dienas',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 savaites 1 valandą',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'už 1 valandos',
        // CarbonInterval::days(2)->forHumans()
        '2 dienas',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 val.',
    ];
}
