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

use InvalidArgumentException as BaseInvalidArgumentException;
use Throwable;

class UnknownGetterException extends BaseInvalidArgumentException implements InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string         $name     getter name
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($name, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Unknown getter '$name'", $code, $previous);
    }
}
