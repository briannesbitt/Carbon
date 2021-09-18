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
use RuntimeException as BaseRuntimeException;

class ImmutableException extends BaseRuntimeException implements RuntimeException
{
    /**
     * Constructor.
     *
     * @param string         $value    the immutable type/value
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($value, $code = 0, Exception $previous = null)
    {
        parent::__construct("$value is immutable.", $code, $previous);
    }
}
