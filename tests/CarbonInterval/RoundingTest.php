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
    }
}
