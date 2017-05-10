<?php

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class ConstantTest extends AbstractTestCase
{
    public function testSecondsPerHour()
    {
        $this->assertEquals(
            Carbon::create()->addHour(),
            Carbon::createFromTimestamp(time() + Carbon::SECONDS_PER_HOUR)
        );
    }

    public function testSecondsPerDay()
    {
        $this->assertEquals(
            Carbon::create()->addDay(),
            Carbon::createFromTimestamp(time() + Carbon::SECONDS_PER_DAY)
        );
    }

    public function testSecondsPerWeek()
    {
        $this->assertEquals(
            Carbon::create()->addWeek(),
            Carbon::createFromTimestamp(time() + Carbon::SECONDS_PER_WEEK)
        );
    }
}
