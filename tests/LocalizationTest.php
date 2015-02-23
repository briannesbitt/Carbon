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
use Carbon\CarbonDiffFormatters;

class LocalizationTest extends TestFixture
{
   public function testDiffForHumansLocalisationFr()
   {
   	$d = Carbon::now()->subYears(2);
      $this->assertSame('2 ans après', Carbon::now()->diffForHumans($d, CarbonDiffFormatters::fr()));
      $d = Carbon::now()->addDay();
      $this->assertSame('1 jour avant', Carbon::now()->diffForHumans($d, CarbonDiffFormatters::fr()));
      $d = Carbon::now()->subMinutes(30);
      $this->assertSame('il y a 30 minutes', $d->diffForHumans(null, CarbonDiffFormatters::fr()));
      $d = Carbon::now()->addYears(10);
      $this->assertSame('10 ans à partir de maintenant', $d->diffForHumans(null, CarbonDiffFormatters::fr()));
   }
}

