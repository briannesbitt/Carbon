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

namespace Tests\CarbonImmutable;

use Carbon\Traits\Serialization;
use stdClass;
use Tests\AbstractTestCase;

class SetStateTest extends AbstractTestCase
{
    public function testSteState()
    {
        $obj = new class() {
            use Serialization;

            public static function instance($value)
            {
                return $value;
            }

            public function callSetState($value)
            {
                return static::__set_state($value);
            }
        };

        $data = $obj->callSetState(['foo' => 'bar']);

        $this->assertInstanceOf(stdClass::class, $data);
        $this->assertSame(['foo' => 'bar'], (array) $data);
    }
}
