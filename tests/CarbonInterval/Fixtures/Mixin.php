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

namespace Tests\CarbonInterval\Fixtures;

use Carbon\CarbonInterval;

class Mixin
{
    public $factor;

    public function setFactor()
    {
        $mixin = $this;

        return function ($factor) use ($mixin) {
            $mixin->factor = $factor;
        };
    }

    public function doMultiply()
    {
        $mixin = $this;

        return function () use ($mixin) {
            /** @var CarbonInterval $interval */
            $interval = $this;

            return $interval->times($mixin->factor);
        };
    }
}
