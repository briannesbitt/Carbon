<?php

namespace Carbon\Laravel;

use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;
use Illuminate\Translation\Translator as IlluminateTranslator;
use Symfony\Component\Translation\Translator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if (!$this->app->bound('events') || !$this->app->bound('translator')) {
            return;
        }

        $service = $this;
        $events = $this->app['events'];

        if ($this->isEventDispatcher($events)) {
            $events->listen(class_exists('Illuminate\Foundation\Events\LocaleUpdated') ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service) {
                $service->updateLocale();
            });
            $service->updateLocale();
        }
    }

    public function updateLocale()
    {
        $translator = $this->app['translator'];

        if ($translator instanceof Translator || $translator instanceof IlluminateTranslator) {
            Carbon::setLocale($translator->getLocale());
        }
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
