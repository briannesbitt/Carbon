<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod\Fixtures;

class Mixin
{
    public $foo;

    public function setFoo()
    {
        $mixin = $this;

        return function ($value) use ($mixin) {
            $mixin->foo = $value;
        };
    }

    public function getFoo()
    {
        $mixin = $this;

        return function () use ($mixin) {
            return $mixin->foo;
        };
    }
}
