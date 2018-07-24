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

class TrTest extends LocalizationTestCase
{
    const LOCALE = 'tr'; // Turkish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'geçen Cumartesi saat 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'gelecek Pazar saat 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'yarın saat 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'bugün saat 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'bugün saat 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'dün 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'geçen Salı saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gelecek Salı saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'gelecek Cuma saat 00:00',
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
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'bir hafta 10 saat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'bir hafta 6 gün',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'bir hafta 6 gün',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hafta bir saat',
    ];
}
