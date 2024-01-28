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
class FiFiTest extends LocalizationTestCase
{
    public const LOCALE = 'fi_FI'; // Finnish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'lauantai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sunnuntai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'maanantai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tiistai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'keskiviikko at 00.00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'torstai at 00.00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'perjantai at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tiistai at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'keskiviikko at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'torstai at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'perjantai at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'lauantai at 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Last sunnuntai at 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tiistai at 00.00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last tiistai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last maanantai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sunnuntai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last lauantai at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last perjantai at 00.00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last torstai at 00.00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last keskiviikko at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last perjantai at 00.00',
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
        '12:00 aamupäivä CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 aamupäivä, 12:00 aamupäivä',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 aamupäivä, 1:30 aamupäivä',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 aamupäivä, 2:00 aamupäivä',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 aamupäivä, 6:00 aamupäivä',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 aamupäivä, 10:00 aamupäivä',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 iltapäivä, 12:00 iltapäivä',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 iltapäivä, 5:00 iltapäivä',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 iltapäivä, 9:30 iltapäivä',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 iltapäivä, 11:00 iltapäivä',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekunti sitten',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 s sitten',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekuntia sitten',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 s sitten',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuutti sitten',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min sitten',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuuttia sitten',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min sitten',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 tunti sitten',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 t sitten',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 tuntia sitten',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 t sitten',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 päivä sitten',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 pv sitten',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 päivää sitten',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 pv sitten',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 viikko sitten',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 vk sitten',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 viikkoa sitten',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 vk sitten',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 kuukausi sitten',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 kk sitten',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 kuukautta sitten',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 kk sitten',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 vuosi sitten',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 v sitten',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 vuotta sitten',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 v sitten',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekunnin päästä',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 s päästä',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekunti sen jälkeen',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s sen jälkeen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekunti ennen',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s ennen',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekunti',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekuntia',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 s päästä',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuutti 1 sekunti',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 v 3 kk 1 pv 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 vuoden päästä',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 kk sitten',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 v 3 kk 1 pv 1 s sitten',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 viikko 10 tuntia',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 viikko 6 päivää',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 viikko 6 päivää',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 viikon ja 6 päivän päästä',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 viikkoa 1 tunti',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 tunnin päästä',
        // CarbonInterval::days(2)->forHumans()
        '2 päivää',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 pv 3 t',
    ];
}
