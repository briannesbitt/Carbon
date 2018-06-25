<?php

namespace Carbon\Laravel;

use Carbon\Carbon;
use Illuminate\Events\EventDispatcher;
use Symfony\Component\Translation\Translator;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $service = $this;
        if (($events = $this->app['events']) instanceof EventDispatcher) {
            $events->listen(version_compare($this->app->version(), '5.5') >= 0 ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service) {
                $service->updateLocale();
            });
            $service->updateLocale();
        }
    }

    public function updateLocale()
    {
        if (($translator = $this->app['translator']) instanceof Translator) {
            Carbon::setLocale($translator->getLocale());
        }
    }
}
