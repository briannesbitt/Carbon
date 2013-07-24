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

class OffsetTest extends TestFixture
{
   public function testOffsetBasic()
   {
      $lastYear = Carbon::now()->subYear();
      Carbon::offset($lastYear);
      $this->assertSame($lastYear->year, Carbon::now()->year);
      $this->assertSame((int)date('Y')-1, Carbon::now()->year);
      Carbon::offset(null);
      $this->assertSame((int)date('Y'), Carbon::now()->year);
      $theFuture = Carbon::now()->addYears(25);
      Carbon::offset($theFuture);
      $this->assertSame($theFuture->year, Carbon::now()->year);
      $this->assertSame((int)date('Y')+25, Carbon::now()->year);
   }
}
