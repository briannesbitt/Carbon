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
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
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
        $property->setAccessible(true);
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
        $property->setAccessible(true);
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
        $property->setAccessible(true);
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
        $property->setAccessible(true);
        $property->setValue($period, CarbonInterval::seconds(0));

        // calculateEnd() returns start date when interval is empty and no end date is set
        $end = $period->calculateEnd();
        $this->assertEquals('2024-01-01', $end->format('Y-m-d'), 'calculateEnd should return start date for empty interval when no end date');
    }
}

