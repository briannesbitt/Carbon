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
class KabDzTest extends LocalizationTestCase
{
    public const LOCALE = 'kab_DZ'; // Kabyle

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sed at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Acer at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Arim at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ahad at 12:00 FT',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Amhad at 12:00 FT',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Sem at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ahad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Amhad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sem at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sed at 12:00 FT',
        // Carbon::now()->subDays(2)->calendar()
        'Last Acer at 8:49 MD',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 MD',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 FT',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Aram at 12:00 FT',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Aram at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Arim at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Acer at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sed at 12:00 FT',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sem at 12:00 FT',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Amhad at 12:00 FT',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Ahad at 12:00 FT',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Sem at 12:00 FT',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 2nd',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ft CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 FT, 12:00 ft',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 FT, 1:30 ft',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 FT, 2:00 ft',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 FT, 6:00 ft',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 FT, 10:00 ft',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 MD, 12:00 md',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 MD, 5:00 md',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 MD, 9:30 md',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 MD, 11:00 md',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 tasdidt ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 tasdidt ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 tasdidt ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 tasdidt ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 n tedqiqin ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 n tedqiqin ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 n tedqiqin ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 n tedqiqin ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 n tsaɛtin ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 n tsaɛtin ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 n tsaɛtin ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 n tsaɛtin ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 n wussan ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 n wussan ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 n wussan ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 n wussan ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 n ledwaṛ ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 n ledwaṛ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 n ledwaṛ ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 n ledwaṛ ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 n wayyuren ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 n wayyuren ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 n wayyuren ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 n wayyuren ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 n yiseggasen ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 n yiseggasen ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 n yiseggasen ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 n yiseggasen ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 tasdidt from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 tasdidt from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 tasdidt after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 tasdidt after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 tasdidt before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 tasdidt before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 tasdidt',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 tasdidt',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 tasdidt',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 tasdidt',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 tasdidt from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 n tedqiqin 1 tasdidt',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 n yiseggasen 3 n wayyuren 1 n wussan 1 tasdidt',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 n yiseggasen from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 n wayyuren ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 n yiseggasen 3 n wayyuren 1 n wussan 1 tasdidt ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 n ledwaṛ 10 n tsaɛtin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 n ledwaṛ 6 n wussan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 n ledwaṛ 6 n wussan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 n ledwaṛ and 6 n wussan from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 n ledwaṛ 1 n tsaɛtin',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 n tsaɛtin from now',
        // CarbonInterval::days(2)->forHumans()
        '2 n wussan',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 n wussan 3 n tsaɛtin',
    ];
}
