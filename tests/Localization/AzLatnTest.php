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
class AzLatnTest extends LocalizationTestCase
{
    public const LOCALE = 'az_Latn'; // Azerbaijani

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tomorrow at 12:00 AM'
        'sabah saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Saturday at 12:00 AM'
        'gələn həftə şənbə saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Sunday at 12:00 AM'
        'gələn həftə bazar saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Monday at 12:00 AM'
        'gələn həftə bazar ertəsi saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'gələn həftə çərşənbə axşamı saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'gələn həftə çərşənbə saat 00:00',

        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        // 'Thursday at 12:00 AM'
        'gələn həftə cümə axşamı saat 00:00',

        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        // 'Friday at 12:00 AM'
        'gələn həftə cümə saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'gələn həftə çərşənbə axşamı saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Wednesday at 12:00 AM'
        'gələn həftə çərşənbə saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Thursday at 12:00 AM'
        'gələn həftə cümə axşamı saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Friday at 12:00 AM'
        'gələn həftə cümə saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Saturday at 12:00 AM'
        'gələn həftə şənbə saat 00:00',

        // Carbon::now()->subDays(2)->calendar()
        // 'Last Sunday at 8:49 PM'
        'keçən həftə bazar saat 20:49',

        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 10:00 PM'
        'dünən 22:00',

        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        // 'Today at 10:00 AM'
        'bugün saat 10:00',

        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Today at 2:00 AM'
        'bugün saat 02:00',

        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        // 'Tomorrow at 1:00 AM'
        'sabah saat 01:00',

        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Tuesday at 12:00 AM'
        'gələn həftə çərşənbə axşamı saat 00:00',

        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'dünən 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Yesterday at 12:00 AM'
        'dünən 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Tuesday at 12:00 AM'
        'keçən həftə çərşənbə axşamı saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Monday at 12:00 AM'
        'keçən həftə bazar ertəsi saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Sunday at 12:00 AM'
        'keçən həftə bazar saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Saturday at 12:00 AM'
        'keçən həftə şənbə saat 00:00',

        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'keçən həftə cümə saat 00:00',

        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        // 'Last Thursday at 12:00 AM'
        'keçən həftə cümə axşamı saat 00:00',

        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        // 'Last Wednesday at 12:00 AM'
        'keçən həftə çərşənbə saat 00:00',

        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        // 'Last Friday at 12:00 AM'
        'keçən həftə cümə saat 00:00',

        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        // '1st 1st 1st 1st 1st'
        '1-inci 1-inci 1-inci 1-inci 1-inci',

        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        // '2nd 1st'
        '2-nci 1-inci',

        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        // '3rd 1st'
        '3-üncü 1-inci',

        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        // '4th 1st'
        '4-üncü 1-inci',

        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        // '5th 1st'
        '5-inci 1-inci',

        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        // '6th 1st'
        '6-ncı 1-inci',

        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        // '7th 1st'
        '7-nci 1-inci',

        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        // '11th 2nd'
        '11-inci 2-nci',

        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        // '40th'
        '40',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        // '41st'
        '41-inci',

        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        // '100th'
        '100-üncü',

        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        // '12:00 am CET'
        '12:00 a CET',

        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 AM, 12:00 am'
        '12:00 a, 12:00 a',

        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        // '1:30 AM, 1:30 am'
        '1:30 a, 1:30 a',

        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        // '2:00 AM, 2:00 am'
        '2:00 a, 2:00 a',

        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        // '6:00 AM, 6:00 am'
        '6:00 a, 6:00 a',

        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        // '10:00 AM, 10:00 am'
        '10:00 a, 10:00 a',

        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        // '12:00 PM, 12:00 pm'
        '12:00 p, 12:00 p',

        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        // '5:00 PM, 5:00 pm'
        '5:00 p, 5:00 p',

        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        // '9:30 PM, 9:30 pm'
        '9:30 p, 9:30 p',

        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        // '11:00 PM, 11:00 pm'
        '11:00 p, 11:00 p',

        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        // '0th'
        '0-ıncı',

        // Carbon::now()->subSeconds(1)->diffForHumans()
        // '1 second ago'
        '1 saniyə əvvəl',

        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        // '1s ago'
        '1 san. əvvəl',

