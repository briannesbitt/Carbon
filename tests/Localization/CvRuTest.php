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
class CvRuTest extends LocalizationTestCase
{
    public const LOCALE = 'cv_RU'; // Chuvash

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ыран 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ҫитес шӑматкун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ҫитес вырсарникун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ҫитес тунтикун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ҫитес ытларикун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ҫитес юнкун 00:00 сехетре',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Ҫитес кӗҫнерникун 00:00 сехетре',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Ҫитес эрнекун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес ытларикун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес юнкун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес кӗҫнерникун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес эрнекун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес шӑматкун 00:00 сехетре',
        // Carbon::now()->subDays(2)->calendar()
        'Иртнӗ вырсарникун 20:49 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ӗнер 22:00 сехетре',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Паян 10:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Паян 02:00 сехетре',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ыран 01:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ҫитес ытларикун 00:00 сехетре',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Ӗнер 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ӗнер 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Иртнӗ ытларикун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Иртнӗ тунтикун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Иртнӗ вырсарникун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Иртнӗ шӑматкун 00:00 сехетре',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Иртнӗ эрнекун 00:00 сехетре',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Иртнӗ кӗҫнерникун 00:00 сехетре',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Иртнӗ юнкун 00:00 сехетре',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Иртнӗ эрнекун 00:00 сехетре',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1-мӗш 1-мӗш 1-мӗш 1-мӗш 1-мӗш',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2-мӗш 1-мӗш',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3-мӗш 1-мӗш',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4-мӗш 1-мӗш',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5-мӗш 1-мӗш',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6-мӗш 1-мӗш',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7-мӗш 1-мӗш',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11-мӗш 2-мӗш',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40-мӗш',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41-мӗш',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100-мӗш',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0-мӗш',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ҫеккунт каялла',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ҫеккунт каялла',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ҫеккунт каялла',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ҫеккунт каялла',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 минут каялла',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 минут каялла',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минут каялла',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 минут каялла',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 сехет каялла',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 сехет каялла',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 сехет каялла',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 сехет каялла',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 кун каялла',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 кун каялла',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 кун каялла',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 кун каялла',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 эрне каялла',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 эрне каялла',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 эрне каялла',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 эрне каялла',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 уйӑх каялла',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 уйӑх каялла',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 уйӑх каялла',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 уйӑх каялла',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ҫул каялла',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ҫул каялла',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ҫул каялла',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ҫул каялла',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ҫеккунтран',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ҫеккунтран',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ҫеккунт',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ҫеккунт',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ҫеккунт',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ҫеккунт',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ҫеккунтран',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минут 1 ҫеккунт',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ҫул 3 уйӑх 1 кун 1 ҫеккунт',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ҫултан',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 уйӑх каялла',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ҫул 3 уйӑх 1 кун 1 ҫеккунт каялла',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 эрне 10 сехет',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 эрне 6 кун',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 эрне 6 кун',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 эрне тата 6 кунран',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 эрне 1 сехет',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'пӗр сехетрен',
        // CarbonInterval::days(2)->forHumans()
        '2 кун',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 кун 3 сехет',
    ];
}
