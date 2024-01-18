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

namespace Tests\Factory;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\WrapperClock;
use DateTimeImmutable;
use DateTimeZone;
use Tests\AbstractTestCase;

class WrapperClockTest extends AbstractTestCase
{
    public function testWrapperClock()
    {
        $now = new DateTimeImmutable('now UTC');
        $clock = new WrapperClock($now);

        $this->assertSame($now, $clock->now());
        $this->assertSame($now, $clock->unwrap());

        $carbon = $clock->getFactory()->now();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s e'), $carbon->format('Y-m-d H:i:s e'));

        $carbon = $clock->nowAs(Carbon::class, 'Europe/Berlin');

        $this->assertSame(Carbon::class, $carbon::class);
        $this->assertSame(
            $now->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s e'),
            $carbon->format('Y-m-d H:i:s e'),
        );

        $carbon = $clock->nowAsCarbon();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s e'), $carbon->format('Y-m-d H:i:s e'));

        $clock = new WrapperClock($carbon);

        $this->assertSame($clock->nowAsCarbon(), $carbon);
    }
}
