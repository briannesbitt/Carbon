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

class TrCyTest extends LocalizationTestCase
{
    const LOCALE = 'tr_CY'; // Turkish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'yarın saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Cumartesi saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Pazar saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Pazartesi saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Salı saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Çarşamba saat 12:00 öö',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'gelecek Perşembe saat 12:00 öö',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'gelecek Cuma saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Salı saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Çarşamba saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Perşembe saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Cuma saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Cumartesi saat 12:00 öö',
        // Carbon::now()->subDays(2)->calendar()
        'geçen Pazar saat 8:49 ös',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dün 10:00 ös',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'bugün saat 10:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'bugün saat 2:00 öö',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'yarın saat 1:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Salı saat 12:00 öö',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'dün 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dün 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Salı saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Pazartesi saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Pazar saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Cumartesi saat 12:00 öö',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Cuma saat 12:00 öö',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'geçen Perşembe saat 12:00 öö',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'geçen Çarşamba saat 12:00 öö',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'geçen Cuma saat 12:00 öö',
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
        '1 saniye önce',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1sn önce',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 saniye önce',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2sn önce',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 dakika önce',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1dk önce',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 dakika önce',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2dk önce',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 saat önce',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1sa önce',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 saat önce',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2sa önce',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 gün önce',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1g önce',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 gün önce',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2g önce',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 hafta önce',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1h önce',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hafta önce',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2h önce',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ay önce',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1ay önce',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ay önce',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2ay önce',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 yıl önce',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1yıl önce',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 yıl önce',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2yıl önce',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 saniye sonra',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1sn sonra',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 saniye sonra',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1sn sonra',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 saniye önce',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1sn önce',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 saniye',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1sn',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 saniye',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2sn',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1sn sonra',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 dakika 1 saniye',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2yıl 3ay 1g 1sn',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 yıl sonra',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5ay önce',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2yıl 3ay 1g 1sn önce',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 hafta 10 saat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hafta 6 gün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hafta 6 gün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 hafta ve 6 gün sonra',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hafta 1 saat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'bir saat sonra',
        // CarbonInterval::days(2)->forHumans()
        '2 gün',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1g 3sa',
    ];
}
