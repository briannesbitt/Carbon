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

class StartEndOfTest extends TestFixture
{
   public function testStartOfDay()
   {
      $dt = Carbon::now();
      $this->assertTrue($dt->startOfDay() instanceof Carbon);
      $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 0, 0, 0);
   }
   public function testEndOfDay()
   {
      $dt = Carbon::now();
      $this->assertTrue($dt->endOfDay() instanceof Carbon);
      $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 23, 59, 59);
   }

   public function testStartOfMonthIsFluid()
   {
      $dt = Carbon::now();
      $this->assertTrue($dt->startOfMonth() instanceof Carbon);
   }
   public function testStartOfMonthFromNow()
   {
      $dt = Carbon::now()->startOfMonth();
      $this->assertCarbon($dt, $dt->year, $dt->month, 1, 0, 0, 0);
   }
   public function testStartOfMonthFromLastDay()
   {
      $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
      $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
   }

   public function testEndOfMonthIsFluid()
   {
      $dt = Carbon::now();
      $this->assertTrue($dt->endOfMonth() instanceof Carbon);
   }
   public function testEndOfMonth()
   {
      $dt = Carbon::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
      $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
   }
   public function testEndOfMonthFromLastDay()
   {
      $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
      $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
   }
}
