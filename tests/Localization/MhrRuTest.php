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

class MhrRuTest extends LocalizationTestCase
{
    const LOCALE = 'mhr_RU'; // Eastern Mari

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Шуматкече at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Рушарня at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Шочмо at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Кушкыжмо at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Вӱргече at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Изарня at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Кугарня at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Кушкыжмо at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Вӱргече at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Изарня at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Кугарня at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Шуматкече at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last Рушарня at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Кушкыжмо at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Кушкыжмо at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Шочмо at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Рушарня at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Шуматкече at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Кугарня at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Изарня at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Вӱргече at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Кугарня at 12:00 AM',
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
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
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
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 кокымшан ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 кокымшан ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 кокымшан ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 кокымшан ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 минут ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 минут ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 минут ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 минут ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 час ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 час ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 час ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 час ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 кече ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 кече ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 кече ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 кече ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 арня ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 арня ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 арня ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 арня ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 Тылзе ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 Тылзе ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 Тылзе ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 Тылзе ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 идалык ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 идалык ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 идалык ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 идалык ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 кокымшан from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 кокымшан from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 кокымшан after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 кокымшан after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 кокымшан before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 кокымшан before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 кокымшан',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 кокымшан',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 кокымшан',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 кокымшан',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 кокымшан from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минут 1 кокымшан',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 идалык 3 Тылзе 1 кече 1 кокымшан',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 идалык from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 Тылзе ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 идалык 3 Тылзе 1 кече 1 кокымшан ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 арня 10 час',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 арня 6 кече',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 арня 6 кече',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 арня and 6 кече from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 арня 1 час',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 час from now',
        // CarbonInterval::days(2)->forHumans()
        '2 кече',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 кече 3 час',
    ];
}
