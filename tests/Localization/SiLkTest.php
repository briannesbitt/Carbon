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
class SiLkTest extends LocalizationTestCase
{
    public const LOCALE = 'si_LK'; // Sinhala

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'හෙට පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'සෙනසුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ඉරිදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'සඳුදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'අඟහරුවාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'බදාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'බ්‍රහස්පතින්දා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'සිකුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'අඟහරුවාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'බදාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'බ්‍රහස්පතින්දා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'සිකුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'සෙනසුරාදා පෙ.ව. 12:00ට',
        // Carbon::now()->subDays(2)->calendar()
        'පසුගිය ඉරිදා ප.ව. 8:49ට',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ඊයේ ප.ව. 10:00ට',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'අද පෙ.ව. 10:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'අද පෙ.ව. 2:00ට',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'හෙට පෙ.ව. 1:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'අඟහරුවාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ඊයේ පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ඊයේ පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'පසුගිය අඟහරුවාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'පසුගිය සඳුදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'පසුගිය ඉරිදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'පසුගිය සෙනසුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'පසුගිය සිකුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'පසුගිය බ්‍රහස්පතින්දා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'පසුගිය බදාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'පසුගිය සිකුරාදා පෙ.ව. 12:00ට',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 වැනි 1 වැනි 1 වැනි 1 වැනි 1 වැනි',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 වැනි 1 වැනි',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 වැනි 1 වැනි',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 වැනි 1 වැනි',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 වැනි 1 වැනි',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 වැනි 1 වැනි',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 වැනි 1 වැනි',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 වැනි 2 වැනි',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40 වැනි',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41 වැනි',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100 වැනි',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 පෙ.ව. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 පෙර වරු, 12:00 පෙ.ව.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 පෙර වරු, 1:30 පෙ.ව.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 පෙර වරු, 2:00 පෙ.ව.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 පෙර වරු, 6:00 පෙ.ව.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 පෙර වරු, 10:00 පෙ.ව.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 පස් වරු, 12:00 ප.ව.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 පස් වරු, 5:00 ප.ව.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 පස් වරු, 9:30 ප.ව.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 පස් වරු, 11:00 ප.ව.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0 වැනි',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'තත්පර 1 කට පෙර',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'තත්පර 1 කට පෙර',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'තත්පර 2 කට පෙර',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'තත්පර 2 කට පෙර',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'මිනිත්තු 1 කට පෙර',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'මිනිත්තු 1 කට පෙර',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'මිනිත්තු 2 කට පෙර',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'මිනිත්තු 2 කට පෙර',
        // Carbon::now()->subHours(1)->diffForHumans()
        'පැය 1 කට පෙර',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'පැය 1 කට පෙර',
        // Carbon::now()->subHours(2)->diffForHumans()
        'පැය 2 කට පෙර',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'පැය 2 කට පෙර',
        // Carbon::now()->subDays(1)->diffForHumans()
        'දින 1 කට පෙර',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'දින 1 කට පෙර',
        // Carbon::now()->subDays(2)->diffForHumans()
        'දින 2 කට පෙර',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'දින 2 කට පෙර',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'සති 1 කට පෙර',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'සති 1 කට පෙර',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'සති 2 කට පෙර',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'සති 2 කට පෙර',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'මාස 1 කට පෙර',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'මාස 1 කට පෙර',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'මාස 2 කට පෙර',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'මාස 2 කට පෙර',
        // Carbon::now()->subYears(1)->diffForHumans()
        'වසර 1 කට පෙර',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'වසර 1 කට පෙර',
        // Carbon::now()->subYears(2)->diffForHumans()
        'වසර 2 කට පෙර',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'වසර 2 කට පෙර',
        // Carbon::now()->addSecond()->diffForHumans()
        'තත්පර 1 කින්',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'තත්පර 1 කින්',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'තත්පර 1 කින්',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'තත්පර 1 කින්',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'තත්පර 1 කට පෙර',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'තත්පර 1 කට පෙර',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'තත්පර 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'තත්පර 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'තත්පර 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'තත්පර 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'තත්පර 1 කින්',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'මිනිත්තු 1 තත්පර 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'වසර 2 මාස 3 දින 1 තත්පර 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'වසර 3 කින්',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'මාස 5 කට පෙර',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'වසර 2 මාස 3 දින 1 තත්පර 1 කට පෙර',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'සති 1 පැය 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'සති 1 දින 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'සති 1 දින 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'සති 1 දින 6 න්',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'සති 2 පැය 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'පැයක් කින්',
        // CarbonInterval::days(2)->forHumans()
        'දින 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'දින 1 පැය 3',
    ];
}
