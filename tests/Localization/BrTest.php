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
class BrTest extends LocalizationTestCase
{
    public const LOCALE = 'br'; // Breton

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Warc\'hoazh da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sadorn da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sul da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lun da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Meurzh da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Merc\'her da 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Yaou da 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Gwener da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Meurzh da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Merc\'her da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Yaou da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Gwener da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sadorn da 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Sul paset da 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dec\'h da 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hiziv da 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hiziv da 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Warc\'hoazh da 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Meurzh da 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Dec\'h da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dec\'h da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Meurzh paset da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lun paset da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sul paset da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sadorn paset da 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Gwener paset da 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Yaou paset da 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Merc\'her paset da 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Gwener paset da 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1añ 1añ 1añ 1añ 1añ',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2vet 1añ',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3vet 1añ',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4vet 1añ',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5vet 1añ',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6vet 1añ',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7vet 1añ',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11vet 2vet',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40vet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41vet',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100vet',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 a.m. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 A.M., 12:00 a.m.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 A.M., 1:30 a.m.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 A.M., 2:00 a.m.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 A.M., 6:00 a.m.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 A.M., 10:00 a.m.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 G.M., 12:00 g.m.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 G.M., 5:00 g.m.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 G.M., 9:30 g.m.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 G.M., 11:00 g.m.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0vet',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 eilenn \'zo',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 s \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 eilenn \'zo',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 s \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 vunutenn \'zo',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 vunutenn \'zo',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min \'zo',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 eur \'zo',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 e \'zo',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 eur \'zo',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 e \'zo',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 devezh \'zo',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 d \'zo',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 zevezh \'zo',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 d \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 sizhun \'zo',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 sizhun \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 sizhun \'zo',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 sizhun \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 miz \'zo',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 miz \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 viz \'zo',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 viz \'zo',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 bloaz \'zo',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 bl. \'zo',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 vloaz \'zo',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 bl. \'zo',
        // Carbon::now()->addSecond()->diffForHumans()
        'a-benn 1 eilenn',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'a-benn 1 s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 eilenn',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 eilenn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'a-benn 1 s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 vunutenn 1 eilenn',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 bl. 3 miz 1 d 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'a-benn 3 bloaz',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 miz \'zo',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 bl. 3 miz 1 d 1 s \'zo',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sizhun 10 eur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sizhun 6 devezh',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'a-benn 1 sizhun hag 6 devezh',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sizhun 1 eur',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'a-benn un eur',
        // CarbonInterval::days(2)->forHumans()
        '2 zevezh',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d 3 e',
    ];
}
