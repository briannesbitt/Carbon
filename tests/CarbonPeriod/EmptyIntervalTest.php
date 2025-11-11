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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\InvalidIntervalException;
use Tests\AbstractTestCase;

class EmptyIntervalTest extends AbstractTestCase
{
    /**
     * Test that setDateInterval() throws exception for empty intervals without step functions.
     * This is the normal behavior that prevents empty intervals from being created.
     */
    public function testSetDateIntervalThrowsExceptionForEmptyInterval()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1),
            Carbon::parse('2024-01-31')
        );

        $this->expectException(InvalidIntervalException::class);
        $this->expectExceptionMessage('Empty interval is not accepted.');

        // This should throw an exception
        $period->setDateInterval(CarbonInterval::days(0));
    }

    /**
     * Test that empty intervals with step functions are allowed and work correctly.
     * This tests the legitimate case where empty intervals are valid.
     */
    public function testEmptyIntervalWithStepFunctionIsAllowed()
    {
        // Create an empty interval with a step function
        $stepFunction = function ($date) {
            return $date->addDay();
        };

        $emptyIntervalWithStep = new CarbonInterval($stepFunction);

        // Verify it's empty but has a step function
        $this->assertTrue($emptyIntervalWithStep->isEmpty());
        $this->assertNotNull($emptyIntervalWithStep->getStep());

        // Create period with empty interval that has step function - this should work
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            $emptyIntervalWithStep,
            Carbon::parse('2024-01-05')
        );

        // Iteration should work normally because step function exists
        $count = 0;
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
            $count++;
            // Safety break to prevent infinite loop in case of bugs
            if ($count > 10) {
                break;
            }
        }

        // Should have iterated multiple times (at least more than 1)
        $this->assertGreaterThan(1, $count, 'Empty interval with step function should continue iteration');
        $this->assertContains('2024-01-01', $dates, 'Should contain start date');
        $this->assertContains('2024-01-02', $dates, 'Should contain next date via step function');
    }

    /**
     * Test that trying to create a period with PT0S interval throws exception.
     */
    public function testCreatePeriodWithPT0SIntervalThrowsException()
    {
        $this->expectException(InvalidIntervalException::class);
        $this->expectExceptionMessage('Empty interval is not accepted.');

        // This should throw an exception during creation
        CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            'PT0S', // Empty interval specification
            Carbon::parse('2024-01-31')
        );
    }

    /**
     * Test that trying to create a period with zero interval throws exception.
     */
    public function testCreatePeriodWithZeroIntervalThrowsException()
    {
        $this->expectException(InvalidIntervalException::class);
        $this->expectExceptionMessage('Empty interval is not accepted.');

        // This should throw an exception during creation
        CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::seconds(0), // Empty interval
            Carbon::parse('2024-01-31')
        );
    }

    /**
     * Test that empty intervals created through various methods are properly rejected.
     */
    public function testVariousEmptyIntervalsAreRejected()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1),
            Carbon::parse('2024-01-31')
        );

        // Test various ways to create empty intervals
        $emptyIntervals = [
            CarbonInterval::hours(0),
            CarbonInterval::minutes(0),
            CarbonInterval::seconds(0),
            new CarbonInterval('PT0S'),
            CarbonInterval::create(0, 0, 0, 0, 0, 0),
        ];

        foreach ($emptyIntervals as $emptyInterval) {
            try {
                $period->setDateInterval($emptyInterval);
                $this->fail('Expected InvalidIntervalException for empty interval: ' . $emptyInterval->spec());
            } catch (InvalidIntervalException $e) {
                $this->assertStringContainsString('Empty interval is not accepted', $e->getMessage());
            }
        }
    }

    /**
     * Test that the infinite loop protection constants are properly defined.
     * This ensures the existing safety mechanisms are in place.
     */
    public function testInfiniteLoopProtectionConstantsExist()
    {
        $this->assertTrue(defined('Carbon\CarbonPeriod::NEXT_MAX_ATTEMPTS'));
        $this->assertTrue(defined('Carbon\CarbonPeriod::END_MAX_ATTEMPTS'));

        $this->assertEquals(1000, CarbonPeriod::NEXT_MAX_ATTEMPTS);
        $this->assertEquals(10000, CarbonPeriod::END_MAX_ATTEMPTS);
    }

    /**
     * Test that periods with very small but non-zero intervals work correctly.
     * This ensures we don't accidentally break legitimate small intervals.
     */
    public function testVerySmallIntervalsWork()
    {
        // Test microsecond interval
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01 12:00:00.000000'),
            CarbonInterval::microseconds(1),
            Carbon::parse('2024-01-01 12:00:00.000005')
        );

        $count = 0;
        foreach ($period as $date) {
            $count++;
            if ($count > 10) { // Safety break
                break;
            }
        }

        $this->assertGreaterThan(1, $count, 'Very small intervals should still work');
    }

    /**
     * Test that intervals with fractional seconds work correctly.
     */
    public function testFractionalSecondsWork()
    {
        // Create interval with fractional seconds
        $interval = CarbonInterval::seconds(0);
        $interval->f = 0.5; // 500 milliseconds

        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01 12:00:00.000'),
            $interval,
            Carbon::parse('2024-01-01 12:00:02.000')
        );

        $count = 0;
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d H:i:s.u');
            $count++;
            if ($count > 10) { // Safety break
                break;
            }
        }

        $this->assertGreaterThan(1, $count, 'Fractional second intervals should work');
        $this->assertStringContainsString('12:00:00.000000', $dates[0] ?? '');
        $this->assertStringContainsString('12:00:00.500000', $dates[1] ?? '');
    }
}
