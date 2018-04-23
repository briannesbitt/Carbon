<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CallbackFilterIterator extends FilterIterator
{
    /**
     * @var Iterator
     */
    private $iterator;

    /**
     * @var callable
     */
    private $callback;

    public function __construct(Iterator $iterator, $callback)
    {
        $this->iterator = $iterator;
        $this->callback = $callback;
        parent::__construct($iterator);
    }

    /**
     * @return bool|mixed
     */
    public function accept()
    {
        return call_user_func($this->callback, $this->current(), $this->key(), $this->iterator);
    }
}
