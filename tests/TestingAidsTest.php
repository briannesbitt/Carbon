<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;

class TestingAidsTest extends TestFixture
{
   public function testTestingAidsWithTestNowNotSet()
   {
      Carbon::setTestNow();

      $this->assertFalse(Carbon::hasTestNow());
      $this->assertNull(Carbon::getTestNow());
   }
   public function testTestingAidsWithTestNowSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertTrue(Carbon::hasTestNow());
      $this->assertSame($notNow, Carbon::getTestNow());
   }

   public function testConstructorWithDefaultsAndTestNowSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, new Carbon());
      $this->assertEquals($notNow, new Carbon(null));
   }

   public function testConstructorWithNowStringAndTestNowSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, new Carbon('now'));
   }

   public function testNowWithNowStringAndTestNowSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, Carbon::now());
   }
}
