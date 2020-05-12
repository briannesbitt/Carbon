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
use InvalidArgumentException as BaseInvalidArgumentException;

class UnknownSetterException extends BaseInvalidArgumentException implements BadMethodCallException
{
    /**
     * Constructor.
     *
     * @param string         $name     setter name
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($name, $code = 0, Exception $previous = null)
    {
        parent::__construct("Unknown setter '$name'", $code, $previous);
    }
}
