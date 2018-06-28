<?php

namespace Carbon\Laravel;

use Carbon\Carbon;
use Illuminate\Events\EventDispatcher;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Translation\Translator;
use Illuminate\Translation\Translator as IlluminateTranslator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $service = $this;
        $events = $this->app['events'];
        if ($events instanceof EventDispatcher || $events instanceof Dispatcher) {
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
}
