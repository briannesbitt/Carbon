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

class ToStringTest extends AbstractTestCase
{
    public function testDefault()
    {
        CarbonInterval::setLocale('en');
        $ci = CarbonInterval::create(11, 1, 2, 5, 22, 33, 55);
        $this->assertSame('11 years 1 month 2 weeks 5 days 22 hours 33 minutes 55 seconds:abc', $ci.':abc');
    }

    public function testDefaultWithMicroseconds()
    {
        CarbonInterval::setLocale('en');
        $ci = CarbonInterval::create(11, 1, 2, 5, 22, 33, 55, 12345);
        $this->assertSame('11 years 1 month 2 weeks 5 days 22 hours 33 minutes 55 seconds:abc', $ci.':abc');
    }

    public function testOverrideSimple()
    {
        $ci = CarbonInterval::create(0, 0, 0, 0, 22, 33, 55);
        $ci->settings(['toStringFormat' => '%H:%I:%S']);
        $this->assertSame('22:33:55:abc', $ci.':abc');
    }

    public function testOverrideWithMicroseconds()
    {
        $ci = CarbonInterval::create(11, 1, 2, 5, 22, 33, 55, 12345);
        $ci->settings(['toStringFormat' => '%R%Y-%M-%D %H:%I:%S.%F']);
        $this->assertSame('+11-01-19 22:33:55.012345:abc', $ci.':abc');
    }

    public function testOverrideWithInvert()
    {
        $ci = CarbonInterval::create(11, 1, 2, 5, 22, 33, 55)->invert();
        $ci->settings(['toStringFormat' => '%R%Y-%M-%D %H:%I:%S']);
        $this->assertSame('-11-01-19 22:33:55:abc', $ci.':abc');
    }

    public function testClosure()
    {
        $ci = CarbonInterval::create(11);
        $this->assertSame('11 years:abc', $ci.':abc');
        CarbonInterval::setToStringFormat('%Y');
        $this->assertSame('11:abc', $ci.':abc');
        $ci->settings(['toStringFormat' => static function (CarbonInterval $interval) {
            return 'Y'.($interval->years * 2);
        }]);
        $this->assertSame('Y22:abc', $ci.':abc');

        CarbonInterval::resetToStringFormat();
    }
}
