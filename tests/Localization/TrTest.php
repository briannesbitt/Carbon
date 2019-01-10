<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

class TrTest extends LocalizationTestCase
{
    const LOCALE = 'tr'; // Turkish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'yarın saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Cumartesi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Pazar saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Pazartesi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Salı saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Çarşamba saat 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'gelecek Perşembe saat 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'gelecek Cuma saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Salı saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Çarşamba saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Perşembe saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Cuma saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Cumartesi saat 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'geçen Pazar saat 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dün 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'bugün saat 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'bugün saat 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'yarın saat 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Salı saat 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'dün 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dün 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Salı saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Pazartesi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Pazar saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Cumartesi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Cuma saat 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'geçen Perşembe saat 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'geçen Çarşamba saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'geçen Cuma saat 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1\'inci 1\'inci 1 1\'inci 1\'inci',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1\'inci',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1\'inci',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1\'inci',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1\'inci',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1\'inci',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1\'inci',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2\'nci',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41\'inci',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100\'üncü',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 öö cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ÖÖ, 12:00 öö',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ÖÖ, 1:30 öö',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ÖÖ, 2:00 öö',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ÖÖ, 6:00 öö',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ÖÖ, 10:00 öö',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ÖS, 12:00 ös',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ÖS, 5:00 ös',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ÖS, 9:30 ös',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ÖS, 11:00 ös',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0\'ıncı',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'birkaç saniye önce',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 saniye önce',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 saniye önce',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 saniye önce',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'bir dakika önce',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 dakika önce',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 dakika önce',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 dakika önce',
        // Carbon::now()->subHours(1)->diffForHumans()
        'bir saat önce',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 saat önce',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 saat önce',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 saat önce',
        // Carbon::now()->subDays(1)->diffForHumans()
        'bir gün önce',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 gün önce',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 gün önce',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 gün önce',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'bir hafta önce',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 hafta önce',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hafta önce',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 hafta önce',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'bir ay önce',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ay önce',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ay önce',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ay önce',
        // Carbon::now()->subYears(1)->diffForHumans()
        'bir yıl önce',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 yıl önce',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 yıl önce',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 yıl önce',
        // Carbon::now()->addSecond()->diffForHumans()
        'birkaç saniye sonra',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 saniye sonra',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'birkaç saniye sonra',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 saniye sonra',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'birkaç saniye önce',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 saniye önce',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'birkaç saniye',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 saniye',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 saniye',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 saniye',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 saniye sonra',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'bir dakika birkaç saniye',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 yıl 3 ay 1 gün 1 saniye',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 yıl sonra',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ay önce',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 yıl 3 ay 1 gün 1 saniye önce',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'bir hafta 10 saat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'bir hafta 6 gün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'bir hafta 6 gün',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hafta bir saat',
        // CarbonInterval::days(2)->forHumans()
        '2 gün',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 gün 3 saat',
    ];
}
