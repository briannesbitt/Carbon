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

use Carbon\CarbonInterval;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class RoundingTest extends AbstractTestCase
{
    public function testThrowsExceptionForCompositeInterval()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Rounding is only possible with single unit intervals.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::days(2)->round('2 hours 50 minutes');
    }

    public function testFloor()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->floor();

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 00:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 00:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->floor();

        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->floor();

        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 02:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->floor('hour');

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '140 minutes')->floor('hour');

        $this->assertSame('00 02:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->floor(CarbonInterval::minutes(15));

        $this->assertSame('2019-02-01 12:45:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->floorUnit('minute', 10);

        $this->assertSame('2019-02-01 12:50:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:10:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->floorMinutes(10);

        $this->assertSame('2019-02-01 12:50:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:10:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));
    }

    public function testCeil()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->ceil();

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-02 00:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-13 00:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->ceil();

        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 04:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->ceil();

        $this->assertSame('2019-02-01 14:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 04:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->ceil('hour');

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 04:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '140 minutes')->ceil('hour');

        $this->assertSame('00 03:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 04:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->ceil(CarbonInterval::minutes(15));

        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:15:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->ceilUnit('minute', 10);

        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:20:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->ceilMinutes(10);

        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:20:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));
    }

    public function testRound()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->round();

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-02 00:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 00:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->round();

        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->round();

        $this->assertSame('2019-02-01 12:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 04:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817')->round('hour');

        $this->assertSame('01 00:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '140 minutes')->round('hour');

        $this->assertSame('00 02:00:00.000000', $period->getDateInterval()->format('%D %H:%I:%S.%F'));
        $this->assertSame('2019-02-01 13:00:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:00:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '1 hour')->round(CarbonInterval::minutes(15));

        $this->assertSame('2019-02-01 12:45:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:15:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->roundUnit('minute', 10);

        $this->assertSame('2019-02-01 12:50:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:10:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23', '2019-12-12 03:12:44.817', '2 hours')->roundMinutes(10);

        $this->assertSame('2019-02-01 12:50:00.000000', $period->getStartDate()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-12-12 03:10:00.000000', $period->getEndDate()->format('Y-m-d H:i:s.u'));
    }

    public function testRoundCalculatedEnd()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2019-02-01 12:52:23.123456', '3 hours')->setRecurrences(3);

        $this->assertSame('2019-02-01 18:00:00.000000', $period->calculateEnd('round')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-02-01 18:52:23.123456', $period->calculateEnd()->format('Y-m-d H:i:s.u'));

        $period = $periodClass::create('2019-02-01 12:52:23.123456', '3 hours')
            ->setRecurrences(3)
            ->addFilter(function ($date) {
                return $date->hour % 2;
            });

        $this->assertSame('2019-02-02 03:00:00.000000', $period->calculateEnd('round')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-02-02 03:52:23.123456', $period->calculateEnd()->format('Y-m-d H:i:s.u'));
    }
}