        // Carbon::now()->subSeconds(2)->diffForHumans()
        // '2 seconds ago'
        '2 saniyə əvvəl',

        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        // '2s ago'
        '2 san. əvvəl',

        // Carbon::now()->subMinutes(1)->diffForHumans()
        // '1 minute ago'
        '1 dəqiqə əvvəl',

        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        // '1m ago'
        '1 d. əvvəl',

        // Carbon::now()->subMinutes(2)->diffForHumans()
        // '2 minutes ago'
        '2 dəqiqə əvvəl',

        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        // '2m ago'
        '2 d. əvvəl',

        // Carbon::now()->subHours(1)->diffForHumans()
        // '1 hour ago'
        '1 saat əvvəl',

        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        // '1h ago'
        '1 s. əvvəl',

        // Carbon::now()->subHours(2)->diffForHumans()
        // '2 hours ago'
        '2 saat əvvəl',

        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        // '2h ago'
        '2 s. əvvəl',

        // Carbon::now()->subDays(1)->diffForHumans()
        // '1 day ago'
        '1 gün əvvəl',

        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        // '1d ago'
        '1 g. əvvəl',

        // Carbon::now()->subDays(2)->diffForHumans()
        // '2 days ago'
        '2 gün əvvəl',

        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        // '2d ago'
        '2 g. əvvəl',

        // Carbon::now()->subWeeks(1)->diffForHumans()
        // '1 week ago'
        '1 həftə əvvəl',

        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        // '1w ago'
        '1 h. əvvəl',

        // Carbon::now()->subWeeks(2)->diffForHumans()
        // '2 weeks ago'
        '2 həftə əvvəl',

        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        // '2w ago'
        '2 h. əvvəl',

        // Carbon::now()->subMonths(1)->diffForHumans()
        // '1 month ago'
        '1 ay əvvəl',

        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        // '1mo ago'
        '1 ay əvvəl',

        // Carbon::now()->subMonths(2)->diffForHumans()
        // '2 months ago'
        '2 ay əvvəl',

        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        // '2mos ago'
        '2 ay əvvəl',

        // Carbon::now()->subYears(1)->diffForHumans()
        // '1 year ago'
        '1 il əvvəl',

        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        // '1yr ago'
        '1 il əvvəl',

        // Carbon::now()->subYears(2)->diffForHumans()
        // '2 years ago'
        '2 il əvvəl',

        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        // '2yrs ago'
        '2 il əvvəl',

        // Carbon::now()->addSecond()->diffForHumans()
        // '1 second from now'
        '1 saniyə sonra',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        // '1s from now'
        '1 san. sonra',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        // '1 second after'
        '1 saniyə sonra',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        // '1s after'
        '1 san. sonra',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        // '1 second before'
        '1 saniyə əvvəl',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        // '1s before'
        '1 san. əvvəl',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        // '1 second'
        '1 saniyə',

        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        // '1s'
        '1 san.',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        // '2 seconds'
        '2 saniyə',

        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        // '2s'
        '2 san.',

        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        // '1s from now'
        '1 san. sonra',

        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        // '1 minute 1 second'
        '1 dəqiqə 1 saniyə',

        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        // '2yrs 3mos 1d 1s'
        '2 il 3 ay 1 g. 1 san.',

        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        // '3 years from now'
        '3 il sonra',

        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        // '5mos ago'
        '5 ay əvvəl',

        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        // '2yrs 3mos 1d 1s ago'
        '2 il 3 ay 1 g. 1 san. əvvəl',

        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        // '1 week 10 hours'
        '1 həftə 10 saat',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 həftə 6 gün',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        // '1 week 6 days'
        '1 həftə 6 gün',

        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        // '1 week and 6 days from now'
        '1 həftə və 6 gün sonra',

        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        // '2 weeks 1 hour'
        '2 həftə 1 saat',

        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        // 'an hour from now'
        'bir saat sonra',

        // CarbonInterval::days(2)->forHumans()
        // '2 days'
        '2 gün',

        // CarbonInterval::create('P1DT3H')->forHumans(true)
        // '1d 3h'
        '1 g. 3 s.',
    ];
}
