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

namespace Tests\Carbon;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Tests\AbstractTestCase;

class MinuteTest extends AbstractTestCase
{
    public function testMinuteOfDayGetter()
    {
        $cases = [
            ['2023-10-23 00:00:00',0],
            ['2023-10-23 04:00:00',4 * CarbonInterface::MINUTES_PER_HOUR],
            ['2023-10-23 12:00:00',12 * CarbonInterface::MINUTES_PER_HOUR],
            ['2023-10-23 17:00:00',17 * CarbonInterface::MINUTES_PER_HOUR],
            ['2023-10-23 23:00:00',23 * CarbonInterface::MINUTES_PER_HOUR],
            ['2023-10-23 00:01:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 1],
            ['2023-10-23 00:02:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 2],
            ['2023-10-23 00:05:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 5],
            ['2023-10-23 00:30:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 30],
            ['2023-10-23 00:45:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 45],
            ['2023-10-23 00:59:00',(0 * CarbonInterface::MINUTES_PER_HOUR) + 59],
            ['2023-10-23 04:01:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 1],
            ['2023-10-23 04:02:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 2],
            ['2023-10-23 04:05:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 5],
            ['2023-10-23 04:30:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 30],
            ['2023-10-23 04:45:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 45],
            ['2023-10-23 04:59:00',(4 * CarbonInterface::MINUTES_PER_HOUR) + 59],
            ['2023-10-23 12:01:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 1],
            ['2023-10-23 12:02:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 2],
            ['2023-10-23 12:05:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 5],
            ['2023-10-23 12:30:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 30],
            ['2023-10-23 12:45:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 45],
            ['2023-10-23 12:59:00',(12 * CarbonInterface::MINUTES_PER_HOUR) + 59],
            ['2023-10-23 23:01:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 1],
            ['2023-10-23 23:02:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 2],
            ['2023-10-23 23:05:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 5],
            ['2023-10-23 23:30:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 30],
            ['2023-10-23 23:45:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 45],
            ['2023-10-23 23:59:00',(23 * CarbonInterface::MINUTES_PER_HOUR) + 59],
        ];
        foreach ($cases as $case) {
            $date = Carbon::parse($case[0]);
            $this->assertSame($case[1], $date->minuteOfDay());
        }
    }

    public function testMinuteOfDaySetter()
    {
        $cases = [
            ['2023-10-23 00:00:00',0,'2023-10-23 00:00:00'],
            ['2023-10-23 00:00:00',10,'2023-10-23 00:10:00'],
            ['2023-10-23 12:20:00',755,'2023-10-23 12:35:00'],
            ['2023-10-23 12:20:00',840,'2023-10-23 14:00:00'],
            ['2023-10-23 23:59:00',1461,'2023-10-24 00:21:00'],
            ['2023-10-23 23:00:00',4321,'2023-10-26 00:01:00'],
            ['2023-10-23 12:20:00',-100,'2023-10-23 12:20:00'],
            ['2023-10-23 12:20:00','aa','2023-10-23 12:20:00'],
        ];
        foreach ($cases as $case) {
            $date = Carbon::parse($case[0]);
            $date->minuteOfDay($case[1]);
            $this->assertSame(Carbon::parse($case[2])->toDateTimeString(), $date->toDateTimeString());
        }
    }
}
