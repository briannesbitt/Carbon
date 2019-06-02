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
use DateTimeZone;
use Tests\AbstractTestCase;

class InstanceTest extends AbstractTestCase
{
    public function testInstanceFromDateTime()
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
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
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $micro = 254687;
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($datetime);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testInstanceFromCarbonKeepsMicros()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $micro = 254687;
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($carbon);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testInstanceStateSetBySetStateMethod()
    {
        $carbon = Carbon::__set_state(array(
            'date' => '2017-05-18 13:02:15.273420',
            'timezone_type' => 3,
            'timezone' => 'UTC',
        ));
        $this->assertInstanceOf('Carbon\Carbon', $carbon);
    }

    public function testDeserializationOccursCorrectly()
    {
        $carbon = new Carbon('2017-06-27 13:14:15.000000');
        $serialized = 'return '.var_export($carbon, true).';';
        $deserialized = eval($serialized);

        $this->assertInstanceOf('Carbon\Carbon', $deserialized);
    }

    public function testCast()
    {
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        $myCarbon = $carbon->cast('Tests\\Carbon\\Fixtures\\MyCarbon');

        $this->assertInstanceOf('Tests\\Carbon\\Fixtures\\MyCarbon', $myCarbon);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage DateTimeZone has not the instance() method needed to cast the date.
     */
    public function testInvalidCast()
    {
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        $carbon->cast('DateTimeZone');
    }
}
