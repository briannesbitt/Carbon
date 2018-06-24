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
        /** @var EventDispatcher $events */
        $events = $this->app['events'];
        $events->listen(version_compare(\App::version(), '5.5') >= 0 ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service) {
            $service->updateLocale();
        });
        $service->updateLocale();
    }

    public function updateLocale()
    {
        /** @var Translator $translator */
        $translator = $this->app['translator'];
        $locale = $translator->getLocale();
        Carbon::setLocale($locale);
    }
}
