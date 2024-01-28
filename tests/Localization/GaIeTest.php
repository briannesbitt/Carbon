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
class GaIeTest extends LocalizationTestCase
{
    public const LOCALE = 'ga_IE'; // Irish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Amárach ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Satharn ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Domhnaigh ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Luain ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Máirt ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Céadaoin ag 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Déardaoin ag 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Dé hAoine ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé Máirt ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé Céadaoin ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Déardaoin ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé hAoine ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé Satharn ag 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Dé Domhnaigh seo caite ag 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Inné aig 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Inniu ag 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Inniu ag 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Amárach ag 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé Máirt ag 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Inné aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Inné aig 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Máirt seo caite ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Luain seo caite ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Domhnaigh seo caite ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé Satharn seo caite ag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dé hAoine seo caite ag 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Déardaoin seo caite ag 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Dé Céadaoin seo caite ag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dé hAoine seo caite ag 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1d 1d 1d 1d 1d',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2na 1d',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3mh 1d',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4mh 1d',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5mh 1d',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6mh 1d',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7mh 1d',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11mh 2na',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40mh',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41mh',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100mh',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 r.n. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 r.n., 12:00 r.n.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 r.n., 1:30 r.n.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 r.n., 2:00 r.n.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 r.n., 6:00 r.n.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 r.n., 10:00 r.n.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 i.n., 12:00 i.n.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 i.n., 5:00 i.n.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 i.n., 9:30 i.n.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 i.n., 11:00 i.n.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0mh',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 soicind ó shin',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1so ó shin',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 soicind ó shin',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2so ó shin',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 nóiméad ó shin',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1n ó shin',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 nóiméad ó shin',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2n ó shin',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 uair an chloig ó shin',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1u ó shin',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 uair an chloig ó shin',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2u ó shin',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 lá ó shin',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1l ó shin',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 lá ó shin',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2l ó shin',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 sheachtain ó shin',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1sh ó shin',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 sheachtain ó shin',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2sh ó shin',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mí ó shin',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1m ó shin',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mí ó shin',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2m ó shin',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 bliain ó shin',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1b ó shin',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 bliain ó shin',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2b ó shin',
        // Carbon::now()->addSecond()->diffForHumans()
        'i 1 soicind',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'i 1so',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 soicind tar éis',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1so tar éis',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 soicind roimh',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1so roimh',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 soicind',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1so',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 soicind',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2so',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'i 1so',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 nóiméad 1 soicind',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2b 3m 1l 1so',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'i 3 bliain',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5m ó shin',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2b 3m 1l 1so ó shin',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sheachtain 10 uair an chloig',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sheachtain 6 lá',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sheachtain 6 lá',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'i 1 sheachtain agus 6 lá',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sheachtain 1 uair an chloig',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'i uair an chloig',
        // CarbonInterval::days(2)->forHumans()
        '2 lá',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1l 3u',
    ];
}
