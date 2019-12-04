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

class UzUzTest extends LocalizationTestCase
{
    const LOCALE = 'uz_UZ'; // Uzbek

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ertaga 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Shanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yakshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dushanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Seshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Chorshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Payshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Juma kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Seshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Chorshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Payshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Juma kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Shanba kuni soat 00:00 da',
        // Carbon::now()->subDays(2)->calendar()
        'O\'tgan Yakshanba kuni soat 20:49 da',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kecha soat 22:00 da',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Bugun soat 10:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Bugun soat 02:00 da',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ertaga 01:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Seshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Kecha soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kecha soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'O\'tgan Seshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'O\'tgan Dushanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'O\'tgan Yakshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'O\'tgan Shanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'O\'tgan Juma kuni soat 00:00 da',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'O\'tgan Payshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'O\'tgan Chorshanba kuni soat 00:00 da',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'O\'tgan Juma kuni soat 00:00 da',
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
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 to CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 TO, 12:00 to',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 TO, 1:30 to',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 TO, 2:00 to',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 TO, 6:00 to',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 TO, 10:00 to',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 TK, 12:00 tk',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 TK, 5:00 tk',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 TK, 9:30 tk',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 TK, 11:00 tk',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'Bir necha 1 soniya oldin',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'Bir necha 1 son. oldin',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'Bir necha 2 soniya oldin',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'Bir necha 2 son. oldin',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'Bir necha 1 daqiqa oldin',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'Bir necha 1 d oldin',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'Bir necha 2 daqiqa oldin',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'Bir necha 2 d oldin',
        // Carbon::now()->subHours(1)->diffForHumans()
        'Bir necha 1 soat oldin',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'Bir necha 1 soat oldin',
        // Carbon::now()->subHours(2)->diffForHumans()
        'Bir necha 2 soat oldin',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'Bir necha 2 soat oldin',
        // Carbon::now()->subDays(1)->diffForHumans()
        'Bir necha 1 kun oldin',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'Bir necha 1 k oldin',
        // Carbon::now()->subDays(2)->diffForHumans()
        'Bir necha 2 kun oldin',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'Bir necha 2 k oldin',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'Bir necha 1 hafta oldin',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'Bir necha 1 h oldin',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'Bir necha 2 hafta oldin',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'Bir necha 2 h oldin',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'Bir necha 1 oy oldin',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'Bir necha 1 o oldin',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'Bir necha 2 oy oldin',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'Bir necha 2 o oldin',
        // Carbon::now()->subYears(1)->diffForHumans()
        'Bir necha 1 yil oldin',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'Bir necha 1 y oldin',
        // Carbon::now()->subYears(2)->diffForHumans()
        'Bir necha 2 yil oldin',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'Bir necha 2 y oldin',
        // Carbon::now()->addSecond()->diffForHumans()
        'Yaqin 1 soniya ichida',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'Yaqin 1 son. ichida',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 soniya пас аз он',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 son. пас аз он',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 soniya пеш аз он',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 son. пеш аз он',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 soniya',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 son.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 soniya',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 son.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'Yaqin 1 son. ichida',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 daqiqa 1 soniya',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 y 3 o 1 k 1 son.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'Yaqin 3 yil ichida',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'Bir necha 5 o oldin',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'Bir necha 2 y 3 o 1 k 1 son. oldin',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 hafta 10 soat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hafta 6 kun',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hafta 6 kun',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'Yaqin 1 hafta va 6 kun ichida',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hafta 1 soat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'Yaqin bir soat ichida',
        // CarbonInterval::days(2)->forHumans()
        '2 kun',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 k 3 soat',
    ];
}
