<?php
declare(strict_types=1);

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class RoundingTest extends AbstractTestCase
{
    public function testThrowsExceptionForCompositeInterval()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Rounding is only possible with single unit intervals.'
        );

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
