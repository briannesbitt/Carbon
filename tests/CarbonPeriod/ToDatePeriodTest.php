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
        $result = CarbonPeriod::create('2021-01-05', '2021-02-15', CarbonPeriod::EXCLUDE_END_DATE)->toDatePeriod();

        $this->assertSame('DatePeriod', get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-15', $result->getEndDate()->format('Y-m-d'));
        $dates = iterator_to_array($result);
        $this->assertSame('2021-02-14', end($dates)->format('Y-m-d'));

        $result = CarbonPeriod::create('2021-01-05', 3)->toDatePeriod();

        $this->assertSame('DatePeriod', get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertNull($result->getEndDate());
        $dates = iterator_to_array($result);
        $this->assertSame('2021-01-08', end($dates)->format('Y-m-d'));
    }
}
