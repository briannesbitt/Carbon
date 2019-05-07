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

class OrTest extends LocalizationTestCase
{
    const LOCALE = 'or'; // Oriya

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ଶନିବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ରବିବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ସୋମବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ମଙ୍ଗଳବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ବୁଧବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'ଗୁରୁବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ଶୁକ୍ରବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ମଙ୍ଗଳବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ବୁଧବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ଗୁରୁବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ଶୁକ୍ରବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ଶନିବାର at ୧୨:୦ AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last ରବିବାର at 08:୪୯ PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at ୧୦:୦ PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at ୧୦:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:୦ AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ମଙ୍ଗଳବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ମଙ୍ଗଳବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ସୋମବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ରବିବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ଶନିବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last ଶୁକ୍ରବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last ଗୁରୁବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last ବୁଧବାର at ୧୨:୦ AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last ଶୁକ୍ରବାର at ୧୨:୦ AM',
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
        '7 2',
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
        '1 ସେକଣ୍ଢ ପୂର୍ବେ',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ସେ. ପୂର୍ବେ',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ସେକଣ୍ଢ ପୂର୍ବେ',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ସେ. ପୂର୍ବେ',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 ମିନଟ ପୂର୍ବେ',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 ମି. ପୂର୍ବେ',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 ମିନଟ ପୂର୍ବେ',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 ମି. ପୂର୍ବେ',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ଘଣ୍ତ ପୂର୍ବେ',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ଘ. ପୂର୍ବେ',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ଘଣ୍ତ ପୂର୍ବେ',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ଘ. ପୂର୍ବେ',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ଦିନ ପୂର୍ବେ',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ଦିନ ପୂର୍ବେ',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ଦିନ ପୂର୍ବେ',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ଦିନ ପୂର୍ବେ',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ସପ୍ତାହ ପୂର୍ବେ',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ସପ୍ତା. ପୂର୍ବେ',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ସପ୍ତାହ ପୂର୍ବେ',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ସପ୍ତା. ପୂର୍ବେ',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 ମାସ ପୂର୍ବେ',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ମା. ପୂର୍ବେ',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ମାସ ପୂର୍ବେ',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ମା. ପୂର୍ବେ',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ବର୍ଷ ପୂର୍ବେ',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ବ. ପୂର୍ବେ',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ବର୍ଷ ପୂର୍ବେ',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ବ. ପୂର୍ବେ',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ସେକଣ୍ଢରେ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ସେ.ରେ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ସେକଣ୍ଢ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ସେ.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ସେକଣ୍ଢ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ସେ.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ସେ.ରେ',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 ମିନଟ 1 ସେକଣ୍ଢ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ବ. 3 ମା. 1 ଦିନ 1 ସେ.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ବର୍ଷରେ',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ମା. ପୂର୍ବେ',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ବ. 3 ମା. 1 ଦିନ 1 ସେ. ପୂର୍ବେ',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ସପ୍ତାହ 10 ଘଣ୍ତ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ସପ୍ତାହ 6 ଦିନ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ସପ୍ତାହ 6 ଦିନ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ସପ୍ତାହ 6 ଦିନରେ',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ସପ୍ତାହ 1 ଘଣ୍ତ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 ଘଣ୍ତରେ',
        // CarbonInterval::days(2)->forHumans()
        '2 ଦିନ',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ଦିନ 3 ଘ.',
    ];
}
