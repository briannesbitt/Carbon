<?php
declare(strict_types=1);

namespace Tests\CarbonPeriod;

use Carbon\CarbonPeriod;
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

        CarbonPeriod::days(2)->round('2 hours 50 minutes');
    }

    public function testFloor()
    {
        $period = CarbonPeriod::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->floor();

        $this->assertSame('2019-02-01 00:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 00:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = CarbonPeriod::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->floor();

        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = CarbonPeriod::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->floor();

        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 02:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));
    }
}
