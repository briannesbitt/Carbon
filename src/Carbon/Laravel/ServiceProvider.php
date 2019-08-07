<?php

namespace Carbon\Laravel;

use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->updateLocale();

        if (!$this->app->bound('events')) {
            return;
        }

        $service = $this;
        $events = $this->app['events'];

        if ($this->isEventDispatcher($events)) {
            $events->listen(class_exists('Illuminate\Foundation\Events\LocaleUpdated') ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service) {
                $service->updateLocale();
            });
        }
    }

    public function updateLocale()
    {
        $app = $this->app && method_exists($this->app, 'getLocale') ? $this->app : app('translator');
        Carbon::setLocale($app->getLocale());
    }

    public function register()
    {
        // Needed for Laravel < 5.3 compatibility
    }

    protected function isEventDispatcher($instance)
    {
        return $instance instanceof EventDispatcher
            || $instance instanceof Dispatcher
            || $instance instanceof DispatcherContract;
    }
}
