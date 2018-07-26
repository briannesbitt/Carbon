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

class MyTest extends LocalizationTestCase
{
    const LOCALE = 'my'; // Burmese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'မနက်ဖြန် 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'စနေ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'တနင်္ဂနွေ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'တနင်္လာ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'အင်္ဂါ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ဗုဒ္ဓဟူး 00:00 မှာ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ကြာသပတေး 00:00 မှာ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'သောကြာ 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'အင်္ဂါ 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ဗုဒ္ဓဟူး 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ကြာသပတေး 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'သောကြာ 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'စနေ 00:00 မှာ',
        // Carbon::now()->subDays(2)->calendar()
        'ပြီးခဲ့သော တနင်္ဂနွေ 20:49 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'မနေ.က 22:00 မှာ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ယနေ. 10:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ယနေ. 02:00 မှာ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'မနက်ဖြန် 01:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'အင်္ဂါ 00:00 မှာ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'မနေ.က 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'မနေ.က 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ပြီးခဲ့သော အင်္ဂါ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ပြီးခဲ့သော တနင်္လာ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ပြီးခဲ့သော တနင်္ဂနွေ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ပြီးခဲ့သော စနေ 00:00 မှာ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ပြီးခဲ့သော သောကြာ 00:00 မှာ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'ပြီးခဲ့သော ကြာသပတေး 00:00 မှာ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'ပြီးခဲ့သော ဗုဒ္ဓဟူး 00:00 မှာ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ပြီးခဲ့သော သောကြာ 00:00 မှာ',
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
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'လွန်ခဲ့သော စက္ကန်.အနည်းငယ် က',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 စက္ကန့် က',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'လွန်ခဲ့သော 2 စက္ကန့် က',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 စက္ကန့် က',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'လွန်ခဲ့သော တစ်မိနစ် က',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 မိနစ် က',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'လွန်ခဲ့သော 2 မိနစ် က',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 မိနစ် က',
        // Carbon::now()->subHours(1)->diffForHumans()
        'လွန်ခဲ့သော တစ်နာရီ က',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 နာရီ က',
        // Carbon::now()->subHours(2)->diffForHumans()
        'လွန်ခဲ့သော 2 နာရီ က',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 နာရီ က',
        // Carbon::now()->subDays(1)->diffForHumans()
        'လွန်ခဲ့သော တစ်ရက် က',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 ရက် က',
        // Carbon::now()->subDays(2)->diffForHumans()
        'လွန်ခဲ့သော 2 ရက် က',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 ရက် က',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'လွန်ခဲ့သော 1 ပတ် က',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 ပတ် က',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'လွန်ခဲ့သော 2 ပတ် က',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 ပတ် က',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'လွန်ခဲ့သော တစ်လ က',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 လ က',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'လွန်ခဲ့သော 2 လ က',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 လ က',
        // Carbon::now()->subYears(1)->diffForHumans()
        'လွန်ခဲ့သော တစ်နှစ် က',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 1 နှစ် က',
        // Carbon::now()->subYears(2)->diffForHumans()
        'လွန်ခဲ့သော 2 နှစ် က',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'လွန်ခဲ့သော 2 နှစ် က',
        // Carbon::now()->addSecond()->diffForHumans()
        'လာမည့် စက္ကန်.အနည်းငယ် မှာ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'လာမည့် 1 စက္ကန့် မှာ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'စက္ကန်.အနည်းငယ် ကြာပြီးနောက်',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 စက္ကန့် ကြာပြီးနောက်',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'စက္ကန်.အနည်းငယ် မတိုင်ခင်',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 စက္ကန့် မတိုင်ခင်',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'စက္ကန်.အနည်းငယ်',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 စက္ကန့်',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 စက္ကန့်',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 စက္ကန့်',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'လာမည့် 1 စက္ကန့် မှာ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'တစ်မိနစ် စက္ကန်.အနည်းငယ်',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 နှစ် 3 လ 1 ရက် 1 စက္ကန့်',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'လာမည့် 3 နှစ် မှာ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'လွန်ခဲ့သော 5 လ က',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'လွန်ခဲ့သော 2 နှစ် 3 လ 1 ရက် 1 စက္ကန့် က',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ပတ် 10 နာရီ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ပတ် 6 ရက်',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ပတ် 6 ရက်',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ပတ် တစ်နာရီ',
        // CarbonInterval::days(2)->forHumans()
        '2 ရက်',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ရက် 3 နာရီ',
    ];
}
