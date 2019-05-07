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

class InTest extends LocalizationTestCase
{
    const LOCALE = 'in'; // in

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sabtu at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Minggu at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Senin at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Selasa at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Rabu at 00.00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Kamis at 00.00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Jumat at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Rabu at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Kamis at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Jumat at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Sabtu at 00.00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Minggu at 20.49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22.00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10.00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02.00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01.00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Selasa at 00.00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Selasa at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Senin at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Minggu at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Sabtu at 00.00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumat at 00.00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Kamis at 00.00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Rabu at 00.00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Jumat at 00.00',
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
        '12:00 am cet',
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
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 detik yang lalu',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 detik yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 detik yang lalu',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 detik yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 menit yang lalu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 menit yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 menit yang lalu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 menit yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 jam yang lalu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 jam yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 jam yang lalu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 jam yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 hari yang lalu',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 hari yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 hari yang lalu',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 hari yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 minggu yang lalu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 minggu yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 minggu yang lalu',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 minggu yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 bulan yang lalu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 bulan yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 bulan yang lalu',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 bulan yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans()
        'tahun 1 yang lalu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'tahun 1 yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans()
        'tahun 2 yang lalu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'tahun 2 yang lalu',
        // Carbon::now()->addSecond()->diffForHumans()
        'dalam 1 detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'dalam 1 detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 detik after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 detik after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 detik before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 detik before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 detik',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 detik',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 detik',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'dalam 1 detik',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 menit 1 detik',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'tahun 2 3 bulan 1 hari 1 detik',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'dalam tahun 3',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 bulan yang lalu',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'tahun 2 3 bulan 1 hari 1 detik yang lalu',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 minggu 10 jam',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 minggu 6 hari',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'dalam 1 minggu and 6 hari',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 minggu 1 jam',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'dalam 1 jam',
        // CarbonInterval::days(2)->forHumans()
        '2 hari',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 hari 3 jam',
    ];
}
