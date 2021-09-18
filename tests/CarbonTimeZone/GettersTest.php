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

namespace Tests\CarbonTimeZone;

use Carbon\CarbonTimeZone;
use Tests\AbstractTestCase;

class GettersTest extends AbstractTestCase
{
    public function testGetAbbr()
    {
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('bdst', $tz->getAbbr(true));
        $this->assertSame('bst', $tz->getAbbr(false));
    }

    public function testGetAbbreviatedName()
    {
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('bdst', $tz->getAbbreviatedName(true));
        $this->assertSame('bst', $tz->getAbbreviatedName(false));
    }
}
