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

namespace Tests\Carbon;

use Carbon\Carbon;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class IssetTest extends AbstractTestCase
{
    public function testIssetReturnFalseForUnknownProperty(): void
    {
        $this->assertFalse(isset($this->now->sdfsdfss));
    }

    public static function dataForTestIssetReturnTrueForProperties(): Generator
    {
        yield ['age'];
        yield ['century'];
        yield ['day'];
        yield ['dayName'];
        yield ['dayOfWeek'];
        yield ['dayOfWeekIso'];
        yield ['dayOfYear'];
        yield ['daysInMonth'];
        yield ['daysInYear'];
        yield ['decade'];
        yield ['dst'];
        yield ['englishDayOfWeek'];
        yield ['englishMonth'];
        yield ['firstWeekDay'];
        yield ['hour'];
        yield ['isoWeek'];
        yield ['isoWeekYear'];
        yield ['isoWeeksInYear'];
        yield ['lastWeekDay'];
        yield ['latinMeridiem'];
        yield ['latinUpperMeridiem'];
        yield ['local'];
        yield ['locale'];
        yield ['localeDayOfWeek'];
        yield ['localeMonth'];
        yield ['meridiem'];
        yield ['micro'];
        yield ['microsecond'];
        yield ['millennium'];
        yield ['milli'];
        yield ['millisecond'];
        yield ['milliseconds'];
        yield ['minDayName'];
        yield ['minute'];
        yield ['month'];
        yield ['monthName'];
        yield ['noZeroHour'];
        yield ['offset'];
        yield ['offsetHours'];
        yield ['offsetMinutes'];
        yield ['quarter'];
        yield ['second'];
        yield ['shortDayName'];
        yield ['shortEnglishDayOfWeek'];
        yield ['shortEnglishMonth'];
        yield ['shortLocaleDayOfWeek'];
        yield ['shortLocaleMonth'];
        yield ['shortMonthName'];
        yield ['timestamp'];
        yield ['timezone'];
        yield ['timezoneAbbreviatedName'];
        yield ['timezoneName'];
        yield ['tz'];
        yield ['tzAbbrName'];
        yield ['tzName'];
        yield ['upperMeridiem'];
        yield ['utc'];
        yield ['week'];
        yield ['weekNumberInMonth'];
        yield ['weekOfMonth'];
        yield ['weekOfYear'];
        yield ['weekYear'];
        yield ['weeksInYear'];
        yield ['year'];
        yield ['yearIso'];
    }

    #[DataProvider('dataForTestIssetReturnTrueForProperties')]
    public function testIssetReturnTrueForProperties(string $property): void
    {
        Carbon::useStrictMode(false);
        $this->assertTrue(isset($this->now->{$property}));
    }
}
