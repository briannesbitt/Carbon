<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval\Fixtures;

class Mixin
{
    public $factor = null;

    public function setFactor()
    {
        $mixin = $this;

        return function ($factor) use ($mixin) {
            $mixin->factor = $factor;
        };
    }

    public function multiply()
    {
        $mixin = $this;

        return function ($self) use ($mixin) {
            return $self->times($mixin->factor);
        };
    }
}
