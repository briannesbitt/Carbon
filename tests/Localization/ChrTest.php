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
class ChrTest extends LocalizationTestCase
{
    public const LOCALE = 'chr'; // Cherokee

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ᎤᎾᏙᏓᏈᏕᎾ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ᎤᎾᏙᏓᏆᏍᎬ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ᎤᎾᏙᏓᏉᏅᎯ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ᏔᎵᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ᏦᎢᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ᏅᎩᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ᏧᎾᎩᎶᏍᏗ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᏔᎵᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᏦᎢᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᏅᎩᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᏧᎾᎩᎶᏍᏗ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᎤᎾᏙᏓᏈᏕᎾ at 12:00 ᏌᎾᎴ',
        // Carbon::now()->subDays(2)->calendar()
        'Last ᎤᎾᏙᏓᏆᏍᎬ at 8:49 ᏒᎯᏱᎢᏗᏢ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 ᏒᎯᏱᎢᏗᏢ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ᏔᎵᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ᏔᎵᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ᎤᎾᏙᏓᏉᏅᎯ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ᎤᎾᏙᏓᏆᏍᎬ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ᎤᎾᏙᏓᏈᏕᎾ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ᏧᎾᎩᎶᏍᏗ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ᏅᎩᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ᏦᎢᏁᎢᎦ at 12:00 ᏌᎾᎴ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ᏧᎾᎩᎶᏍᏗ at 12:00 ᏌᎾᎴ',
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
        '12:00 ꮜꮎꮄ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ᏌᎾᎴ, 12:00 ꮜꮎꮄ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ᏌᎾᎴ, 1:30 ꮜꮎꮄ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ᏌᎾᎴ, 2:00 ꮜꮎꮄ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ᏌᎾᎴ, 6:00 ꮜꮎꮄ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ᏌᎾᎴ, 10:00 ꮜꮎꮄ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ᏒᎯᏱᎢᏗᏢ, 12:00 ꮢꭿᏹꭲꮧꮲ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ᏒᎯᏱᎢᏗᏢ, 5:00 ꮢꭿᏹꭲꮧꮲ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ᏒᎯᏱᎢᏗᏢ, 9:30 ꮢꭿᏹꭲꮧꮲ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ᏒᎯᏱᎢᏗᏢ, 11:00 ꮢꭿᏹꭲꮧꮲ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ᏐᎢ ᏥᎨᏒ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ᏐᎢ ᏥᎨᏒ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ᏐᎢ ᏥᎨᏒ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ᏐᎢ ᏥᎨᏒ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ᎢᏯᏔᏬᏍᏔᏅ ᏥᎨᏒ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ᎢᏯᏔᏬᏍᏔᏅ ᏥᎨᏒ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ᎢᏯᏔᏬᏍᏔᏅ ᏥᎨᏒ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ᎢᏯᏔᏬᏍᏔᏅ ᏥᎨᏒ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ᏑᏟᎶᏛ ᏥᎨᏒ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ᏑᏟᎶᏛ ᏥᎨᏒ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ᏑᏟᎶᏛ ᏥᎨᏒ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ᏑᏟᎶᏛ ᏥᎨᏒ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ᎢᎦ ᏥᎨᏒ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ᎢᎦ ᏥᎨᏒ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ᎢᎦ ᏥᎨᏒ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ᎢᎦ ᏥᎨᏒ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ᏑᎾᏙᏓᏆᏍᏗ ᏥᎨᏒ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ᏑᎾᏙᏓᏆᏍᏗ ᏥᎨᏒ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ᏑᎾᏙᏓᏆᏍᏗ ᏥᎨᏒ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ᏑᎾᏙᏓᏆᏍᏗ ᏥᎨᏒ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ᏏᏅᏙ ᏥᎨᏒ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ᏏᏅᏙ ᏥᎨᏒ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ᏏᏅᏙ ᏥᎨᏒ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ᏏᏅᏙ ᏥᎨᏒ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ᏑᏕᏘᏴᏓ ᏥᎨᏒ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ᏑᏕᏘᏴᏓ ᏥᎨᏒ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ᏑᏕᏘᏴᏓ ᏥᎨᏒ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ᏑᏕᏘᏴᏓ ᏥᎨᏒ',
        // Carbon::now()->addSecond()->diffForHumans()
        'ᎾᎿ 1 ᏐᎢ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'ᎾᎿ 1 ᏐᎢ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ᏐᎢ after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ᏐᎢ after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ᏐᎢ before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ᏐᎢ before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ᏐᎢ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ᏐᎢ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ᏐᎢ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ᏐᎢ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'ᎾᎿ 1 ᏐᎢ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ᎢᏯᏔᏬᏍᏔᏅ 1 ᏐᎢ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ᏑᏕᏘᏴᏓ 3 ᏏᏅᏙ 1 ᎢᎦ 1 ᏐᎢ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'ᎾᎿ 3 ᏑᏕᏘᏴᏓ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ᏏᏅᏙ ᏥᎨᏒ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ᏑᏕᏘᏴᏓ 3 ᏏᏅᏙ 1 ᎢᎦ 1 ᏐᎢ ᏥᎨᏒ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ᏑᎾᏙᏓᏆᏍᏗ 10 ᏑᏟᎶᏛ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ᏑᎾᏙᏓᏆᏍᏗ 6 ᎢᎦ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ᏑᎾᏙᏓᏆᏍᏗ 6 ᎢᎦ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'ᎾᎿ 1 ᏑᎾᏙᏓᏆᏍᏗ and 6 ᎢᎦ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ᏑᎾᏙᏓᏆᏍᏗ 1 ᏑᏟᎶᏛ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ᎾᎿ 1 ᏑᏟᎶᏛ',
        // CarbonInterval::days(2)->forHumans()
        '2 ᎢᎦ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ᎢᎦ 3 ᏑᏟᎶᏛ',
    ];
}
