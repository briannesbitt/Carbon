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

class ConstructTest extends TestFixture
{
   public function testCreatesAnInstanceDefaultToNow()
   {
      $c = new Carbon();
      $now = Carbon::now();
      $this->assertEquals('Carbon\Carbon', get_class($c));
      $this->assertEquals($now->tzName, $c->tzName);
      $this->assertCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
   }

   public function testWithFancyString()
   {
      $c = new Carbon('first day of January 2008');
      $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
   }

   public function testDefaultTimezone()
   {
      $c = new Carbon('now');
      $this->assertSame('America/Toronto', $c->tzName);
   }

   public function testSettingTimezone()
   {
      $c = new Carbon('now', new \DateTimeZone('Europe/London'));
      $this->assertSame('Europe/London', $c->tzName);
      $this->assertSame(1, $c->offsetHours);
   }

   public function testSettingTimezoneWithString()
   {
      $c = new Carbon('now', 'Asia/Tokyo');
      $this->assertSame('Asia/Tokyo', $c->tzName);
      $this->assertSame(9, $c->offsetHours);
   }
}
