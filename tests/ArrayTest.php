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

class ArrayTest extends TestFixture {

	public function testToArray()
	{
		$array = array(
			'datetime' => array(
				'year' => 2013,
				'month' => 1,
				'day' => 1,
				'hour' => 13,
				'minute' => 50,
				'second' => 59,
			),
			'timezone' => array(
				'type' => 3,
				'name' => 'Europe/London',
			),
		);
		$this->assertSame(Carbon::create(2013, 1, 1, 13, 50, 59, 'Europe/London')->toArray(), $array);
	}

}
