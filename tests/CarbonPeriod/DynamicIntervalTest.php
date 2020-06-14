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
use Tests\AbstractTestCase;

class DynamicIntervalTest extends AbstractTestCase
{
    public function testDynamicIntervalInPeriod()
    {
        $weekDayStep = function (Carbon $date, bool $negated = false): Carbon {
            if ($negated) {
                return $date->previousWeekDay();
            }

            return $date->nextWeekDay();
        };
        $period = CarbonPeriod::create('2020-06-01', $weekDayStep, '2020-06-14');
        $dates = [];

        foreach ($period as $date) {
            $dates[] = $date->day;
        }

        $this->assertSame(10, count($period));
        $this->assertSame(array_merge(range(1, 5), range(8, 12)), $dates);
    }
}
