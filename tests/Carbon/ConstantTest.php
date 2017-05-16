<?php

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class ConstantTest extends AbstractTestCase
{
    public function testSecondsPerHour()
    {
        $this->assertEquals(
            Carbon::SECONDS_PER_MINUTE * Carbon::MINUTES_PER_HOUR,
            Carbon::SECONDS_PER_HOUR
        );
    }

    public function testSecondsPerDay()
    {
        $this->assertEquals(
            Carbon::SECONDS_PER_MINUTE * Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
            Carbon::SECONDS_PER_DAY
        );
    }

    public function testSecondsPerWeek()
    {
        $this->assertEquals(
            Carbon::SECONDS_PER_MINUTE * Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY * Carbon::DAYS_PER_WEEK,
            Carbon::SECONDS_PER_WEEK
        );
    }
}
