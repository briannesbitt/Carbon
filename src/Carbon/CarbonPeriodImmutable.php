<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

class CarbonPeriodImmutable extends CarbonPeriod
{
    /**
     * Default date class of iteration items.
     *
     * @var string
     */
    protected const DEFAULT_DATE_CLASS = CarbonImmutable::class;

    /**
     * Date class of iteration items.
     *
     * @var string
     */
    protected $dateClass = CarbonImmutable::class;

    /**
     * Prepare the instance to be set (self if mutable to be mutated,
     * copy if immutable to generate a new instance).
     *
     * @return static
     */
    protected function copyIfImmutable()
    {
        return $this->constructed ? clone $this : $this;
    }
}
