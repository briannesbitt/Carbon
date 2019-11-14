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
namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class CreateFromFormatTest extends AbstractTestCase
{
    public function testDefaults()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Data missing');
        CarbonInterval::createFromFormat('H:i:s', '');
    }

    public function testNulls()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Data missing');
        CarbonInterval::createFromFormat('H:i:s', null);
    }

    public function testYears()
    {
        $ci = CarbonInterval::createFromFormat('Y', '1');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::createFromFormat('Y', '2');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 0, 0, 0, 0, 0);
    }

    public function testMonths()
    {
        $ci = CarbonInterval::createFromFormat('m', '1');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 1, 0, 0, 0, 0);

        $ci = CarbonInterval::createFromFormat('m', '2');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 2, 0, 0, 0, 0);
    }

    public function testDays()
    {
        $ci = CarbonInterval::createFromFormat('d', '1');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 1, 0, 0, 0);

        $ci = CarbonInterval::createFromFormat('d', '2');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 2, 0, 0, 0);
    }

    public function testHours()
    {
        $ci = CarbonInterval::createFromFormat('H', '1');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 1, 0, 0);

        $ci = CarbonInterval::createFromFormat('H', '2');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 2, 0, 0);
    }

    public function testMinutes()
    {
        $ci = CarbonInterval::createFromFormat('i', '01');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 1, 0);

        $ci = CarbonInterval::createFromFormat('i', '02');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 2, 0);
    }

    public function testSeconds()
    {
        $ci = CarbonInterval::createFromFormat('s', '01');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 1);

        $ci = CarbonInterval::createFromFormat('s', '02');
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 2);
    }

    public function testMicroseconds()
    {
        $ci = CarbonInterval::createFromFormat('u', '100000');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0, 100000);
        $this->assertSame(2, $ci->microseconds);

        $ci = CarbonInterval::createFromFormat('u', '200000');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0, 200000);
    }

    public function testAll()
    {
        $ci = CarbonInterval::createFromFormat('Y-m-d H:i:s.u', '2000-01-02 3:04:05.500000');
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2000, 1, 2, 3, 4, 5, 500000);
    }

    public function testCopy()
    {
        $one = CarbonInterval::createFromFormat('H:i:s', '10:10:10');
        $two = $one->copy()->hours(3)->minutes(3)->seconds(3);
        $this->assertCarbonInterval($one, 0, 0, 0, 10, 10, 10);
        $this->assertCarbonInterval($two, 0, 0, 0, 3, 3, 3);
    }
}
