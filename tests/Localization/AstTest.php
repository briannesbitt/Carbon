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
class AstTest extends LocalizationTestCase
{
    public const LOCALE = 'ast'; // Asturian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM'
        'mañana a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM'
        'sábadu a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM'
        'domingu a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM'
        'llunes a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'martes a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'miércoles a las 0:00',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM'
        'xueves a las 0:00',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM'
        'vienres a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'martes a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'miércoles a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM'
        'xueves a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM'
        'vienres a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM'
        'sábadu a las 0:00',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM'
        'el domingu pasado a las 20:49',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM'
        'ayer a las 22:00',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM'
        'hoy a las 10:00',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM'
        'hoy a las 2:00',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM'
        'mañana a las 1:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'martes a las 0:00',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'ayer a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'ayer a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM'
        'el martes pasado a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM'
        'el llunes pasado a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM'
        'el domingu pasado a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM'
        'el sábadu pasado a las 0:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'el vienres pasado a las 0:00',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM'
        'el xueves pasado a las 0:00',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM'
        'el miércoles pasado a las 0:00',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'el vienres pasado a las 0:00',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st'
        '1º 1º 1º 1º 1º',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st'
        '2º 1º',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st'
        '3º 1º',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st'
        '4º 1º',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st'
        '5º 1º',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st'
        '6º 1º',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 2nd'
        '7º 1º',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd'
        '11º 2º',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th'
        '40º',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st'
        '41º',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th'
        '100º',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET'
        '12:00 a. m. CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am'
        '12:00 a. m., 12:00 a. m.',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am'
        '1:30 a. m., 1:30 a. m.',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am'
        '2:00 a. m., 2:00 a. m.',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am'
        '6:00 a. m., 6:00 a. m.',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am'
        '10:00 a. m., 10:00 a. m.',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm'
        '12:00 p. m., 12:00 p. m.',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm'
        '5:00 p. m., 5:00 p. m.',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm'
        '9:30 p. m., 9:30 p. m.',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm'
        '11:00 p. m., 11:00 p. m.',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th'
        '0º',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago'
        'hai 1 segundu',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago'
        'hai 1 segundu',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago'
        'hai 2 segundu',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago'
        'hai 2 segundu',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago'
        'hai 1 minutu',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago'
        'hai 1 minutu',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago'
        'hai 2 minutu',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago'
        'hai 2 minutu',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago'
        'hai 1 hora',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago'
        'hai 1 hora',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago'
        'hai 2 hora',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago'
        'hai 2 hora',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago'
        'hai 1 día',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago'
        'hai 1 día',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago'
        'hai 2 día',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago'
        'hai 2 día',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago'
        'hai 1 selmana',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago'
        'hai 1 selmana',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago'
        'hai 2 selmana',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago'
        'hai 2 selmana',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago'
        'hai 1 mes',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago'
        'hai 1 mes',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago'
        'hai 2 mes',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago'
        'hai 2 mes',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago'
        'hai 1 añu',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago'
        'hai 1 añu',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago'
        'hai 2 añu',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago'
        'hai 2 añu',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now'
        'en 1 segundu',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now'
        'en 1 segundu',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after'
        '1 segundu dempués',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after'
        '1 segundu dempués',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before'
        '1 segundu enantes',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before'
        '1 segundu enantes',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second'
        '1 segundu',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s'
        '1 segundu',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds'
        '2 segundu',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s'
        '2 segundu',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now'
        'en 1 segundu',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second'
        '1 minutu 1 segundu',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s'
        '2 añu 3 mes 1 día 1 segundu',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now'
        'en 3 añu',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago'
        'hai 5 mes',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago'
        'hai 2 añu 3 mes 1 día 1 segundu',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours'
        '1 selmana 10 hora',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 selmana 6 día',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 selmana 6 día',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now'
        'en 1 selmana y 6 día',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour'
        '2 selmana 1 hora',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now'
        'en una hora',

        // CarbonInterval::days(2)->forHumans()
        // '2 days'
        '2 día',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h'
        '1 día 3 hora',
    ];
}
