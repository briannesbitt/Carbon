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

class IsTest extends LocalizationTestCase
{
    const LOCALE = 'is'; // Icelandic

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Saturday at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Sunday at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Yesterday at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tuesday at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Friday at 12:00 AM',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekúnda síðan',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekúnda síðan',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekúndur síðan',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekúndur síðan',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 mínúta síðan',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 mínúta síðan',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 mínútur síðan',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 mínútur síðan',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 klukkutími síðan',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 klukkutími síðan',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 klukkutímar síðan',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 klukkutímar síðan',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dagur síðan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dagur síðan',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagar síðan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dagar síðan',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 vika síðan',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 vika síðan',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 vikur síðan',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 vikur síðan',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 mánuður síðan',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 mánuður síðan',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 mánuðir síðan',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 mánuðir síðan',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ár síðan',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ár síðan',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ár síðan',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ár síðan',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekúnda síðan',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 sekúnda síðan',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekúnda eftir',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekúnda eftir',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekúnda fyrir',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekúnda fyrir',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekúnda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekúnda',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekúndur',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekúndur',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 sekúnda síðan',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 mínúta 1 sekúnda',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ár 3 mánuðir 1 dagur 1 sekúnda',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vika 10 klukkutímar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vika 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vika 6 dagar',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 vikur 1 klukkutími',
    ];
}
