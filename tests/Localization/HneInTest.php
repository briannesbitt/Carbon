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

/**
 * @group localization
 */
class HneInTest extends LocalizationTestCase
{
    public const LOCALE = 'hne_IN'; // Chhattisgarhi

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सनिवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'इतवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'सोमवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'मंगलवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'बुधवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'बिरसपत at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'सुकरवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बुधवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'बिरसपत at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'सुकरवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'सनिवार at 12:00 बिहिनियाँ',
        // Carbon::now()->subDays(2)->calendar()
        'Last इतवार at 8:49 मंझनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 मंझनियाँ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'मंगलवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last मंगलवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सोमवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last इतवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सनिवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last सुकरवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last बिरसपत at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last बुधवार at 12:00 बिहिनियाँ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last सुकरवार at 12:00 बिहिनियाँ',
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
        '12:00 बिहिनियाँ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 बिहिनियाँ, 12:00 बिहिनियाँ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 बिहिनियाँ, 1:30 बिहिनियाँ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 बिहिनियाँ, 2:00 बिहिनियाँ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 बिहिनियाँ, 6:00 बिहिनियाँ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 बिहिनियाँ, 10:00 बिहिनियाँ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 मंझनियाँ, 12:00 मंझनियाँ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 मंझनियाँ, 5:00 मंझनियाँ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 मंझनियाँ, 9:30 मंझनियाँ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 मंझनियाँ, 11:00 मंझनियाँ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 second ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 seconds ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minute ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutes ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 hour ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1h ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 hours ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2h ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 day ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 days ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 week ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1w ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 weeks ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2w ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 month ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mo ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 months ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mos ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 year ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1yr ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 years ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2yrs ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 second from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1s from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 second after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 second before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 second',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 seconds',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1s from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute 1 second',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2yrs 3mos 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 years from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5mos ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2yrs 3mos 1d 1s ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 week 10 hours',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 days',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 week and 6 days from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 weeks 1 hour',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'an hour from now',
        // CarbonInterval::days(2)->forHumans()
        '2 days',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3h',
    ];
}
