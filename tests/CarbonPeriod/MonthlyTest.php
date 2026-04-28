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
use Carbon\Period\MonthlyMode;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class MonthlyTest extends AbstractTestCase
{
    public function testMonthlyWithoutParameters()
    {
        Carbon::setTestNow(Carbon::parse('2020-01-31 09:52:46.321654'));
        $period = CarbonPeriod::monthly();

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2020-01-31 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2020-03-31 09:52:46.321654',
            '2020-04-30 09:52:46.321654',
            '2020-05-31 09:52:46.321654',
            '2020-06-30 09:52:46.321654',
            '2020-07-31 09:52:46.321654',
            '2020-08-31 09:52:46.321654',
            '2020-09-30 09:52:46.321654',
            '2020-10-31 09:52:46.321654',
            '2020-11-30 09:52:46.321654',
            '2020-12-31 09:52:46.321654',
            '2021-01-31 09:52:46.321654',
            '2021-02-28 09:52:46.321654',
            '2021-03-31 09:52:46.321654',
            '2021-04-30 09:52:46.321654',
            '2021-05-31 09:52:46.321654',
            '2021-06-30 09:52:46.321654',
            '2021-07-31 09:52:46.321654',
            '2021-08-31 09:52:46.321654',
            '2021-09-30 09:52:46.321654',
            '2021-10-31 09:52:46.321654',
            '2021-11-30 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testMonthlyWithStartDate()
    {
        Carbon::setTestNow(Carbon::parse('2020-01-31 09:52:46.321654'));

        $period = CarbonPeriod::monthly(
            Carbon::parse('2019-12-27 09:52:46.321654'),
        );

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2019-12-27 09:52:46.321654',
            '2020-01-27 09:52:46.321654',
            '2020-02-27 09:52:46.321654',
            '2020-03-27 09:52:46.321654',
            '2020-04-27 09:52:46.321654',
            '2020-05-27 09:52:46.321654',
            '2020-06-27 09:52:46.321654',
            '2020-07-27 09:52:46.321654',
            '2020-08-27 09:52:46.321654',
            '2020-09-27 09:52:46.321654',
            '2020-10-27 09:52:46.321654',
            '2020-11-27 09:52:46.321654',
            '2020-12-27 09:52:46.321654',
            '2021-01-27 09:52:46.321654',
            '2021-02-27 09:52:46.321654',
            '2021-03-27 09:52:46.321654',
            '2021-04-27 09:52:46.321654',
            '2021-05-27 09:52:46.321654',
            '2021-06-27 09:52:46.321654',
            '2021-07-27 09:52:46.321654',
            '2021-08-27 09:52:46.321654',
            '2021-09-27 09:52:46.321654',
            '2021-10-27 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testMonthlyWithStartDateAndRecurrences()
    {
        Carbon::setTestNow(Carbon::parse('2020-01-31 09:52:46.321654'));

        $period = CarbonPeriod::monthly(
            Carbon::parse('2019-12-27 09:52:46.321654'),
            recurrences: 3,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-12-27 09:52:46.321654',
            '2020-01-27 09:52:46.321654',
            '2020-02-27 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::monthly(
            Carbon::parse('2019-12-27 09:52:46.321654'),
            recurrences: 4,
            anchorDay: 31,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(4, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-12-27 09:52:46.321654',
            '2020-01-31 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2020-03-31 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::monthly(
            Carbon::parse('2019-12-31 09:52:46.321654'),
            recurrences: 4,
            mode: MonthlyMode::NoOverflow,
            options: 0,
        );

        $this->assertNull($period->getEndDate());
        $this->assertSame(4, $period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
        $this->assertSame([
            '2019-12-31 09:52:46.321654',
            '2020-01-31 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
            '2020-03-29 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: Carbon::class));

        $period = CarbonPeriod::monthly(
            Carbon::parse('2019-12-31 09:52:46.321654'),
            recurrences: 4,
            mode: MonthlyMode::Overflow,
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

    public function testMonthlyWithTimestamps()
    {
        $period = CarbonPeriod::monthly(
            start: strtotime('2019-10-31 09:52:46.321654 UTC'),
            end: strtotime('2020-02-29 09:52:46.321654 UTC'),
        );

        $this->assertEquals(CarbonImmutable::parse('2020-02-29 09:52:46.000000 UTC'), $period->getEndDate());
        $this->assertTrue($period->isEndIncluded());
        $this->assertFalse($period->isEndExcluded());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2019-10-31 09:52:46.000000',
            '2019-11-30 09:52:46.000000',
            '2019-12-31 09:52:46.000000',
            '2020-01-31 09:52:46.000000',
            '2020-02-29 09:52:46.000000',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testMonthlyWithStrings()
    {
        $period = CarbonPeriod::monthly(
            start: '2019-10-31 09:52:46.321654 UTC',
            end: '2020-02-29 09:52:46.321654 UTC',
        );

        $this->assertEquals(CarbonImmutable::parse('2020-02-29 09:52:46.321654 UTC'), $period->getEndDate());
        $this->assertTrue($period->isEndIncluded());
        $this->assertFalse($period->isEndExcluded());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(CarbonPeriod::IMMUTABLE, $period->getOptions());
        $this->assertSame([
            '2019-10-31 09:52:46.321654',
            '2019-11-30 09:52:46.321654',
            '2019-12-31 09:52:46.321654',
            '2020-01-31 09:52:46.321654',
            '2020-02-29 09:52:46.321654',
        ], $this->getDates($period, expectedDateClass: CarbonImmutable::class));
    }

    public function testMonthlyWithEndDateAndRecurrences()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'You must specify $end or $recurrences but not both',
        ));

        CarbonPeriod::monthly(
            end: Carbon::parse('2019-12-27 09:52:46.321654'),
            recurrences: 3,
        );
    }

    public function testModeIncompatibility()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            '$anchorDay parameter must not be set for $mode MonthlyMode::NoOverflow',
        ));

        CarbonPeriod::monthly(
            end: Carbon::parse('2019-12-27 09:52:46.321654'),
            anchorDay: 3,
            mode: MonthlyMode::NoOverflow,
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
