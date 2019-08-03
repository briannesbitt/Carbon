<?php

namespace Carbon\Traits;

use InvalidArgumentException;

/**
 * Trait Cast.
 *
 * Utils to cast into an other class.
 */
trait Cast
{
    /**
     * Cast the current instance into the given class.
     *
     * @param string $className The $className::instance() method will be called to cast the current object.
     *
     * @return object
     */
    public function cast(string $className)
    {
        if (!method_exists($className, 'instance')) {
            throw new InvalidArgumentException("$className has not the instance() method needed to cast the date.");
        }

        return $className::instance($this);
    }
}
