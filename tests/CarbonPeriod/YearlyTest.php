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

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Carbon\OverflowMode;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class YearlyTest extends AbstractTestCase
{
    public function testYearlyWithoutParameters()
    {
        Carbon::setTestNow(Carbon::parse('2020-02-29 09:52:46.321654'));
        $period = CarbonPeriod::yearly();

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2020-02-29 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2022-02-28 09:52:46.321654',
            '2023-02-28 09:52:46.321654',
            '2024-02-29 09:52:46.321654',
            '2025-02-28 09:52:46.321654',
            '2026-02-28 09:52:46.321654',
            '2027-02-28 09:52:46.321654',
            '2028-02-29 09:52:46.321654',
            '2029-02-28 09:52:46.321654',
            '2030-02-28 09:52:46.321654',
            '2031-02-28 09:52:46.321654',
            '2032-02-29 09:52:46.321654',
            '2033-02-28 09:52:46.321654',
            '2034-02-28 09:52:46.321654',
            '2035-02-28 09:52:46.321654',
            '2036-02-29 09:52:46.321654',
            '2037-02-28 09:52:46.321654',
            '2038-02-28 09:52:46.321654',
            '2039-02-28 09:52:46.321654',
            '2040-02-29 09:52:46.321654',
            '2041-02-28 09:52:46.321654',
            '2042-02-28 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testYearlyWithStartDate()
    {
        Carbon::setTestNow(Carbon::parse('2020-01-31 09:52:46.321654'));

        $period = CarbonPeriod::yearly(
            Carbon::parse('2019-12-27 09:52:46.321654'),
        );

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2019-12-27 09:52:46.321654',
            '2020-12-27 09:52:46.321654',
            '2021-12-27 09:52:46.321654',
            '2022-12-27 09:52:46.321654',
            '2023-12-27 09:52:46.321654',
            '2024-12-27 09:52:46.321654',
            '2025-12-27 09:52:46.321654',
            '2026-12-27 09:52:46.321654',
            '2027-12-27 09:52:46.321654',
            '2028-12-27 09:52:46.321654',
            '2029-12-27 09:52:46.321654',
            '2030-12-27 09:52:46.321654',
            '2031-12-27 09:52:46.321654',
            '2032-12-27 09:52:46.321654',
            '2033-12-27 09:52:46.321654',
            '2034-12-27 09:52:46.321654',
            '2035-12-27 09:52:46.321654',
            '2036-12-27 09:52:46.321654',
            '2037-12-27 09:52:46.321654',
            '2038-12-27 09:52:46.321654',
            '2039-12-27 09:52:46.321654',
            '2040-12-27 09:52:46.321654',
            '2041-12-27 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testYearlyWithStartDateAndRecurrences()
    {
        Carbon::setTestNow(Carbon::parse('2020-01-31 09:52:46.321654'));

        $period = CarbonPeriod::yearly(
            Carbon::parse('2019-12-27 09:52:46.321654'),
            recurrences: 3,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-12-27 09:52:46.321654',
            '2020-12-27 09:52:46.321654',
            '2021-12-27 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::yearly(
            Carbon::parse('2019-02-28 09:52:46.321654'),
            recurrences: 8,
            anchorDay: 29,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(8, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-02-28 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2022-02-28 09:52:46.321654',
            '2023-02-28 09:52:46.321654',
            '2024-02-29 09:52:46.321654',
            '2025-02-28 09:52:46.321654',
            '2026-02-28 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::yearly(
            Carbon::parse('2020-02-29 09:52:46.321654'),
            recurrences: 8,
            mode: OverflowMode::NoOverflow,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(8, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2020-02-29 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2022-02-28 09:52:46.321654',
            '2023-02-28 09:52:46.321654',
            '2024-02-28 09:52:46.321654',
            '2025-02-28 09:52:46.321654',
            '2026-02-28 09:52:46.321654',
            '2027-02-28 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::yearly(
            Carbon::parse('2019-12-31 09:52:46.321654'),
            recurrences: 4,
            mode: OverflowMode::Overflow,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(4, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-12-31 09:52:46.321654',
            '2020-01-31 09:52:46.321654',
            '2020-03-02 09:52:46.321654',
            '2020-04-02 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));
    }

    public function testYearlyWithTimestamps()
    {
        $period = CarbonPeriod::yearly(
            start: strtotime('2020-02-29 09:52:46.321654 UTC'),
            end: strtotime('2026-02-28 09:52:46.321654 UTC'),
        );

        $this->assertEquals(CarbonImmutable::parse('2026-02-28T09:52:46.000000 UTC'), $period->getEndDate());
        $this->assertTrue($period->isEndIncluded());
        $this->assertFalse($period->isEndExcluded());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2020-02-29 09:52:46.000000',
            '2021-02-28 09:52:46.000000',
            '2022-02-28 09:52:46.000000',
            '2023-02-28 09:52:46.000000',
            '2024-02-29 09:52:46.000000',
            '2025-02-28 09:52:46.000000',
            '2026-02-28 09:52:46.000000',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testYearlyWithStrings()
    {
        $period = CarbonPeriod::yearly(
            start: '2020-02-29 09:52:46.321654 UTC',
            end: '2026-02-28 09:52:46.321654 UTC',
        );

        $this->assertEquals(CarbonImmutable::parse('2026-02-28T09:52:46.321654 UTC'), $period->getEndDate());
        $this->assertTrue($period->isEndIncluded());
        $this->assertFalse($period->isEndExcluded());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2020-02-29 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2022-02-28 09:52:46.321654',
            '2023-02-28 09:52:46.321654',
            '2024-02-29 09:52:46.321654',
            '2025-02-28 09:52:46.321654',
            '2026-02-28 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testYearlyWithEndDateAndRecurrences()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'You must specify $end or $recurrences but not both',
        ));

        CarbonPeriod::yearly(
            end: Carbon::parse('2019-12-27 09:52:46.321654'),
            recurrences: 3,
        );
    }

    public function testModeIncompatibility()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            '$anchorDay parameter must not be set for $mode OverflowMode::NoOverflow',
        ));

        CarbonPeriod::yearly(
            end: Carbon::parse('2019-12-27 09:52:46.321654'),
            anchorDay: 3,
            mode: OverflowMode::NoOverflow,
        );
    }

    private function getDates(
        CarbonPeriod $period,
        int $limit = 24,
        ?string $expectedDateClass = null,
    ): array {
        $dates = [];

        foreach ($period as $date) {
            if (--$limit === 0) {
                break;
            }

            if ($expectedDateClass !== null) {
                $this->assertInstanceOf($expectedDateClass, $date);
            }

            $dates[] = $date->format('Y-m-d H:i:s.u');
        }

        return $dates;
    }
}
