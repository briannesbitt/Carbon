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

class CopyTest extends TestFixture
{
   public function testCopy()
   {
      $dating = Carbon::now();
      $dating2 = $dating->copy();
      $this->assertNotSame($dating, $dating2);
   }

   public function testCopyEnsureTzIsCopied()
   {
      $dating = Carbon::createFromDate(2000, 1, 1, 'Europe/London');
      $dating2 = $dating->copy();
      $this->assertSame($dating->tzName, $dating2->tzName);
      $this->assertSame($dating->offset, $dating2->offset);
   }
}
