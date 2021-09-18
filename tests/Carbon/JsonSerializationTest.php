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

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCaseWithOldNow;

class JsonSerializationTest extends AbstractTestCaseWithOldNow
{
    public function testCarbonAllowsCustomSerializer()
    {
        Carbon::serializeUsing(function (Carbon $carbon) {
            return $carbon->getTimestamp();
        });

        $result = json_decode(json_encode(Carbon::now()), true);

        $this->assertSame(1498569255, $result);
    }

    public function testCarbonAllowsCustomSerializerString()
    {
        Carbon::serializeUsing('Y-m-d');

        $this->assertSame('"2017-06-27"', json_encode(Carbon::now()));
    }

    public function testCarbonAllowsCustomSerializerViaSettings()
    {
        $date = Carbon::now()->settings([
            'toJsonFormat' => 'H:i:s',
        ]);

        $this->assertSame('"13:14:15"', json_encode($date));
    }

    public function testCarbonCanSerializeToJson()
    {
        $this->assertSame('2017-06-27T13:14:15.000000Z', Carbon::now()->jsonSerialize());
    }
}
