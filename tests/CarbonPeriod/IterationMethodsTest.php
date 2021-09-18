<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class IterationMethodsTest extends AbstractTestCase
{
    public function testForEach()
    {
        $result = '';
        Carbon::create('2020-12-22')->daysUntil('2020-12-24')->forEach(function (Carbon $date) use (&$result) {
            $result .= $date->diffInDays('2020-12-25')." days before Christmas!\n";
        });

        $this->assertSame("3 days before Christmas!\n".
            "2 days before Christmas!\n".
            "1 days before Christmas!\n", $result, );
    }

    public function testMap()
    {
        $result = iterator_to_array(Carbon::create('2020-12-22')->daysUntil('2020-12-24')->map(function (Carbon $date) {
            return $date->diffInDays('2020-12-25').' days before Christmas!';
        }));

        $this->assertSame([
            '3 days before Christmas!',
            '2 days before Christmas!',
            '1 days before Christmas!',
        ], $result);
    }
}
