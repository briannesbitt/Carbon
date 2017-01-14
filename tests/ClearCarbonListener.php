<?php

namespace Tests;

use PHPUnit_Framework_BaseTestListener;
use PHPUnit_Framework_Test;
use Carbon\Carbon;

/**
 * Reduce side effects of unit tests with Carbon setTimeNow usage
 *
 * PHPUnit test listener that will reset the test time between tests for cases
 * where a test missed clearing the test time and a following test is not
 * expecting test time set.
 */
class ClearCarbonListener extends PHPUnit_Framework_BaseTestListener
{
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        Carbon::setTestNow();
    }
}
