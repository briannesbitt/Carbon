<?php
declare(strict_types=1);

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonTimeZone;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use DateTimeZone;
use InvalidArgumentException;
use stdClass;
use Tests\AbstractTestCase;

class ConversionsTest extends AbstractTestCase
{
    protected $oldNow = true;

    public function testToString()
    {
        $this->assertSame('+06:00', strval(new CarbonTimeZone(6)));
        $this->assertSame('Europe/Paris', strval(new CarbonTimeZone('Europe/Paris')));
    }

    public function testToRegionName()
    {
        $this->assertSame('America/Chicago', (new CarbonTimeZone(-5))->toRegionName());
        $this->assertSame('America/Toronto', (new CarbonTimeZone('America/Toronto'))->toRegionName());
        $this->assertSame('America/New_York', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone()->toRegionName());
        $this->assertFalse((new CarbonTimeZone(-15))->toRegionName());
        $date = Carbon::parse('2018-12-20');
        $this->assertSame('America/Chicago', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone($date)->toRegionName($date));
    }

    public function testToRegionTimeZone()
    {
        $this->assertSame('America/Chicago', (new CarbonTimeZone(-5))->toRegionTimeZone()->getName());
        $this->assertSame('America/Toronto', (new CarbonTimeZone('America/Toronto'))->toRegionTimeZone()->getName());
        $this->assertSame('America/New_York', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone()->toRegionTimeZone()->getName());
        $date = Carbon::parse('2018-12-20');
        $this->assertSame('America/Chicago', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone($date)->toRegionTimeZone($date)->getName());
    }

    public function testToOffsetName()
    {
        $this->assertSame('-05:00', (new CarbonTimeZone(-5))->toOffsetName());
        $this->assertSame('-04:00', (new CarbonTimeZone('America/Toronto'))->toOffsetName());
        $this->assertSame('-05:00', (new CarbonTimeZone(-5))->toRegionTimeZone()->toOffsetName());
        $date = Carbon::parse('2018-12-20');
        $this->assertSame('-05:00', (new CarbonTimeZone('America/Toronto'))->toOffsetName($date));
        $this->assertSame('-06:00', (new CarbonTimeZone(-5))->toRegionTimeZone($date)->toOffsetName($date));
        $this->assertSame('+00:00', (new CarbonTimeZone('UTC'))->toOffsetName());
        $this->assertSame('+02:00', (new CarbonTimeZone('Europe/Paris'))->toOffsetName());
        $this->assertSame('+05:30', (new CarbonTimeZone('Asia/Calcutta'))->toOffsetName());
    }

    public function testCast()
    {
        /** @var DateTimeZone $tz */
        $tz = (new CarbonTimeZone('America/Toronto'))->cast(DateTimeZone::class);

        $this->assertSame(DateTimeZone::class, get_class($tz));
        $this->assertSame('America/Toronto', $tz->getName());

        $obj = new class extends CarbonTimeZone {
        };
        $class = get_class($obj);

        /** @var DateTimeZone $tz */
        $tz = (new CarbonTimeZone('America/Toronto'))->cast($class);

        $this->assertSame($class, get_class($tz));
        $this->assertSame('America/Toronto', $tz->getName());
    }

    public function testCastException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('stdClass has not the instance() method needed to cast the date.');

        (new CarbonTimeZone('America/Toronto'))->cast(stdClass::class);
    }

    public function testInvalidRegionForOffset()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse((new CarbonTimeZone(-15))->toRegionTimeZone());
        Carbon::useStrictMode(true);
    }

    public function testInvalidRegionForOffsetInStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown timezone for offset -54000 seconds.'
        );

        (new CarbonTimeZone(-15))->toRegionTimeZone();
    }
}
