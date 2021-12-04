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
    public function testSteState(): void
    {
        $obj = new class(null) {
            use Serialization;

            public function __construct(public mixed $data)
            {
            }

            public static function instance($value): static
            {
                return new static($value);
            }

            public function callSetState($value)
            {
                return static::__set_state($value);
            }
        };

        $data = $obj->callSetState(['foo' => 'bar']);

        $this->assertInstanceOf(\get_class($obj), $data);
        $this->assertInstanceOf(stdClass::class, $data->data);
        $this->assertSame('bar', $data->data->foo);
        $this->assertSame(['foo' => 'bar'], (array) $data->data);
    }
}
