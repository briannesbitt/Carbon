<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Exceptions;

use Throwable;

class BadComparisonUnitException extends UnitException
{
    /**
     * Constructor.
     *
     * @param string         $unit
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($unit, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Bad comparison unit: '$unit'", $code, $previous);
    }
}
