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

namespace Carbon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

/**
 * Trait Mutability.
 *
 * Utils to know if the current object is mutable or immutable and convert it.
 */
trait Mutability
{
    use Cast;

    /**
     * Returns true if the current class/instance is mutable.
     */
    public static function isMutable(): bool
    {
        return false;
    }

    /**
     * Returns true if the current class/instance is immutable.
     */
    public static function isImmutable(): bool
    {
        return !static::isMutable();
    }

    /**
     * Return a mutable copy of the instance.
     *
     * @return Carbon
     */
    public function toMutable()
    {
        /** @var Carbon $date */
        $date = $this->cast(Carbon::class);

        return $date;
    }

    /**
     * Return a immutable copy of the instance.
     *
     * @return CarbonImmutable
     */
    public function toImmutable()
    {
        /** @var CarbonImmutable $date */
        $date = $this->cast(CarbonImmutable::class);

        return $date;
    }
}
