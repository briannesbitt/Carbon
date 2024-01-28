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
class TaLkTest extends LocalizationTestCase
{
    public const LOCALE = 'ta_LK'; // Tamil

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'நாளை 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'சனி, 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ஞாயிறு, 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'திங்கள், 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'செவ்வாய், 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'புதன், 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'வியாழன், 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'வெள்ளி, 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'செவ்வாய், 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'புதன், 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'வியாழன், 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'வெள்ளி, 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'சனி, 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'கடந்த வாரம் ஞாயிறு, 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'நேற்று 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'இன்று 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'இன்று 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'நாளை 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'செவ்வாய், 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'நேற்று 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'நேற்று 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் செவ்வாய், 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் திங்கள், 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் ஞாயிறு, 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் சனி, 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'கடந்த வாரம் வெள்ளி, 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'கடந்த வாரம் வியாழன், 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'கடந்த வாரம் புதன், 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'கடந்த வாரம் வெள்ளி, 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1வது 1வது 1வது 1வது 1வது',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2வது 1வது',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3வது 1வது',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4வது 1வது',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5வது 1வது',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6வது 1வது',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7வது 1வது',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11வது 2வது',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40வது',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41வது',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100வது',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 காலை CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 காலை, 12:00 காலை',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 காலை, 1:30 காலை',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 காலை, 2:00 காலை',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 காலை, 6:00 காலை',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 காலை, 10:00 காலை',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 மாலை, 12:00 மாலை',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 மாலை, 5:00 மாலை',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 மாலை, 9:30 மாலை',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 மாலை, 11:00 மாலை',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0வது',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 சில விநாடிகள் முன்',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 விநா. முன்',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 விநாடிகள் முன்',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 விநா. முன்',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 நிமிடம் முன்',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 நிமி. முன்',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 நிமிடங்கள் முன்',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 நிமி. முன்',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 மணி நேரம் முன்',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 மணி. முன்',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 மணி நேரம் முன்',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 மணி. முன்',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 நாள் முன்',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 நாள் முன்',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 நாட்கள் முன்',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 நாட். முன்',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 வாரம் முன்',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 வார. முன்',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 வாரங்கள் முன்',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 வார. முன்',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 மாதம் முன்',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 மாத. முன்',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 மாதங்கள் முன்',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 மாத. முன்',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 வருடம் முன்',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 வருட. முன்',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ஆண்டுகள் முன்',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ஆண். முன்',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 சில விநாடிகள் இல்',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 விநா. இல்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 சில விநாடிகள் பின்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 விநா. பின்',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 சில விநாடிகள் முன்',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 விநா. முன்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 சில விநாடிகள்',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 விநா.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 விநாடிகள்',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 விநா.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 விநா. இல்',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 நிமிடம் 1 சில விநாடிகள்',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ஆண். 3 மாத. 1 நாள் 1 விநா.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 ஆண்டுகள் இல்',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 மாத. முன்',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ஆண். 3 மாத. 1 நாள் 1 விநா. முன்',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 வாரம் 10 மணி நேரம்',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 வாரம் 6 நாட்கள்',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 வாரம் 6 நாட்கள்',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 வாரம் மற்றும் 6 நாட்கள் இல்',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 வாரங்கள் 1 மணி நேரம்',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ஒரு மணி நேரம் இல்',
        // CarbonInterval::days(2)->forHumans()
        '2 நாட்கள்',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 நாள் 3 மணி.',
    ];
}
