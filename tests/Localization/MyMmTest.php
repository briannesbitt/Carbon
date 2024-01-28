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
class MyMmTest extends LocalizationTestCase
{
    public const LOCALE = 'my_MM'; // Burmese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM',
        'မနက်ဖြန် ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM',
        'စနေ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM',
        'တနင်္ဂနွေ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM',
        'တနင်္လာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'အင်္ဂါ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'ဗုဒ္ဓဟူး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM',
        'ကြာသပတေး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM',
        'သောကြာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'အင်္ဂါ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM',
        'ဗုဒ္ဓဟူး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM',
        'ကြာသပတေး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM',
        'သောကြာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM',
        'စနေ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM',
        'ပြီးခဲ့သော တနင်္ဂနွေ ၀၈:၄၉ ညနေ မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM',
        'မနေ.က ၁၀:၀၀ ညနေ မှာ',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM',
        'ယနေ. ၁၀:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM',
        'ယနေ. ၀၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM',
        'မနက်ဖြန် ၀၁:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM',
        'အင်္ဂါ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'မနေ.က ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM',
        'မနေ.က ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM',
        'ပြီးခဲ့သော အင်္ဂါ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM',
        'ပြီးခဲ့သော တနင်္လာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM',
        'ပြီးခဲ့သော တနင်္ဂနွေ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM',
        'ပြီးခဲ့သော စနေ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'ပြီးခဲ့သော သောကြာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM',
        'ပြီးခဲ့သော ကြာသပတေး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM',
        'ပြီးခဲ့သော ဗုဒ္ဓဟူး ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM',
        'ပြီးခဲ့သော သောကြာ ၁၂:၀၀ နံနက် မှာ',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st',
        '1 1 1 1 1',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st',
        '2 1',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st',
        '3 1',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st',
        '4 1',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st',
        '5 1',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st',
        '6 1',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 2nd',
        '7 1',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd',
        '11 2',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th',
        '40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st',
        '41',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th',
        '100',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET',
        '12:00 နံနက် CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am',
        '12:00 နံနက်, 12:00 နံနက်',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am',
        '1:30 နံနက်, 1:30 နံနက်',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am',
        '2:00 နံနက်, 2:00 နံနက်',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am',
        '6:00 နံနက်, 6:00 နံနက်',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am',
        '10:00 နံနက်, 10:00 နံနက်',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm',
        '12:00 ညနေ, 12:00 ညနေ',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm',
        '5:00 ညနေ, 5:00 ညနေ',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm',
        '9:30 ညနေ, 9:30 ညနေ',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm',
        '11:00 ညနေ, 11:00 ညနေ',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th',
        '0',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago',
        'လွန်ခဲ့သော စက္ကန်.အနည်းငယ် က',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago',
        'လွန်ခဲ့သော 1 စက္ကန့် က',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago',
        'လွန်ခဲ့သော 2 စက္ကန့် က',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago',
        'လွန်ခဲ့သော 2 စက္ကန့် က',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago',
        'လွန်ခဲ့သော တစ်မိနစ် က',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago',
        'လွန်ခဲ့သော 1 မိနစ် က',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago',
        'လွန်ခဲ့သော 2 မိနစ် က',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago',
        'လွန်ခဲ့သော 2 မိနစ် က',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago',
        'လွန်ခဲ့သော တစ်နာရီ က',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago',
        'လွန်ခဲ့သော 1 နာရီ က',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago',
        'လွန်ခဲ့သော 2 နာရီ က',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago',
        'လွန်ခဲ့သော 2 နာရီ က',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago',
        'လွန်ခဲ့သော တစ်ရက် က',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago',
        'လွန်ခဲ့သော 1 ရက် က',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago',
        'လွန်ခဲ့သော 2 ရက် က',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago',
        'လွန်ခဲ့သော 2 ရက် က',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago',
        'လွန်ခဲ့သော 1 ပတ် က',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago',
        'လွန်ခဲ့သော 1 ပတ် က',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago',
        'လွန်ခဲ့သော 2 ပတ် က',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago',
        'လွန်ခဲ့သော 2 ပတ် က',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago',
        'လွန်ခဲ့သော တစ်လ က',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago',
        'လွန်ခဲ့သော 1 လ က',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago',
        'လွန်ခဲ့သော 2 လ က',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago',
        'လွန်ခဲ့သော 2 လ က',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago',
        'လွန်ခဲ့သော တစ်နှစ် က',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago',
        'လွန်ခဲ့သော 1 နှစ် က',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago',
        'လွန်ခဲ့သော 2 နှစ် က',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago',
        'လွန်ခဲ့သော 2 နှစ် က',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now',
        'လာမည့် စက္ကန်.အနည်းငယ် မှာ',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now',
        'လာမည့် 1 စက္ကန့် မှာ',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after',
        'စက္ကန်.အနည်းငယ် ကြာပြီးနောက်',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after',
        '1 စက္ကန့် ကြာပြီးနောက်',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before',
        'စက္ကန်.အနည်းငယ် မတိုင်ခင်',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before',
        '1 စက္ကန့် မတိုင်ခင်',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second',
        'စက္ကန်.အနည်းငယ်',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s',
        '1 စက္ကန့်',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds',
        '2 စက္ကန့်',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s',
        '2 စက္ကန့်',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now',
        'လာမည့် 1 စက္ကန့် မှာ',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second',
        'တစ်မိနစ် စက္ကန်.အနည်းငယ်',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s',
        '2 နှစ် 3 လ 1 ရက် 1 စက္ကန့်',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now',
        'လာမည့် 3 နှစ် မှာ',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago',
        'လွန်ခဲ့သော 5 လ က',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago',
        'လွန်ခဲ့သော 2 နှစ် 3 လ 1 ရက် 1 စက္ကန့် က',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours',
        '1 ပတ် 10 နာရီ',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 ပတ် 6 ရက်',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days',
        '1 ပတ် 6 ရက်',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now',
        'လာမည့် 1 ပတ် 6 ရက် မှာ',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour',
        '2 ပတ် တစ်နာရီ',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now',
        'လာမည့် တစ်နာရီ မှာ',

        // CarbonInterval::days(2)->forHumans()
        // '2 days',
        '2 ရက်',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h',
        '1 ရက် 3 နာရီ',
    ];
}
