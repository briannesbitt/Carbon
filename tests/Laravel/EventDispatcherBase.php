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

namespace Tests\Laravel;

class EventDispatcherBase
{
    /**
     * @var array
     */
    protected $listeners;

    public function listen($name, $listener)
    {
        $this->listeners[$name] ??= [];
        $this->listeners[$name][] = $listener;
    }

    public function dispatch($name, $event = null)
    {
        foreach (($this->listeners[$name] ?? []) as $listener) {
            $listener($event);
        }
    }
}
