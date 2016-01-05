<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class ArraysTest extends AbstractTestCase
{

    public function testToArray()
    {
        $expectedArrayKeys = array('year', 'month', 'day', 'dayOfWeek', 'dayOfYear', 'hour', 'minute', 'second');
        $dt = Carbon::now();
        $dtToArray = $dt->toArray();

        foreach ($expectedArrayKeys as $key) {
            // key is exist, value is exists in Carbon object
            $this->assertArrayHasKey($key, $dtToArray);
            if ('formatted' == $key) {
                $this->assertEquals($dt->format(Carbon::DEFAULT_TO_STRING_FORMAT), $dtToArray[$key]);
            } else {
                $this->assertEquals($dt->{$key}, $dtToArray[$key]);
            }
        }
    }

}
