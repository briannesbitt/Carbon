<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Exceptions;

use Exception;
use InvalidArgumentException;

class InvalidDateException extends InvalidArgumentException
{
    /**
     * The invalid field.
     *
     * @var string
     */
    private $field;

    /**
     * The invalid value.
     *
     * @var int
     */
    private $value;

    /**
     * Constructor.
     *
     * @param string          $field
     * @param int             $value
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($field, $value, $code = 0, Exception $previous = null)
    {
        $this->setField($field);
        $this->setValue($field);
        parent::__construct($field.' : '.$value.' is not a valid value.', $code, $previous);
    }

    /**
     * @param string $field
     *
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
