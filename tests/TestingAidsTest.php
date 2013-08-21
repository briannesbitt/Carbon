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

   public function testConstructorWithTestValueSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, new Carbon());
      $this->assertEquals($notNow, new Carbon(null));
      $this->assertEquals($notNow, new Carbon(''));
      $this->assertEquals($notNow, new Carbon('now'));
   }

   public function testNowWithTestValueSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, Carbon::now());
   }

   public function testParseWithTestValueSet()
   {
      $notNow = Carbon::yesterday();
      Carbon::setTestNow($notNow);

      $this->assertEquals($notNow, Carbon::parse());
      $this->assertEquals($notNow, Carbon::parse(null));
      $this->assertEquals($notNow, Carbon::parse(''));
      $this->assertEquals($notNow, Carbon::parse('now'));
   }
}
