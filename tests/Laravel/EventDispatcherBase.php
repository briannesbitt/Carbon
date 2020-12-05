<?php
declare(strict_types=1);

namespace Tests\Laravel;

class EventDispatcherBase
{
    /**
     * @var array
     */
    protected $listeners;

    public function listen($name, $listener)
    {
        if (!isset($this->listeners[$name])) {
            $this->listeners[$name] = [];
        }

        $this->listeners[$name][] = $listener;
    }

    public function dispatch($name, $event = null)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $listener) {
                $listener($event);
            }
        }
    }
}
