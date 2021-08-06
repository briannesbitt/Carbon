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
use Carbon\Translator;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class GettersTest extends AbstractTestCase
{
    public function testGettersThrowExceptionOnUnknownGetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown getter \'doesNotExit\''
        ));

        /** @var mixed $interval */
        $interval = CarbonInterval::year();
        $interval->doesNotExit;
    }

    public function testGet()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(4, $ci->get('years'));
    }

    public function testYearsGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(4, $ci->years);
    }

    public function testMonthsGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(5, $ci->months);
    }

    public function testWeeksGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(6, $ci->weeks);
    }

    public function testDayzExcludingWeeksGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(5, $ci->daysExcludeWeeks);
        $this->assertSame(5, $ci->dayzExcludeWeeks);
    }

    public function testDayzGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(6 * 7 + 5, $ci->dayz);
    }

    public function testHoursGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(8, $ci->hours);
    }

    public function testMinutesGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(9, $ci->minutes);
    }

    public function testSecondsGetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(10, $ci->seconds);
    }

    public function testDebugInfo()
    {
        $ci = CarbonInterval::create(4, 0, 6, 5, 0, 9, 10);

        $this->assertSame([
            'y' => 4,
            'd' => 47,
            'i' => 9,
            's' => 10,
        ], $ci->__debugInfo());

        $ci->locale('it_IT');

        $this->assertSame([
            'localTranslator' => Translator::get('it_IT'),
            'y' => 4,
            'd' => 47,
            'i' => 9,
            's' => 10,
        ], $ci->__debugInfo());
    }
}
