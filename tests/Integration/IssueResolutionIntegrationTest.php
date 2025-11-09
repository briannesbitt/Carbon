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

namespace Tests\Integration;

use Carbon\Carbon;
use Carbon\Helpers\DstHelper;
use Tests\AbstractTestCase;

/**
 * Integration test demonstrating DST handling solutions for Carbon library.
 */
class IssueResolutionIntegrationTest extends AbstractTestCase
{
    /**
     * Test comprehensive DST handling in a real-world scheduling scenario.
     */
    public function testDstSchedulingScenario()
    {
        // Real-world scenario: Scheduling recurring meetings across DST transitions
        $meetingStart = Carbon::parse('2024-03-08 14:00:00', 'America/New_York'); // Before DST

        // Generate 10 weekly meetings
        $meetings = [];
        $current = $meetingStart->copy();

        for ($i = 0; $i < 10; $i++) {
            // Use DST-safe creation for each meeting
            $safeMeeting = DstHelper::createSafeDst(
                $current->year,
                $current->month,
                $current->day,
                $current->hour,
                $current->minute,
                $current->second,
                'America/New_York',
                'forward'
            );

            if ($safeMeeting) {
                $meetings[] = $safeMeeting;

                // Convert to different timezones safely
                $utcMeeting = DstHelper::safeTimezoneConversion($safeMeeting, 'UTC');
                $londonMeeting = DstHelper::safeTimezoneConversion($safeMeeting, 'Europe/London');

                // Verify all represent the same moment
                $this->assertTrue(DstHelper::isSameMoment($safeMeeting, $utcMeeting));
                $this->assertTrue(DstHelper::isSameMoment($safeMeeting, $londonMeeting));
            }

            $current = $current->addWeek();
        }

        $this->assertCount(10, $meetings);

        // Verify DST transition was handled (March 10, 2024 is DST transition)
        $dstTransitionMeeting = $meetings[1]; // Should be March 15, 2024
        $this->assertEquals(14, $dstTransitionMeeting->hour); // Should maintain 2 PM
    }

    /**
     * Test DST handling in automated scheduling systems.
     */
    public function testAutomatedSchedulingScenario()
    {
        // Real-world scenario: Automated backup system that runs at 2:30 AM daily
        $backupTimes = [];
        $startDate = Carbon::parse('2024-03-08', 'America/New_York'); // Before DST

        // Schedule backups for 7 days (includes DST transition on March 10)
        for ($i = 0; $i < 7; $i++) {
            $currentDate = $startDate->copy()->addDays($i);

            // Try to schedule backup at 2:30 AM
            $backupTime = DstHelper::createSafeDst(
                $currentDate->year,
                $currentDate->month,
                $currentDate->day,
                2,
                30,
                0,
                'America/New_York',
                'forward' // Move to next valid time if 2:30 doesn't exist
            );

            if ($backupTime) {
                $backupTimes[] = $backupTime;
            }
        }

        $this->assertCount(7, $backupTimes);

        // March 10, 2024 backup should be at 3:30 AM (DST transition)
        $dstBackup = $backupTimes[2]; // March 10th
        $this->assertEquals(3, $dstBackup->hour); // Should be 3:30 AM, not 2:30 AM
        $this->assertEquals(30, $dstBackup->minute);
    }

    /**
     * Test DST handling across multiple timezones.
     */
    public function testMultiTimezoneScenario()
    {
        // Real-world scenario: Global conference with participants in different timezones
        $conferenceTime = DstHelper::createSafeDst(2024, 3, 10, 14, 0, 0, 'America/New_York', 'forward');
        $this->assertNotNull($conferenceTime);

        // Convert to different timezones for global participants
        $timezones = [
            'UTC',
            'Europe/London',
            'Asia/Tokyo',
            'Australia/Sydney'
        ];

        $globalTimes = [];
        foreach ($timezones as $timezone) {
            $convertedTime = DstHelper::safeTimezoneConversion($conferenceTime, $timezone);
            $globalTimes[$timezone] = $convertedTime;

            // Verify all times represent the same moment
            $this->assertTrue(DstHelper::isSameMoment($conferenceTime, $convertedTime));
        }

        $this->assertCount(4, $globalTimes);

        // Verify UTC conversion
        $this->assertEquals('UTC', $globalTimes['UTC']->getTimezone()->getName());

        // All should have same timestamp
        $originalTimestamp = $conferenceTime->getTimestamp();
        foreach ($globalTimes as $convertedTime) {
            $this->assertEquals($originalTimestamp, $convertedTime->getTimestamp());
        }
    }

