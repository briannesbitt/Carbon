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
namespace Tests\Carbon;

use Carbon\Carbon;
use Generator;
use Tests\AbstractTestCase;

class IssetTest extends AbstractTestCase
{
    public function testIssetReturnFalseForUnknownProperty()
    {
        $this->assertFalse(isset(Carbon::create(1234, 5, 6, 7, 8, 9)->sdfsdfss));
    }

    public function providerTestIssetReturnTrueForProperties(): Generator
    {
        yield ['age'];
        yield ['day'];
        yield ['dayOfWeek'];
        yield ['dayOfYear'];
        yield ['daysInMonth'];
        yield ['dst'];
        yield ['hour'];
        yield ['local'];
        yield ['micro'];
        yield ['minute'];
        yield ['month'];
        yield ['offset'];
        yield ['offsetHours'];
        yield ['quarter'];
        yield ['second'];
        yield ['timestamp'];
        yield ['timezone'];
        yield ['timezoneName'];
        yield ['tz'];
        yield ['tzName'];
        yield ['utc'];
        yield ['weekOfMonth'];
        yield ['weekOfYear'];
        yield ['year'];
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
