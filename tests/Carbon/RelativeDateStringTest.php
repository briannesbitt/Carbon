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

class RelativeDateStringTest extends AbstractTestCase
{
    public function test_relative_string_without_keywords()
    {
        Carbon::setTestNow('2017-01-01 12:00:00');

        $withKeyword = new Carbon('next sunday');
        $withoutKeyword = new Carbon('sunday');

        $this->assertEquals('2017-01-08', $withKeyword->format('Y-m-d'));
        $this->assertEquals('2017-01-01', $withoutKeyword->format('Y-m-d'));
    }
}
