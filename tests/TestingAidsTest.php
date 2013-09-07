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
	  
	  $this->assertEquals('2013-09-02', Carbon::parse('tomorrow')->toDateString());
	  $this->assertEquals('2013-08-31', Carbon::parse('yesterday')->toDateString());
	  
	  $this->assertEquals('2013-09-02', Carbon::parse('+1 day')->toDateString());
	  $this->assertEquals('2013-08-31', Carbon::parse('-1 day')->toDateString());
	  
	  $this->assertEquals('2013-09-02', Carbon::parse('next monday')->toDateString());
	  $this->assertEquals('2013-09-03', Carbon::parse('next tuesday')->toDateString());
	  $this->assertEquals('2013-09-04', Carbon::parse('next wednesday')->toDateString());
	  $this->assertEquals('2013-09-05', Carbon::parse('next thursday')->toDateString());
	  $this->assertEquals('2013-09-06', Carbon::parse('next friday')->toDateString());
	  $this->assertEquals('2013-09-07', Carbon::parse('next saturday')->toDateString());
	  $this->assertEquals('2013-09-08', Carbon::parse('next sunday')->toDateString());
	  
	  $this->assertEquals('2013-08-26', Carbon::parse('last monday')->toDateString());
	  $this->assertEquals('2013-08-27', Carbon::parse('last tuesday')->toDateString());
	  $this->assertEquals('2013-08-28', Carbon::parse('last wednesday')->toDateString());
	  $this->assertEquals('2013-08-29', Carbon::parse('last thursday')->toDateString());
	  $this->assertEquals('2013-08-30', Carbon::parse('last friday')->toDateString());
	  $this->assertEquals('2013-08-31', Carbon::parse('last saturday')->toDateString());
	  $this->assertEquals('2013-08-25', Carbon::parse('last sunday')->toDateString());
	  
	  $this->assertEquals('2013-09-02', Carbon::parse('this monday')->toDateString());
	  $this->assertEquals('2013-09-03', Carbon::parse('this tuesday')->toDateString());
	  $this->assertEquals('2013-09-04', Carbon::parse('this wednesday')->toDateString());
	  $this->assertEquals('2013-09-05', Carbon::parse('this thursday')->toDateString());
	  $this->assertEquals('2013-09-06', Carbon::parse('this friday')->toDateString());
	  $this->assertEquals('2013-09-07', Carbon::parse('this saturday')->toDateString());
	  $this->assertEquals('2013-09-01', Carbon::parse('this sunday')->toDateString());
	  
	  $this->assertEquals('2013-10-01', Carbon::parse('first day of next month')->toDateString());
	  $this->assertEquals('2013-09-30', Carbon::parse('last day of this month')->toDateString());
   }
}
