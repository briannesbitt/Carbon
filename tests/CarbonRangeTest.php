<?php

use Carbon\Carbon;
use Carbon\CarbonRange;

class CarbonRangeTest extends TestFixture
{
    /**
     * @inherit
     */
    public function tearDown()
    {
        Carbon::setTestNow();
    }

    // __construct()

    public function testCarbonRangeAcceptsTimezone()
    {
        Carbon::setTestNow(Carbon::create(2015,10,10));

        $after = Carbon::now()->subDay()->endOfDay();

        $before = Carbon::now()->addDay()->startOfDay();

        $timezone = 'GB';

        $range = new CarbonRange($after, $before, null, $timezone);

        $this->assertEquals($timezone, $range->getTimezone());
    }

//    // forHuman() (with span of a single day)
//
//    public function testReturnsString()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,10));
//
//        $after = \Carbon\Carbon::now()->subDay()->endOfDay();
//
//        $before = \Carbon\Carbon::now()->addDay()->startOfDay();
//
//        $range = new \Carbon\CarbonRange($after, $before);
//
//        $this->assertTrue(is_string($range->forHumans()));
//    }
//
//    public function testReturnValueIfSpansCurrentDay()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,10));
//
//        $to     = Carbon::now()->endOfDay();
//
//        $from   = Carbon::now()->startOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Today', $result);
//    }
//
//    public function testReturnValueIfSpansDayInCurrentWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,10));
//
//        $day   = Carbon::now()->subDay();
//
//        $from  = $day->copy()->startOfDay();
//
//        $to    = $day->copy()->endOfDay();
//
//        $range = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Friday', $result);
//    }
//
//    public function testReturnValueIfSpansDayInNextWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,10));
//
//        $day    = Carbon::now()->subDay()->addWeek();
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Next Friday', $result);
//    }
//
//    public function testReturnValueIfSpansDayAfterNextWeekButInCurrentMonth()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,10));
//
//        $day    = Carbon::now()->subDay()->addWeeks(2);
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Friday 23rd', $result);
//    }
//
//    public function testReturnValueIfSpansDayNotInCurrentMonth()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day = \Carbon\Carbon::now()->subDay()->addMonth();
//
//        $from = $day->copy()->startOfDay();
//
//        $to = $day->copy()->endOfDay();
//
//        $range = \Carbon\CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Thursday 19th of November', $result);
//    }
//
//    public function testReturnValueIfSpansDayInLastWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->subDay()->subWeek();
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = \Carbon\CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals('Last Monday', $result);
//    }
//
//    public function testReturnValueIfSpansDayBeforeLastWeekButInCurrentMonth()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->subDay()->subWeeks(2);
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Monday 5th", $result);
//    }
//
//    public function testReturnValueIfSpansDayInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->startOfYear();
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Thursday 1st of January", $result);
//    }
//
//    public function testReturnValueIfSpansDayNotInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->addYear()->startOfYear();
//
//        $from   = $day->copy()->startOfDay();
//
//        $to     = $day->copy()->endOfDay();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Friday 1st of January 2016", $result);
//    }
//
//    // forHuman() (with span of a single week)
//
//    public function testReturnValueIfSpansCurrentWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now();
//
//        $from   = $day->copy()->startOfWeek();
//
//        $to     = $day->copy()->endOfWeek();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("This Week", $result);
//    }
//
//    public function testReturnValueIfSpansNextWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->addWeek();
//
//        $from   = $day->copy()->startOfWeek();
//
//        $to     = $day->copy()->endOfWeek();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Next Week", $result);
//    }
//
//    public function testReturnValueIfSpansLastWeek()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->subWeek();
//
//        $from   = $day->copy()->startOfWeek();
//
//        $to     = $day->copy()->endOfWeek();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Last Week", $result);
//    }
//
//    public function testReturnValueIfSpansWeekInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->subWeeks(2);
//
//        $from   = $day->copy()->startOfWeek();
//
//        $to     = $day->copy()->endOfWeek();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Week Starting 5th October", $result);
//    }
//
//    public function testReturnValueIfSpansWeekNotInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->addYear();
//
//        $from   = $day->copy()->startOfWeek();
//
//        $to     = $day->copy()->endOfWeek();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("Week Starting 17th October 2016", $result);
//    }
//
//    // forHuman() (with span of a single month)
//
//    public function testReturnValueIfSpansMonthInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now();
//
//        $from   = $day->copy()->startOfMonth();
//
//        $to     = $day->copy()->endOfMonth();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("October", $result);
//    }
//
//    public function testReturnValueIfSpansMonthNotInCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->addYear();
//
//        $from   = $day->copy()->startOfMonth();
//
//        $to     = $day->copy()->endOfMonth();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("October 2016", $result);
//    }
//
//    // forHuman() (with span of a single year)
//
//    public function testReturnValueIfSpansCurrentYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now();
//
//        $from   = $day->copy()->startOfYear();
//
//        $to     = $day->copy()->endOfYear();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("This Year", $result);
//    }
//
//    public function testReturnValueIfSpansYear()
//    {
//        Carbon::setTestNow(Carbon::create(2015,10,20));
//
//        $day    = Carbon::now()->addYear();
//
//        $from   = $day->copy()->startOfYear();
//
//        $to     = $day->copy()->endOfYear();
//
//        $range  = CarbonRange::between($from, $to);
//
//        $result = $range->forHumans();
//
//        $this->assertEquals("2016", $result);
//    }
}