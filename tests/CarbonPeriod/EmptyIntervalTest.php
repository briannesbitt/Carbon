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
use ReflectionClass;
use Tests\AbstractTestCase;

class EmptyIntervalTest extends AbstractTestCase
{
    /**
     * Test that iteration stops immediately when interval is empty.
     */
    public function testEmptyIntervalStopsIteration()
    {
        // Create period with valid interval first
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1),
            Carbon::parse('2024-01-31')
        );

        // Bypass validation using reflection (edge case scenario)
        $reflection = new ReflectionClass($period);
        $property = $reflection->getProperty('dateInterval');
        // setAccessible() is deprecated in PHP 8.5+ but still needed for older versions
        if (PHP_VERSION_ID < 8_05_00) {
            $property->setAccessible(true);
        }
        $property->setValue($period, CarbonInterval::days(0));

        // Iteration should stop after first date
        $count = 0;
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
            $count++;
            // Safety break to prevent infinite loop if fix doesn't work
            if ($count > 10) {
                $this->fail('Infinite loop detected: iteration did not stop with empty interval');
            }
        }

        // Should only yield the start date once
        $this->assertEquals(1, $count, 'Iteration should stop after first date');
        $this->assertEquals(['2024-01-01'], $dates, 'Should only contain start date');
    }

    /**
     * Test that next() method stops iteration when interval is empty.
     */
    public function testNextStopsWithEmptyInterval()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1),
            Carbon::parse('2024-01-31')
        );

        // Set empty interval via reflection
        $reflection = new ReflectionClass($period);
        $property = $reflection->getProperty('dateInterval');
        // setAccessible() is deprecated in PHP 8.5+ but still needed for older versions
        if (PHP_VERSION_ID < 8_05_00) {
            $property->setAccessible(true);
        }
        $property->setValue($period, CarbonInterval::hours(0));

        $period->rewind();
        $this->assertTrue($period->valid(), 'Should be valid initially');

        // First call to next() should stop iteration
        $period->next();
        $this->assertFalse($period->valid(), 'Should be invalid after next() with empty interval');
    }

    /**
     * Test that empty interval in getIterator() yields only start date.
     */
    public function testGetIteratorWithEmptyInterval()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2024-06-15'),
            CarbonInterval::days(1),
            Carbon::parse('2024-06-30')
        );

        // Set empty interval
        $reflection = new ReflectionClass($period);
        $property = $reflection->getProperty('dateInterval');
        // setAccessible() is deprecated in PHP 8.5+ but still needed for older versions
        if (PHP_VERSION_ID < 8_05_00) {
            $property->setAccessible(true);
        }
        $property->setValue($period, CarbonInterval::minutes(0));

        $iterator = $period->getIterator();
        $results = iterator_to_array($iterator);

        // Should only contain start date
        $this->assertCount(1, $results, 'Should only yield start date');
        $this->assertEquals('2024-06-15', $results[0]->format('Y-m-d'));
    }

    /**
     * Test that calculateEnd() handles empty interval correctly.
     */
    public function testCalculateEndWithEmptyInterval()
    {
        // Create period without end date to test empty interval behavior
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1)
        )->setRecurrences(5);

        // Set empty interval
        $reflection = new ReflectionClass($period);
        $property = $reflection->getProperty('dateInterval');
        // setAccessible() is deprecated in PHP 8.5+ but still needed for older versions
        if (PHP_VERSION_ID < 8_05_00) {
            $property->setAccessible(true);
        }
        $property->setValue($period, CarbonInterval::seconds(0));

        // calculateEnd() returns start date when interval is empty and no end date is set
        $end = $period->calculateEnd();
        $this->assertEquals('2024-01-01', $end->format('Y-m-d'), 'calculateEnd should return start date for empty interval when no end date');
    }

    /**
     * Test that empty interval WITH step function continues iteration (doesn't stop).
     * This tests the code path where isEmpty() is true but getStep() is not null.
     */
    public function testEmptyIntervalWithStepFunctionContinues()
    {
        // Create an empty interval with a step function
        $stepFunction = function ($date) {
            return $date->addDay();
        };

        $emptyIntervalWithStep = new CarbonInterval($stepFunction);
        // Verify it's empty
        $this->assertTrue($emptyIntervalWithStep->isEmpty());
        // Verify it has a step function
        $this->assertNotNull($emptyIntervalWithStep->getStep());

        // Create period with empty interval that has step function
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            $emptyIntervalWithStep,
            Carbon::parse('2024-01-05')
        );

        // Iteration should continue (not stop) because step function exists
        $count = 0;
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
            $count++;
            // Should iterate multiple times, not stop after first
            if ($count > 10) {
                break; // Safety break
            }
        }

        // Should have iterated multiple times (at least more than 1)
        $this->assertGreaterThan(1, $count, 'Empty interval with step function should continue iteration');
        $this->assertContains('2024-01-01', $dates, 'Should contain start date');
    }

    /**
     * Test that incrementCurrentDateUntilValid() handles empty interval with step function correctly.
     */
    public function testIncrementCurrentDateUntilValidWithEmptyIntervalAndStep()
    {
        // Create an empty interval with a step function
        $stepFunction = function ($date) {
            return $date->addDay();
        };

        $emptyIntervalWithStep = new CarbonInterval($stepFunction);

        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            $emptyIntervalWithStep,
            Carbon::parse('2024-01-03')
        );

        $period->rewind();
        $this->assertTrue($period->valid(), 'Should be valid initially');

        // Call next() - should continue because step function exists
        $period->next();
        $this->assertTrue($period->valid(), 'Should still be valid after next() with empty interval that has step function');
    }

    /**
     * Test that incrementCurrentDateUntilValid() uses convertDate() when step function exists.
     * This ensures the ternary operator's true branch is covered.
     */
    public function testIncrementCurrentDateUntilValidUsesConvertDateWithStepFunction()
    {
        // Create interval with step function (not empty)
        $stepFunction = function ($date) {
            return $date->addDay();
        };

        $intervalWithStep = CarbonInterval::days(1);
        $intervalWithStep->setStep($stepFunction);

        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            $intervalWithStep,
            Carbon::parse('2024-01-05')
        );

        // Add a filter that will reject some dates, forcing incrementCurrentDateUntilValid() to be called
        $period->filter(function ($date) {
            // Only accept dates on even days
            return (int) $date->format('d') % 2 === 0;
        });

        $period->rewind();
        $this->assertTrue($period->valid(), 'Should be valid initially');

        // Call next() - this will call incrementCurrentDateUntilValid() which should use convertDate()
        $period->next();
        // Should find a valid date using convertDate() path
        $this->assertTrue($period->valid(), 'Should find valid date using convertDate() path');
    }

    /**
     * Test that incrementCurrentDateUntilValid() uses add() when no step function exists.
     * This ensures the ternary operator's false branch is covered.
     */
    public function testIncrementCurrentDateUntilValidUsesAddWithoutStepFunction()
    {
        // Create normal interval without step function
        $period = CarbonPeriod::create(
            Carbon::parse('2024-01-01'),
            CarbonInterval::days(1),
            Carbon::parse('2024-01-05')
        );

        // Add a filter that will reject some dates, forcing incrementCurrentDateUntilValid() to be called
        $period->filter(function ($date) {
            // Only accept dates on even days
            return (int) $date->format('d') % 2 === 0;
        });

        $period->rewind();
        $this->assertTrue($period->valid(), 'Should be valid initially');

        // Call next() - this will call incrementCurrentDateUntilValid() which should use add()
        $period->next();
        // Should find a valid date using add() path
        $this->assertTrue($period->valid(), 'Should find valid date using add() path');
    }
}
