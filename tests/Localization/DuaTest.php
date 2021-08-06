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

/**
 * @group localization
 */
class DuaTest extends LocalizationTestCase
{
    public const LOCALE = 'dua'; // Duala

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'esaɓasú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'éti at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mɔ́sú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kwasú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'mukɔ́sú at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ŋgisú at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ɗónɛsú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kwasú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'mukɔ́sú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ŋgisú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ɗónɛsú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'esaɓasú at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last éti at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kwasú at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last kwasú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last mɔ́sú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last éti at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last esaɓasú at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ɗónɛsú at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ŋgisú at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last mukɔ́sú at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ɗónɛsú at 00:00',
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
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 idiɓa CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 idiɓa, 12:00 idiɓa',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 idiɓa, 1:30 idiɓa',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 idiɓa, 2:00 idiɓa',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 idiɓa, 6:00 idiɓa',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 idiɓa, 10:00 idiɓa',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ebyámu, 12:00 ebyámu',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ebyámu, 5:00 ebyámu',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ebyámu, 9:30 ebyámu',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ebyámu, 11:00 ebyámu',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 maba ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 maba ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 maba ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 maba ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuti ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minuti ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuti ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minuti ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ma awa ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ma awa ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ma awa ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ma awa ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 buńa ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 buńa ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 buńa ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 buńa ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 woki ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 woki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 woki ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 woki ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 myo̱di ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 myo̱di ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 myo̱di ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 myo̱di ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ma mbu ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ma mbu ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ma mbu ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ma mbu ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 maba from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 maba from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 maba after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 maba after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 maba before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 maba before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 maba',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 maba',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 maba',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 maba',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 maba from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuti 1 maba',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ma mbu 3 myo̱di 1 buńa 1 maba',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ma mbu from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 myo̱di ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ma mbu 3 myo̱di 1 buńa 1 maba ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 woki 10 ma awa',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 woki 6 buńa',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 woki 6 buńa',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 woki and 6 buńa from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 woki 1 ma awa',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ma awa from now',
        // CarbonInterval::days(2)->forHumans()
        '2 buńa',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 buńa 3 ma awa',
    ];
}
