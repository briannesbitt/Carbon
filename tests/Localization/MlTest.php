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

class MlTest extends LocalizationTestCase
{
    const LOCALE = 'ml'; // Malayalam

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'കഴിഞ്ഞ ശനിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::now()->subDays(2)->calendar()
        'ഞായറാഴ്ച, രാത്രി 8:49 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'നാളെ രാത്രി 10:00 -നു',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ഇന്ന് രാവിലെ 10:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ഇന്ന് രാത്രി 2:00 -നു',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'ഇന്നലെ രാത്രി 1:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'കഴിഞ്ഞ ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ചൊവ്വാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'വെള്ളിയാഴ്ച, രാത്രി 12:00 -നു',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'അൽപ നിമിഷങ്ങൾ മുൻപ്',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's മുൻപ്',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 സെക്കൻഡ് മുൻപ്',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's മുൻപ്',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ഒരു മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min മുൻപ്',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 മിനിറ്റ് മുൻപ്',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min മുൻപ്',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ഒരു മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h മുൻപ്',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 മണിക്കൂർ മുൻപ്',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h മുൻപ്',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ഒരു ദിവസം മുൻപ്',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd മുൻപ്',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ദിവസം മുൻപ്',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd മുൻപ്',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ഒരാഴ്ച മുൻപ്',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w മുൻപ്',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ആഴ്ച മുൻപ്',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w മുൻപ്',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ഒരു മാസം മുൻപ്',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm മുൻപ്',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 മാസം മുൻപ്',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm മുൻപ്',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ഒരു വർഷം മുൻപ്',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y മുൻപ്',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 വർഷം മുൻപ്',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y മുൻപ്',
        // Carbon::now()->addSecond()->diffForHumans()
        'അൽപ നിമിഷങ്ങൾ കഴിഞ്ഞ്',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's കഴിഞ്ഞ്',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'അൽപ നിമിഷങ്ങൾ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 സെക്കൻഡ്',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's കഴിഞ്ഞ്',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ഒരു മിനിറ്റ് അൽപ നിമിഷങ്ങൾ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'ഒരാഴ്ച 10 മണിക്കൂർ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ഒരാഴ്ച 6 ദിവസം',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'ഒരാഴ്ച 6 ദിവസം',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ആഴ്ച ഒരു മണിക്കൂർ',
    ];
}
