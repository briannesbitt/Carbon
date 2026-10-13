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
use Closure;
use Tests\AbstractTestCase;

class MemoryLeakTest extends AbstractTestCase
{
    private const ITERATIONS = 2000;

    public function testConstructorDoesNotLeakMemory()
    {
        $periodClass = static::$periodClass;
        $start = Carbon::parse('2026-01-01');
        $end = Carbon::parse('2026-01-31');

        $this->assertNoRetainedMemory(static fn () => new $periodClass($start, $end));
        $this->assertNoRetainedMemory(static fn () => $periodClass::create($start, '1 day', $end));
    }

    public function testIterationDoesNotLeakMemory()
    {
        $periodClass = static::$periodClass;
        $start = Carbon::parse('2026-01-01');
        $end = Carbon::parse('2026-01-31');

        $this->assertNoRetainedMemory(static function () use ($periodClass, $start, $end) {
            foreach (new $periodClass($start, $end) as $date) {
                $date->day;
            }
        });
    }

    public function testSettersDoNotLeakMemory()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass('2026-01-01', '2026-01-31');

        $this->assertNoRetainedMemory(static function () use (&$period) {
            $period = $period->setStartDate('2025-12-01')->setEndDate('2026-02-01');
        });
    }

    private function assertNoRetainedMemory(Closure $useOnePeriod): void
    {
        for ($i = 0; $i < 100; $i++) {
            $useOnePeriod();
        }

        gc_collect_cycles();
        $before = memory_get_usage();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            $useOnePeriod();
        }

        gc_collect_cycles();
        $retainedPerCall = (memory_get_usage() - $before) / self::ITERATIONS;

        $this->assertLessThan(16, $retainedPerCall, "$retainedPerCall bytes retained per period");
    }
}
