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
namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Tests\AbstractTestCase;

class IssetTest extends AbstractTestCase
{
    public function testIssetReturnFalseForUnknownProperty()
    {
        $this->assertFalse(isset(Carbon::create(1234, 5, 6, 7, 8, 9)->sdfsdfss));
    }

    public function providerTestIssetReturnTrueForProperties()
    {
        return [
            ['age'],
            ['day'],
            ['dayOfWeek'],
            ['dayOfYear'],
            ['daysInMonth'],
            ['dst'],
            ['hour'],
            ['local'],
            ['micro'],
            ['minute'],
            ['month'],
            ['offset'],
            ['offsetHours'],
            ['quarter'],
            ['second'],
            ['timestamp'],
            ['timezone'],
            ['timezoneName'],
            ['tz'],
            ['tzName'],
            ['utc'],
            ['weekOfMonth'],
            ['weekOfYear'],
            ['year'],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\IssetTest::providerTestIssetReturnTrueForProperties
     *
     * @param string $property
     */
    public function testIssetReturnTrueForProperties($property)
    {
        $this->assertTrue(isset(Carbon::now()->$property));
    }
}
