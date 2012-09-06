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

class GettersTest extends TestFixture
{
   public function testGettersThrowExceptionOnUnknownGetter()
   {
      $this->setExpectedException('InvalidArgumentException');
      Carbon::create(1234, 5, 6, 7, 8, 9)->sdfsdfss;
   }
   public function testYearGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(1234, $d->year);
   }
   public function testMonthGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(5, $d->month);
   }
   public function testDayGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(6, $d->day);
   }
   public function testHourGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(7, $d->hour);
   }
   public function testMinuteGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(8, $d->minute);
   }
   public function testSecondGetter()
   {
      $d = Carbon::create(1234, 5, 6, 7, 8, 9);
      $this->assertSame(9, $d->second);
   }
   public function testDayOfWeeGetter()
   {
      $d = Carbon::create(2012, 5, 7, 7, 8, 9);
      $this->assertSame(Carbon::MONDAY, $d->dayOfWeek);
   }
   public function testDayOfYearGetter()
   {
      $d = Carbon::createFromDate(2012, 5, 7);
      $this->assertSame(127, $d->dayOfYear);
   }
   public function testDaysInMonthGetter()
   {
      $d = Carbon::createFromDate(2012, 5, 7);
      $this->assertSame(31, $d->daysInMonth);
   }
   public function testTimestampGetter()
   {
      $d = Carbon::create();
      $d->setTimezone('GMT');
      $this->assertSame(0, $d->setDateTime(1970, 1, 1, 0, 0, 0)->timestamp);
   }

   public function testGetAge()
   {
      $d = Carbon::now();
      $this->assertSame(0, $d->age);
   }
   public function testGetAgeWithRealAge()
   {
      $d = Carbon::createFromDate(1975, 5, 21);
      $age = intval(substr(date('Ymd') - date('Ymd', $d->timestamp), 0, -4));

      $this->assertSame($age, $d->age);
   }

   public function testGetQuarterFirst()
   {
      $d = Carbon::createFromDate(2012, 1, 1);
      $this->assertSame(1, $d->quarter);
   }
   public function testGetQuarterFirstEnd()
   {
      $d = Carbon::createFromDate(2012, 3, 31);
      $this->assertSame(1, $d->quarter);
   }
   public function testGetQuarterSecond()
   {
      $d = Carbon::createFromDate(2012, 4, 1);
      $this->assertSame(2, $d->quarter);
   }
   public function testGetQuarterThird()
   {
      $d = Carbon::createFromDate(2012, 7, 1);
      $this->assertSame(3, $d->quarter);
   }
   public function testGetQuarterFourth()
   {
      $d = Carbon::createFromDate(2012, 10, 1);
      $this->assertSame(4, $d->quarter);
   }
   public function testGetQuarterFirstLast()
   {
      $d = Carbon::createFromDate(2012, 12, 31);
      $this->assertSame(4, $d->quarter);
   }

   public function testGetDstFalse()
   {
      $this->assertFalse(Carbon::createFromDate(2012, 1, 1, 'America/Toronto')->dst);
   }
   public function testGetDstTrue()
   {
      $this->assertTrue(Carbon::createFromDate(2012, 7, 1, 'America/Toronto')->dst);
   }

   public function testOffsetForTorontoWithDST()
   {
      $this->assertSame(-18000, Carbon::createFromDate(2012, 1, 1, 'America/Toronto')->offset);
   }
   public function testOffsetForTorontoNoDST()
   {
      $this->assertSame(-14400, Carbon::createFromDate(2012, 6, 1, 'America/Toronto')->offset);
   }
   public function testOffsetForGMT()
   {
      $this->assertSame(0, Carbon::createFromDate(2012, 6, 1, 'GMT')->offset);
   }
   public function testOffsetHoursForTorontoWithDST()
   {
      $this->assertSame(-5, Carbon::createFromDate(2012, 1, 1, 'America/Toronto')->offsetHours);
   }
   public function testOffsetHoursForTorontoNoDST()
   {
      $this->assertSame(-4, Carbon::createFromDate(2012, 6, 1, 'America/Toronto')->offsetHours);
   }
   public function testOffsetHoursForGMT()
   {
      $this->assertSame(0, Carbon::createFromDate(2012, 6, 1, 'GMT')->offsetHours);
   }

   public function testIsLeapYearTrue()
   {
      $this->assertTrue(Carbon::createFromDate(2012, 1, 1)->isLeapYear());
   }
   public function testIsLeapYearFalse()
   {
      $this->assertFalse(Carbon::createFromDate(2011, 1, 1)->isLeapYear());
   }

   public function testWeekOfYearFirstWeek()
   {
      $this->assertSame(52, Carbon::createFromDate(2012, 1, 1)->weekOfYear);
      $this->assertSame(1, Carbon::createFromDate(2012, 1, 2)->weekOfYear);
   }
   public function testWeekOfYearLastWeek()
   {
      $this->assertSame(52, Carbon::createFromDate(2012, 12, 30)->weekOfYear);
      $this->assertSame(1, Carbon::createFromDate(2012, 12, 31)->weekOfYear);
   }

   public function testGetTimezone()
   {
      $dt = Carbon::createFromDate(2000, 1, 1, 'America/Toronto');
      $this->assertSame('America/Toronto', $dt->timezone->getName());
   }
   public function testGetTz()
   {
      $dt = Carbon::createFromDate(2000, 1, 1, 'America/Toronto');
      $this->assertSame('America/Toronto', $dt->tz->getName());
   }
   public function testGetTimezoneName()
   {
      $dt = Carbon::createFromDate(2000, 1, 1, 'America/Toronto');
      $this->assertSame('America/Toronto', $dt->timezoneName);
   }
   public function testGetTzName()
   {
      $dt = Carbon::createFromDate(2000, 1, 1, 'America/Toronto');
      $this->assertSame('America/Toronto', $dt->tzName);
   }

   public function testInvalidGetter()
   {
      $this->setExpectedException('InvalidArgumentException');
      $d = Carbon::now();
      $bb = $d->doesNotExit;
   }
}
