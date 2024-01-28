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
class ElTest extends LocalizationTestCase
{
    public const LOCALE = 'el'; // Greek (modern)

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Αύριο {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Σάββατο {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Κυριακή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Δευτέρα {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Τετάρτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Πέμπτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Παρασκευή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Τετάρτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Πέμπτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Παρασκευή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Σάββατο {} 12:00 ΠΜ',
        // Carbon::now()->subDays(2)->calendar()
        'την προηγούμενη Κυριακή {} 8:49 ΜΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Χθες {} 10:00 ΜΜ',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Σήμερα {} 10:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Σήμερα {} 2:00 ΠΜ',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Αύριο {} 1:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Χθες {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Χθες {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'την προηγούμενη Τρίτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'την προηγούμενη Δευτέρα {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'την προηγούμενη Κυριακή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'το προηγούμενο Σάββατο {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'την προηγούμενη Παρασκευή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'την προηγούμενη Πέμπτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'την προηγούμενη Τετάρτη {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'την προηγούμενη Παρασκευή {} 12:00 ΠΜ',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1η 1η 1η 1η 1η',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2η 1η',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3η 1η',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4η 1η',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5η 1η',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6η 1η',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7η 1η',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11η 2η',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40η',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41η',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100η',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 πμ CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ΠΜ, 12:00 πμ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ΠΜ, 1:30 πμ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ΠΜ, 2:00 πμ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ΠΜ, 6:00 πμ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ΠΜ, 10:00 πμ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ΜΜ, 12:00 μμ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ΜΜ, 5:00 μμ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ΜΜ, 9:30 μμ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ΜΜ, 11:00 μμ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0η',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'πριν 1 δευτερόλεπτο',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'πριν 1 δευ.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'πριν 2 δευτερόλεπτα',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'πριν 2 δευ.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'πριν 1 λεπτό',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'πριν 1 λεπ.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'πριν 2 λεπτά',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'πριν 2 λεπ.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'πριν 1 ώρα',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'πριν 1 ώρα',
        // Carbon::now()->subHours(2)->diffForHumans()
        'πριν 2 ώρες',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'πριν 2 ώρες',
        // Carbon::now()->subDays(1)->diffForHumans()
        'πριν 1 μέρα',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'πριν 1 μέρ.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'πριν 2 μέρες',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'πριν 2 μέρ.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'πριν 1 εβδομάδα',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'πριν 1 εβδ.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'πριν 2 εβδομάδες',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'πριν 2 εβδ.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'πριν 1 μήνας',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'πριν 1 μήν.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'πριν 2 μήνες',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'πριν 2 μήν.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'πριν 1 χρόνος',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'πριν 1 χρ.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'πριν 2 χρόνια',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'πριν 2 χρ.',
        // Carbon::now()->addSecond()->diffForHumans()
        'σε 1 δευτερόλεπτο',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'σε 1 δευ.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 δευτερόλεπτο μετά',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 δευ. μετά',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 δευτερόλεπτο πριν',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 δευ. πριν',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 δευτερόλεπτο',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 δευ.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 δευτερόλεπτα',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 δευ.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'σε 1 δευ.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 λεπτό 1 δευτερόλεπτο',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 χρ. 3 μήν. 1 μέρ. 1 δευ.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'σε 3 χρόνια',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'πριν 5 μήν.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'πριν 2 χρ. 3 μήν. 1 μέρ. 1 δευ.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 10 ώρες',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 6 μέρες',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 εβδομάδα 6 μέρες',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'σε 1 εβδομάδα και 6 μέρες',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 εβδομάδες 1 ώρα',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'σε μία ώρα',
        // CarbonInterval::days(2)->forHumans()
        '2 μέρες',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 μέρ. 3 ώρες',
    ];
}
