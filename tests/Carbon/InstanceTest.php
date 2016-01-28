<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use StdClass;
use Tests\AbstractTestCase;

class InstanceTest extends AbstractTestCase
{
    /**
     * Data provider for \Tests\Carbon\InstanceTest::testInstanceThrowsAnException
     *
     * @return array
     */
    public function dataProviderTestInstanceThrowsAnException()
    {
        return array(
            array('foo'),
            array(array()),
            array(new StdClass()),
            array(time()),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\InstanceTest::dataProviderTestInstanceThrowsAnException
     * @expectedException \InvalidArgumentException
     *
     * @param mixed $dt
     */
    public function testInstanceThrowsAnException($dt)
    {
        Carbon::instance($dt);
    }

    public function testInstanceFromDateTime()
    {
        $dt = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dt, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeImmutable()
    {
        if (version_compare(PHP_VERSION, '5.5.0') < 0) {
            $this->markTestSkipped('Skipping test with \DateTimeImmutable on PHP < 5.5');
        }

        $immutableDateTime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11');
        $dating = Carbon::instance($immutableDateTime);
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeInterface()
    {
        if (version_compare(PHP_VERSION, '5.5.0') < 0) {
            $this->markTestSkipped('Skipping test with \DateTimeInterface on PHP < 5.5');
        }

        $dt = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertInstanceOf('\DateTimeInterface', $dt);
        $this->assertCarbon($dt, 1975, 5, 21, 22, 32, 11);

        $immutableDateTime = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertInstanceOf('\DateTimeInterface', $immutableDateTime);
        $this->assertCarbon($immutableDateTime, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromCarbon()
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeKeepsTimezoneName()
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11')->setTimezone(new DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromCarbonKeepsTimezoneName()
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11)->setTimezone(new \DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromDateTimeKeepsMicros()
    {
        $micro = 254687;
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($datetime);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testInstanceFromCarbonKeepsMicros()
    {
        $micro = 254687;
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($carbon);
        $this->assertSame($micro, $carbon->micro);
    }
}
