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
class KsTest extends LocalizationTestCase
{
    public const LOCALE = 'ks'; // Kashmiri

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بٹوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'آتهوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ژءندروار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بوءںوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بودهوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'برىسوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'جمع at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'بوءںوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'بودهوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'برىسوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمع at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'بٹوار at 12:00 دوپھربرونھ',
        // Carbon::now()->subDays(2)->calendar()
        'Last آتهوار at 8:49 دوپھرپتھ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 دوپھرپتھ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'بوءںوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last بوءںوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ژءندروار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last آتهوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last بٹوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last جمع at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last برىسوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last بودهوار at 12:00 دوپھربرونھ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last جمع at 12:00 دوپھربرونھ',
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
        '12:00 دوپھربرونھ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 دوپھربرونھ, 12:00 دوپھربرونھ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 دوپھربرونھ, 1:30 دوپھربرونھ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 دوپھربرونھ, 2:00 دوپھربرونھ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 دوپھربرونھ, 6:00 دوپھربرونھ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 دوپھربرونھ, 10:00 دوپھربرونھ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 دوپھرپتھ, 12:00 دوپھرپتھ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 دوپھرپتھ, 5:00 دوپھرپتھ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 دوپھرپتھ, 9:30 دوپھرپتھ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 دوپھرپتھ, 11:00 دوپھرپتھ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 दोʼयुम ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 दोʼयुम ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 दोʼयुम ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 दोʼयुम ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 فَن ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 فَن ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 فَن ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 فَن ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 سۄن ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 سۄن ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 سۄن ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 سۄن ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 day ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 days ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 آتھٕوار ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 آتھٕوار ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 آتھٕوار ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 آتھٕوار ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 रान् ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 रान् ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 रान् ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 रान् ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 آب ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 آب ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 آب ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 آب ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 दोʼयुम from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 दोʼयुम from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 दोʼयुम after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 दोʼयुम after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 दोʼयुम before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 दोʼयुम before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 दोʼयुम',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 दोʼयुम',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 दोʼयुम',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 दोʼयुम',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 दोʼयुम from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 فَن 1 दोʼयुम',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 آب 3 रान् 1d 1 दोʼयुम',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 آب from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 रान् ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 آب 3 रान् 1d 1 दोʼयुम ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 آتھٕوار 10 سۄن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 آتھٕوار 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 آتھٕوار 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 آتھٕوار and 6 days from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 آتھٕوار 1 سۄن',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 سۄن from now',
        // CarbonInterval::days(2)->forHumans()
        '2 days',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3 سۄن',
    ];
}
