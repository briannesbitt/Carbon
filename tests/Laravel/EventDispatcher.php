<?php

namespace Illuminate\Events;

class EventDispatcher
{
    /**
     * @var array
     */
    protected $listeners;

    public function listen($name, $listener)
    {
        if (!isset($this->listeners[$name])) {
            $this->listeners[$name] = array();
        }

        $this->listeners[$name][] = $listener;
    }

    public function dispatch($name, $event = null)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $listener) {
                call_user_func($listener, $event);
            }
        }
    }
}
