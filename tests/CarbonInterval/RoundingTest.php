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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class RoundingTest extends AbstractTestCase
{
    public function testThrowsExceptionForCompositeInterval()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Rounding is only possible with single unit intervals.'
        ));

        CarbonInterval::days(2)->round('2 hours 50 minutes');
    }

    public function testFloor()
    {
        $this->assertSame(21, CarbonInterval::days(21)->floorWeeks()->totalDays);
        $this->assertSame(21, CarbonInterval::days(24)->floorWeeks()->totalDays);
        $this->assertSame(21, CarbonInterval::days(25)->floorWeeks()->totalDays);
        $this->assertSame(21, CarbonInterval::days(27)->floorWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(28)->floorWeeks()->totalDays);

        $this->assertSame(1000, CarbonInterval::milliseconds(1234)->floor()->totalMilliseconds);
        $this->assertSame(1000, CarbonInterval::milliseconds(1834)->floor()->totalMilliseconds);
        $this->assertSame(20, CarbonInterval::days(21)->floor('2 days')->totalDays);
        $this->assertSame(18, CarbonInterval::days(21)->floor(CarbonInterval::days(6))->totalDays);
        $this->assertSame(18, CarbonInterval::days(22)->floorUnit('day', 6)->totalDays);
    }

    public function testRound()
    {
        $this->assertSame(21, CarbonInterval::days(21)->roundWeeks()->totalDays);
        $this->assertSame(21, CarbonInterval::days(24)->roundWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(25)->roundWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(27)->roundWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(28)->roundWeeks()->totalDays);
        $this->assertSame(-7, CarbonInterval::make('7 days 23 hours 34 minutes')->invert()->roundWeeks()->totalDays);
        $this->assertSame(-7, CarbonInterval::make('-7 days 23 hours 34 minutes')->roundWeeks()->totalDays);
        $this->assertSame(7, CarbonInterval::make('-7 days 23 hours 34 minutes')->invert()->roundWeeks()->totalDays);

        $this->assertSame(1000, CarbonInterval::milliseconds(1234)->round()->totalMilliseconds);
        $this->assertSame(2000, CarbonInterval::milliseconds(1834)->round()->totalMilliseconds);
        $this->assertSame(20, CarbonInterval::days(20)->round('2 days')->totalDays);
        $this->assertSame(18, CarbonInterval::days(20)->round(CarbonInterval::days(6))->totalDays);
        $this->assertSame(22, CarbonInterval::days(21)->round('2 days')->totalDays);
        $this->assertSame(24, CarbonInterval::days(21)->round(CarbonInterval::days(6))->totalDays);
        $this->assertSame(22, CarbonInterval::days(22)->round('2 days')->totalDays);
        $this->assertSame(24, CarbonInterval::days(22)->round(CarbonInterval::days(6))->totalDays);
        $this->assertSame(24, CarbonInterval::days(22)->roundUnit('day', 6)->totalDays);
    }

    public function testTotalAfterRound()
    {
        $this->assertSame(19, CarbonInterval::make('43h3m6s')->roundMinutes()->hours);
        $this->assertSame(43.05, CarbonInterval::make('43h3m6s')->roundMinutes()->totalHours);
    }

    public function testWithCascadeFactors()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'millisecond' => [1000, 'microseconds'],
            'second'      => [1000, 'milliseconds'],
            'minute'      => [60, 'seconds'],
            'hour'        => [60, 'minutes'],
        ]);

        $this->assertEqualsWithDelta(
            43.166666666666664,
            CarbonInterval::make('43h3m6s')
                ->ceilMinutes(10)
                ->totalHours,
            0.00000001
        );
        $this->assertSame(
            43,
            CarbonInterval::make('43h3m6s')
                ->floorMinutes(6)
                ->totalHours
        );
        $this->assertSame(
            43.05,
            CarbonInterval::make('43h3m6s')
                ->roundMinutes()
                ->totalHours
        );
        $this->assertEqualsWithDelta(
            43.05833333333333,
            CarbonInterval::make('43h3m26s')
                ->roundMinutes(0.5)
                ->totalHours,
            0.00000001
        );
        $this->assertSame(
            -43.05,
            CarbonInterval::make('43h3m6s')
                ->invert()
                ->roundMinutes(0.5)
                ->totalHours
        );

        CarbonInterval::setCascadeFactors($cascades);
    }

    public function testCeil()
    {
        $this->assertSame(21, CarbonInterval::days(21)->ceilWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(24)->ceilWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(25)->ceilWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(27)->ceilWeeks()->totalDays);
        $this->assertSame(28, CarbonInterval::days(28)->ceilWeeks()->totalDays);

        $this->assertSame(2000, CarbonInterval::milliseconds(1234)->ceil()->totalMilliseconds);
        $this->assertSame(2000, CarbonInterval::milliseconds(1834)->ceil()->totalMilliseconds);
        $this->assertSame(20, CarbonInterval::days(20)->ceil('2 days')->totalDays);
        $this->assertSame(24, CarbonInterval::days(20)->ceil(CarbonInterval::days(6))->totalDays);
        $this->assertSame(22, CarbonInterval::days(21)->ceil('2 days')->totalDays);
        $this->assertSame(24, CarbonInterval::days(21)->ceil(CarbonInterval::days(6))->totalDays);
        $this->assertSame(22, CarbonInterval::days(22)->ceil('2 days')->totalDays);
        $this->assertSame(24, CarbonInterval::days(22)->ceil(CarbonInterval::days(6))->totalDays);
        $this->assertSame(24, CarbonInterval::days(22)->ceilUnit('day', 6)->totalDays);
    }
}