    /**
     * Test DST transition detection and handling strategies.
     */
    public function testDstTransitionStrategies()
    {
        // Test all 4 strategies during spring forward (2:30 AM doesn't exist)
        $year = 2024;
        $month = 3;
        $day = 10;
        $hour = 2;
        $minute = 30;
        $timezone = 'America/New_York';

        // Strategy 1: safe - should return null
        $safeResult = DstHelper::createSafeDst($year, $month, $day, $hour, $minute, 0, $timezone, 'safe');
        $this->assertNull($safeResult);

        // Strategy 2: forward - should move to 3:30 AM
        $forwardResult = DstHelper::createSafeDst($year, $month, $day, $hour, $minute, 0, $timezone, 'forward');
        $this->assertNotNull($forwardResult);
        $this->assertEquals(3, $forwardResult->hour);
        $this->assertEquals(30, $forwardResult->minute);

        // Strategy 3: backward - should move to 1:30 AM
        $backwardResult = DstHelper::createSafeDst($year, $month, $day, $hour, $minute, 0, $timezone, 'backward');
        $this->assertNotNull($backwardResult);
        $this->assertEquals(1, $backwardResult->hour);
        $this->assertEquals(30, $backwardResult->minute);

        // Strategy 4: utc - should create in UTC
        $utcResult = DstHelper::createSafeDst(
            $year,
            $month,
            $day,
            $hour,
            $minute,
            0,
            $timezone,
            'utc'
        );
        $this->assertNotNull($utcResult);
        $this->assertEquals('UTC', $utcResult->getTimezone()->getName());
        $this->assertEquals(2, $utcResult->hour);
        $this->assertEquals(30, $utcResult->minute);

        // Verify DST transition detection
        $this->assertTrue(DstHelper::isDstTransition($year, $month, $day, $hour, $minute, 0, $timezone));

        // Verify valid times are not detected as DST transitions
        $this->assertFalse(DstHelper::isDstTransition($year, $month, $day, 1, 30, 0, $timezone));
        $this->assertFalse(DstHelper::isDstTransition($year, $month, $day, 3, 30, 0, $timezone));
    }

    /**
     * Test DST error handling and edge cases.
     */
    public function testDstErrorHandling()
    {
        // Test invalid timezone
        $invalidTimezone = DstHelper::createSafeDst(
            2024,
            3,
            10,
            2,
            30,
            0,
            'Invalid/Timezone',
            'safe'
        );
        $this->assertNull($invalidTimezone);

        // Test invalid date
        $invalidDate = DstHelper::createSafeDst(
            2024,
            2,
            30,
            12,
            0,
            0,
            'UTC',
            'safe'
        );
        $this->assertNull($invalidDate);

        // Test DST transition detection with invalid time
        $isDstTransition = DstHelper::isDstTransition(2024, 3, 10, 2, 30, 0, 'America/New_York');
        $this->assertTrue($isDstTransition);

        // Test fall back transition (November 3, 2024)
        $fallBackTime = DstHelper::createSafeDst(
            2024,
            11,
            3,
            1,
            30,
            0,
            'America/New_York',
            'safe'
        );
        $this->assertNotNull($fallBackTime); // This time exists (occurs twice)
    }

    /**
     * Test DST performance with realistic workloads.
     */
    public function testDstPerformance()
    {
        $start = microtime(true);

        // Simulate realistic DST workload
        for ($i = 0; $i < 100; $i++) {
            // Test DST creation
            $date = DstHelper::createSafeDst(
                2024,
                3,
                10,
                14,
                0,
                0,
                'America/New_York',
                'forward'
            );

            // Test timezone conversion
            $utcDate = DstHelper::safeTimezoneConversion($date, 'UTC');

            // Test DST detection
            $isDst = DstHelper::isDstTransition(2024, 3, 10, 2, 30, 0, 'America/New_York');

            // Test same moment verification
            $isSame = DstHelper::isSameMoment($date, $utcDate);
        }

        $end = microtime(true);
        $duration = $end - $start;

        // Should complete within reasonable time for 100 iterations
        $this->assertLessThan(1.0, $duration, 'DST operations should be performant');
    }
}
