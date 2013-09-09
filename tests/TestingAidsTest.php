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

   public function testParseRelativeWithTestValueSet()
   {
	  $notNow = Carbon::parse('2013-09-01 05:15:05');
	  Carbon::setTestNow($notNow);

	  $this->assertEquals('2013-09-01 05:10:05', Carbon::parse('5 minutes ago')->toDateTimeString());

	  $this->assertEquals('2013-08-25 05:15:05', Carbon::parse('1 week ago')->toDateTimeString());

	  $this->assertEquals('2013-09-02 00:00:00', Carbon::parse('tomorrow')->toDateTimeString());
	  $this->assertEquals('2013-08-31 00:00:00', Carbon::parse('yesterday')->toDateTimeString());

	  $this->assertEquals('2013-09-02 05:15:05', Carbon::parse('+1 day')->toDateTimeString());
	  $this->assertEquals('2013-08-31 05:15:05', Carbon::parse('-1 day')->toDateTimeString());

	  $this->assertEquals('2013-09-02 00:00:00', Carbon::parse('next monday')->toDateTimeString());
	  $this->assertEquals('2013-09-03 00:00:00', Carbon::parse('next tuesday')->toDateTimeString());
	  $this->assertEquals('2013-09-04 00:00:00', Carbon::parse('next wednesday')->toDateTimeString());
	  $this->assertEquals('2013-09-05 00:00:00', Carbon::parse('next thursday')->toDateTimeString());
	  $this->assertEquals('2013-09-06 00:00:00', Carbon::parse('next friday')->toDateTimeString());
	  $this->assertEquals('2013-09-07 00:00:00', Carbon::parse('next saturday')->toDateTimeString());
	  $this->assertEquals('2013-09-08 00:00:00', Carbon::parse('next sunday')->toDateTimeString());

	  $this->assertEquals('2013-08-26 00:00:00', Carbon::parse('last monday')->toDateTimeString());
	  $this->assertEquals('2013-08-27 00:00:00', Carbon::parse('last tuesday')->toDateTimeString());
	  $this->assertEquals('2013-08-28 00:00:00', Carbon::parse('last wednesday')->toDateTimeString());
	  $this->assertEquals('2013-08-29 00:00:00', Carbon::parse('last thursday')->toDateTimeString());
	  $this->assertEquals('2013-08-30 00:00:00', Carbon::parse('last friday')->toDateTimeString());
	  $this->assertEquals('2013-08-31 00:00:00', Carbon::parse('last saturday')->toDateTimeString());
	  $this->assertEquals('2013-08-25 00:00:00', Carbon::parse('last sunday')->toDateTimeString());

	  $this->assertEquals('2013-09-02 00:00:00', Carbon::parse('this monday')->toDateTimeString());
	  $this->assertEquals('2013-09-03 00:00:00', Carbon::parse('this tuesday')->toDateTimeString());
	  $this->assertEquals('2013-09-04 00:00:00', Carbon::parse('this wednesday')->toDateTimeString());
	  $this->assertEquals('2013-09-05 00:00:00', Carbon::parse('this thursday')->toDateTimeString());
	  $this->assertEquals('2013-09-06 00:00:00', Carbon::parse('this friday')->toDateTimeString());
	  $this->assertEquals('2013-09-07 00:00:00', Carbon::parse('this saturday')->toDateTimeString());
	  $this->assertEquals('2013-09-01 00:00:00', Carbon::parse('this sunday')->toDateTimeString());

	  $this->assertEquals('2013-10-01 05:15:05', Carbon::parse('first day of next month')->toDateTimeString());
	  $this->assertEquals('2013-09-30 05:15:05', Carbon::parse('last day of this month')->toDateTimeString());
   }
}
