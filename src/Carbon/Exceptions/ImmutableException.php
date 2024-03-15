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

namespace Carbon\Exceptions;

use RuntimeException as BaseRuntimeException;
use Throwable;

class ImmutableException extends BaseRuntimeException implements RuntimeException
{
    /**
     * The value.
     *
     * @var string
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param string         $value    the immutable type/value
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($value, $code = 0, ?Throwable $previous = null)
    {
        $this->value = $value;
        parent::__construct("$value is immutable.", $code, $previous);
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
