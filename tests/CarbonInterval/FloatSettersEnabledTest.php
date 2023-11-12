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
use Carbon\CarbonPeriod;
use RuntimeException;
use Tests\AbstractTestCase;

class FloatSettersEnabledTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        CarbonInterval::enableFloatSetters();
    }

    protected function tearDown(): void
    {
        CarbonInterval::enableFloatSetters(false);
        parent::tearDown();
    }

    public function testInheritedConstruct()
    {
        $ci = new CarbonInterval('PT0S');
        $ci->hours(0.5);
        $this->assertSame('PT30M', $ci->spec());

        $ci = new CarbonInterval('P1D');
        $ci->hours(0.5);
        $this->assertSame('P1DT30M', $ci->spec());

        $ci = new CarbonInterval('PT4H');
        $ci->hours(0.5);
        $this->assertSame('PT30M', $ci->spec());

        $period = CarbonPeriod::since('2018-04-21 00:00:00')->hours(0.5)->until('2018-04-21 02:00:00');
        $this->assertSame('2018-04-21 00:30:00', $period->toArray()[1]->format('Y-m-d H:i:s'));

        CarbonInterval::enableFloatSetters(false);
        $ci = new CarbonInterval('PT4H');
        $ci->hours(0.5);
        $this->assertSame('PT0S', $ci->spec());
    }

    public function testOverridePrevention()
    {
        $this->expectExceptionObject(new RuntimeException(
            'You cannot set hour to a float value as minute would be overridden, '.
            'set it first to 0 explicitly if you really want to erase its value'
        ));

        $ci = new CarbonInterval('PT10M');
        $ci->hours(0.5);
    }
}
