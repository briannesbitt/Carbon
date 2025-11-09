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

namespace Tests\Helpers;

use Carbon\Carbon;
use Carbon\Helpers\DstHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class DstHelperTest extends AbstractTestCase
{
    /**
     * Test DST transition detection.
     */
    public function testIsDstTransition()
    {
        // Spring forward in New York (2:00 AM becomes 3:00 AM)
        $this->assertTrue(DstHelper::isDstTransition(2024, 3, 10, 2, 30, 0, 'America/New_York'));

        // Valid time before transition
        $this->assertFalse(DstHelper::isDstTransition(2024, 3, 10, 1, 30, 0, 'America/New_York'));

        // Valid time after transition
        $this->assertFalse(DstHelper::isDstTransition(2024, 3, 10, 3, 30, 0, 'America/New_York'));

        // Fall back in New York (1:30 AM is valid, occurs twice but Carbon creates it)
        $this->assertFalse(DstHelper::isDstTransition(2024, 11, 3, 1, 30, 0, 'America/New_York'));
    }

    /**
     * Test safe DST creation with different strategies.
     */
    #[DataProvider('dstCreationProvider')]
    public function testCreateSafeDst($year, $month, $day, $hour, $minute, $second, $timezone, $strategy, $expectedResult)
    {
        $result = DstHelper::createSafeDst($year, $month, $day, $hour, $minute, $second, $timezone, $strategy);

        if ($expectedResult === null) {
            $this->assertNull($result);
            return;
        }

        $this->assertNotNull($result);
        $this->assertInstanceOf(Carbon::class, $result);

        if (isset($expectedResult['hour'])) {
            $this->assertEquals($expectedResult['hour'], $result->hour);
        }
        if (isset($expectedResult['minute'])) {
            $this->assertEquals($expectedResult['minute'], $result->minute);
        }
    }

    public static function dstCreationProvider(): array
    {
        return [
            // Spring forward - invalid time 2:30 AM
            [2024, 3, 10, 2, 30, 0, 'America/New_York', 'safe', null],
            [2024, 3, 10, 2, 30, 0, 'America/New_York', 'forward', ['hour' => 3]],
            [2024, 3, 10, 2, 30, 0, 'America/New_York', 'backward', ['hour' => 1]],
            [2024, 3, 10, 2, 30, 0, 'America/New_York', 'utc', ['hour' => 2]],

            // Valid times should work with all strategies
            [2024, 3, 10, 1, 30, 0, 'America/New_York', 'safe', ['hour' => 1, 'minute' => 30]],
            [2024, 3, 10, 3, 30, 0, 'America/New_York', 'safe', ['hour' => 3, 'minute' => 30]],

            // Fall back - ambiguous time 1:30 AM (occurs twice, but Carbon will create it)
            [2024, 11, 3, 1, 30, 0, 'America/New_York', 'safe', ['hour' => 1, 'minute' => 30]],
            [2024, 11, 3, 1, 30, 0, 'America/New_York', 'forward', ['hour' => 1, 'minute' => 30]],
        ];
    }

    /**
     * Test DST transitions retrieval.
     */
    public function testGetDstTransitions()
    {
        $transitions = DstHelper::getDstTransitions(2024, 'America/New_York');

        $this->assertIsArray($transitions);
        $this->assertNotEmpty($transitions);

        // Should have at least 2 transitions (spring forward and fall back)
        $this->assertGreaterThanOrEqual(2, count($transitions));

        foreach ($transitions as $transition) {
            $this->assertArrayHasKey('time', $transition);
            $this->assertArrayHasKey('offset', $transition);
            $this->assertArrayHasKey('isdst', $transition);
            $this->assertArrayHasKey('abbr', $transition);
            $this->assertInstanceOf(Carbon::class, $transition['time']);
        }
    }

    /**
     * Test safe timezone conversion.
     */
    public function testSafeTimezoneConversion()
    {
        $original = Carbon::parse('2024-06-15 12:00:00', 'UTC');
        $converted = DstHelper::safeTimezoneConversion($original, 'America/New_York');

        $this->assertEquals('America/New_York', $converted->getTimezone()->getName());
        $this->assertEquals($original->getTimestamp(), $converted->getTimestamp());
        $this->assertEquals($original->microsecond, $converted->microsecond);
    }

    /**
     * Test same moment comparison.
     */
    public function testIsSameMoment()
    {
        $utc = Carbon::parse('2024-06-15 16:00:00', 'UTC');
        $ny = Carbon::parse('2024-06-15 12:00:00', 'America/New_York');
        $london = Carbon::parse('2024-06-15 17:00:00', 'Europe/London');

        $this->assertTrue(DstHelper::isSameMoment($utc, $ny));
        $this->assertTrue(DstHelper::isSameMoment($utc, $london));
        $this->assertTrue(DstHelper::isSameMoment($ny, $london));

        // Different moments
        $different = Carbon::parse('2024-06-15 16:01:00', 'UTC');
        $this->assertFalse(DstHelper::isSameMoment($utc, $different));
    }

    /**
     * Test transitions in range.
     */
    public function testGetTransitionsInRange()
    {
        $start = Carbon::parse('2024-01-01', 'America/New_York');
        $end = Carbon::parse('2024-12-31', 'America/New_York');

        $transitions = DstHelper::getTransitionsInRange($start, $end, 'America/New_York');

        $this->assertIsArray($transitions);
        $this->assertNotEmpty($transitions);

        // Check that all transitions are within the range
        foreach ($transitions as $transition) {
            $this->assertTrue($transition['time']->between($start, $end));
        }
    }

    /**
     * Test edge cases and error handling.
     */
    public function testEdgeCases()
    {
        // Invalid timezone
        $result = DstHelper::createSafeDst(2024, 3, 10, 2, 30, 0, 'Invalid/Timezone', 'safe');
        $this->assertNull($result);

        // Invalid date
        $result = DstHelper::createSafeDst(2024, 2, 30, 12, 0, 0, 'UTC', 'safe');
        $this->assertNull($result);

        // Year boundaries
        $result = DstHelper::createSafeDst(1970, 1, 1, 0, 0, 0, 'UTC', 'safe');
        $this->assertNotNull($result);

        // Future dates
        $result = DstHelper::createSafeDst(2030, 6, 15, 12, 0, 0, 'UTC', 'safe');
        $this->assertNotNull($result);
    }

    /**
     * Test multiple timezone conversions.
     */
    public function testMultipleTimezoneConversions()
    {
        $original = Carbon::parse('2024-06-15 12:00:00.123456', 'UTC');

        // Chain multiple conversions
        $step1 = DstHelper::safeTimezoneConversion($original, 'America/New_York');
        $step2 = DstHelper::safeTimezoneConversion($step1, 'Europe/London');
        $step3 = DstHelper::safeTimezoneConversion($step2, 'Asia/Tokyo');
        $final = DstHelper::safeTimezoneConversion($step3, 'UTC');

        // Should preserve the exact moment
        $this->assertTrue(DstHelper::isSameMoment($original, $final));
        $this->assertEquals($original->microsecond, $final->microsecond);
    }

    /**
     * Test DST boundary conditions.
     */
    public function testDstBoundaryConditions()
    {
        // Test times around DST transitions
        $testCases = [
            // Spring forward boundary (2:00 AM becomes 3:00 AM)
            ['2024-03-10 01:59:59', 'America/New_York', false],
            ['2024-03-10 02:00:00', 'America/New_York', true],
            ['2024-03-10 02:59:59', 'America/New_York', true],
            ['2024-03-10 03:00:00', 'America/New_York', false],

            // Fall back boundary (2:00 AM becomes 1:00 AM - times exist but are ambiguous)
            ['2024-11-03 01:00:00', 'America/New_York', false], // This time exists
            ['2024-11-03 01:59:59', 'America/New_York', false], // This time exists
            ['2024-11-03 02:00:00', 'America/New_York', false], // This time exists after fall back
        ];

        foreach ($testCases as [$timeString, $timezone, $expectedTransition]) {
            $parts = explode(' ', $timeString);
            $dateParts = explode('-', $parts[0]);
            $timeParts = explode(':', $parts[1]);

            $isDst = DstHelper::isDstTransition(
                (int)$dateParts[0],
                (int)$dateParts[1],
                (int)$dateParts[2],
                (int)$timeParts[0],
                (int)$timeParts[1],
                (int)$timeParts[2],
                $timezone
            );

            $this->assertEquals(
                $expectedTransition,
                $isDst,
                "Failed for {$timeString} in {$timezone}"
            );
        }
    }

    /**
     * Test performance with many DST checks.
     */
    public function testPerformance()
    {
        $start = microtime(true);

        // Perform many DST checks
        for ($i = 0; $i < 1000; $i++) {
            DstHelper::isDstTransition(2024, 3, 10, 2, 30, 0, 'America/New_York');
        }

        $end = microtime(true);
        $duration = $end - $start;

        // Should complete within reasonable time (adjust threshold as needed)
        $this->assertLessThan(1.0, $duration, 'DST checks should be performant');
    }
}
