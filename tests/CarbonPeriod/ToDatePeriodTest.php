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

use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class ToDatePeriodTest extends AbstractTestCase
{
    public function testToArrayIsNotEmptyArray()
    {
        $period = CarbonPeriod::create('2021-01-05', '2021-02-15');
        $result = $period->toDatePeriod();

        $this->assertFalse($period->isEndExcluded());
        $this->assertSame('DatePeriod', get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-15', $result->getEndDate()->format('Y-m-d'));
        // CarbonPeriod includes end date by default while DatePeriod will always exclude it
        $dates = iterator_to_array($result);
        $this->assertSame('2021-02-14', end($dates)->format('Y-m-d'));
        $this->assertTrue($period->equalTo(CarbonPeriod::instance($result)));

        $period = CarbonPeriod::create('2021-01-05', '2021-02-15', CarbonPeriod::EXCLUDE_END_DATE);
        $result = $period->toDatePeriod();
        $newInstance = CarbonPeriod::instance($result);

        $this->assertTrue($period->isEndExcluded());
        $this->assertSame('DatePeriod', get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-14', $result->getEndDate()->format('Y-m-d'));
        $dates = iterator_to_array($result);
        $this->assertSame('2021-02-13', end($dates)->format('Y-m-d'));
        $this->assertSame('2021-01-05', $newInstance->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-14', $newInstance->getEndDate()->format('Y-m-d'));

        $period = CarbonPeriod::create('2021-01-05', 3);
        $result = $period->toDatePeriod();
        $newInstance = CarbonPeriod::instance($result);

        $this->assertSame('DatePeriod', get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertNull($result->getEndDate());
        $dates = iterator_to_array($result);
        $this->assertSame('2021-01-08', end($dates)->format('Y-m-d'));
        $this->assertSame('2021-01-05', $newInstance->getStartDate()->format('Y-m-d'));
        $this->assertSame(3, $newInstance->getRecurrences());
    }
}
