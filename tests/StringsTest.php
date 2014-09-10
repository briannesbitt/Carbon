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

class MyCarbon extends Carbon {}

class StringsTest extends TestFixture
{
   public function testToString()
   {
      $d = Carbon::now();
      $this->assertSame(Carbon::now()->toDateTimeString(), ''.$d);
   }
   public function testSetToStringFormat()
   {
      Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
   }
   public function testResetToStringFormat()
   {
      $d = Carbon::now();
      Carbon::setToStringFormat('123');
      Carbon::resetToStringFormat();
      $this->assertSame($d->toDateTimeString(), ''.$d);
   }
   public function testExtendedClassToString()
   {
      $d = MyCarbon::now();
      $this->assertSame($d->toDateTimeString(), ''.$d);
   }

   public function testToDateString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25', $d->toDateString());
   }
   public function testToFormattedDateString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Dec 25, 1975', $d->toFormattedDateString());
   }
   public function testToLocalizedFormattedDateString()
   {
      /****************

      Working out a Travis issue on how to set a different locale
      other than EN to test this.


      $cache = setlocale(LC_TIME, 0);
      setlocale(LC_TIME, 'German');
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Donnerstag 25 Dezember 1975', $d->formatLocalized('%A %d %B %Y'));
      setlocale(LC_TIME, $cache);

      *****************/
   }
   public function testToTimeString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('14:15:16', $d->toTimeString());
   }
   public function testToDateTimeString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25 14:15:16', $d->toDateTimeString());
   }
   public function testToDateTimeStringWithPaddedZeroes()
   {
      $d = Carbon::create(2000, 5, 2, 4, 3, 4);
      $this->assertSame('2000-05-02 04:03:04', $d->toDateTimeString());
   }
   public function testToDayDateTimeString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, Dec 25, 1975 2:15 PM', $d->toDayDateTimeString());
   }

   public function testToATOMString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25T14:15:16-05:00', $d->toATOMString());
   }
   public function testToCOOKIEString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      if( \DateTime::COOKIE === 'l, d-M-y H:i:s T' )
          $cookieString = 'Thursday, 25-Dec-75 14:15:16 EST';
      else
          $cookieString = 'Thursday, 25-Dec-1975 14:15:16 EST';

      $this->assertSame($cookieString, $d->toCOOKIEString());
   }
   public function testToISO8601String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25T14:15:16-0500', $d->toISO8601String());
   }
   public function testToRC822String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRFC822String());
   }
   public function testToRFC850String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thursday, 25-Dec-75 14:15:16 EST', $d->toRFC850String());
   }
   public function testToRFC1036String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRFC1036String());
   }
   public function testToRFC1123String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRFC1123String());
   }
   public function testToRFC2822String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRFC2822String());
   }
   public function testToRFC3339String()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25T14:15:16-05:00', $d->toRFC3339String());
   }
   public function testToRSSString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRSSString());
   }
   public function testToW3CString()
   {
      $d = Carbon::create(1975, 12, 25, 14, 15, 16);
      $this->assertSame('1975-12-25T14:15:16-05:00', $d->toW3CString());
   }
}
