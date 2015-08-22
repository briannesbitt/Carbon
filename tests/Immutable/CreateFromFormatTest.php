<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Immutable;

use Carbon\CarbonImmutable;
use TestFixture;

class CreateFromFormatTest extends TestFixture
{

    public function testCreateFromFormatReturnsCarbon()
    {
        $d = CarbonImmutable::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11');
        $this->assertCarbonImmutable($d, 1975, 5, 21, 22, 32, 11);
        $this->assertTrue($d instanceof CarbonImmutable);
    }

    public function testCreateFromFormatWithTimezoneString()
    {
        $d = CarbonImmutable::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11', 'Europe/London');
        $this->assertCarbonImmutable($d, 1975, 5, 21, 22, 32, 11);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromFormatWithTimezone()
    {
        $d = CarbonImmutable::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11', new \DateTimeZone('Europe/London'));
        $this->assertCarbonImmutable($d, 1975, 5, 21, 22, 32, 11);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromFormatWithMillis()
    {
        $d = CarbonImmutable::createFromFormat('Y-m-d H:i:s.u', '1975-05-21 22:32:11.254687');
        $this->assertSame(254687, $d->micro);
    }
}
