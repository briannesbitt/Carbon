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

use Exception;

/**
 * @codeCoverageIgnore
 */
class UnsupportedUnitException extends UnitException
{
    public function __construct(string $unit, string $phpVersion, int $code = 0, Exception $previous = null)
    {
        parent::__construct("Unsupported unit '$unit' on PHP >= $phpVersion.", $code, $previous);
    }
}
