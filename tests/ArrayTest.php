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

class ArrayTest extends TestFixture
{
   public function testToArray()
   {
      $array = array(
         'date' => array(
            'year' => 2013,
            'month' => 1,
            'day' => 1,
            'hour' => 11,
            'minute' => 50,
            'second' => 25,
         ),
         'timezone' => array(
            'name' => 'America/Toronto',
         ),
      );
      $this->assertSame(Carbon::create(2013, 1, 1, 11, 50, 25)->toArray(), $array);
   }
}
