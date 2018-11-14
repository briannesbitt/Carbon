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

class JsonSerializationTest extends AbstractTestCase
{
    /**
     * @var \Carbon\Carbon
     */
    protected $now;

    public function setUp()
    {
        parent::setUp();

        Carbon::setTestNow($this->now = Carbon::create(2017, 6, 27, 13, 14, 15, 'UTC'));
    }

    public function tearDown()
    {
        Carbon::setTestNow();
        Carbon::serializeUsing(null);

        parent::tearDown();
    }

    public function testCarbonAllowsCustomSerializer()
    {
        $this->requirePhpVersion('5.4.0');

        Carbon::serializeUsing(function (Carbon $carbon) {
            return $carbon->getTimestamp();
        });

        $result = json_decode(json_encode($this->now), true);

        $this->assertSame(1498569255, $result);
    }

    public function testCarbonCanSerializeToJson()
    {
        $this->requirePhpVersion('5.4.0');

        $this->assertSame(array(
            'date' => '2017-06-27 13:14:15.000000',
            'timezone_type' => 3,
            'timezone' => 'UTC',
        ), $this->now->jsonSerialize());
    }
}
