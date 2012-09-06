<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Tests;

use Carbon\Carbon;

class NowTest extends TestFixture
{
   public function testNow()
   {
      $dating = Carbon::now();
      $this->assertSame(time(), $dating->timestamp);
   }
}
