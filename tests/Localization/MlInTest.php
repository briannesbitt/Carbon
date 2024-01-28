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
class MlInTest extends LocalizationTestCase
{
    public const LOCALE = 'ml_IN'; // Malayalam

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'നാളെ രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ശനിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ഞായറാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'തിങ്കളാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ബുധനാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'വ്യാഴാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'വെള്ളിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ബുധനാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'വ്യാഴാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'വെള്ളിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ശനിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::now()->subDays(2)->calendar()
        'കഴിഞ്ഞ ഞായറാഴ്ച, രാത്രി 8:49 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ഇന്നലെ രാത്രി 10:00 -നു',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ഇന്ന് രാവിലെ 10:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ഇന്ന് രാത്രി 2:00 -നു',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'നാളെ രാത്രി 1:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'ഇന്നലെ രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ഇന്നലെ രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ തിങ്കളാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ ഞായറാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ ശനിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ വെള്ളിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'കഴിഞ്ഞ വ്യാഴാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'കഴിഞ്ഞ ബുധനാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'കഴിഞ്ഞ വെള്ളിയാഴ്ച, രാത്രി 12:00 -നു',
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
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 രാത്രി CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 രാത്രി, 12:00 രാത്രി',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 രാത്രി, 1:30 രാത്രി',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 രാത്രി, 2:00 രാത്രി',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 രാവിലെ, 6:00 രാവിലെ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 രാവിലെ, 10:00 രാവിലെ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ഉച്ച കഴിഞ്ഞ്, 12:00 ഉച്ച കഴിഞ്ഞ്',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 വൈകുന്നേരം, 5:00 വൈകുന്നേരം',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 രാത്രി, 9:30 രാത്രി',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 രാത്രി, 11:00 രാത്രി',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ദിവസം മുൻപ്',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ദിവസം മുൻപ്',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ദിവസം മുൻപ്',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ദിവസം മുൻപ്',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ആഴ്ച മുൻപ്',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ആഴ്ച മുൻപ്',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ആഴ്ച മുൻപ്',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ആഴ്ച മുൻപ്',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 മാസം മുൻപ്',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 മാസം മുൻപ്',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 മാസം മുൻപ്',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 മാസം മുൻപ്',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 വർഷം മുൻപ്',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 വർഷം മുൻപ്',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 വർഷം മുൻപ്',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 വർഷം മുൻപ്',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 സെക്കൻഡ് കഴിഞ്ഞ്',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 സെക്കൻഡ് കഴിഞ്ഞ്',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 സെക്കൻഡ്',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 സെക്കൻഡ്',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 സെക്കൻഡ്',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 സെക്കൻഡ്',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 സെക്കൻഡ് കഴിഞ്ഞ്',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 മിനിറ്റ് 1 സെക്കൻഡ്',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 വർഷം 3 മാസം 1 ദിവസം 1 സെക്കൻഡ്',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 വർഷം കഴിഞ്ഞ്',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 മാസം മുൻപ്',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 വർഷം 3 മാസം 1 ദിവസം 1 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ആഴ്ച 10 മണിക്കൂർ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ആഴ്ച 6 ദിവസം',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ആഴ്ച 6 ദിവസം',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ആഴ്ച, 6 ദിവസം കഴിഞ്ഞ്',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ആഴ്ച 1 മണിക്കൂർ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ഒരു മണിക്കൂർ കഴിഞ്ഞ്',
        // CarbonInterval::days(2)->forHumans()
        '2 ദിവസം',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ദിവസം 3 മണിക്കൂർ',
    ];
}
