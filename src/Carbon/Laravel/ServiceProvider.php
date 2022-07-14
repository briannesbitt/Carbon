<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Laravel;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;
use Illuminate\Support\Carbon as IlluminateCarbon;
use Illuminate\Support\Facades\Date;
use Throwable;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->forApp(function ($app) {
            $this->updateLocale($app);

            if (!$app->bound('events')) {
                return;
            }

            $service = $this;
            $events = $app['events'];

            if ($this->isEventDispatcher($events)) {
                $events->listen(class_exists('Illuminate\Foundation\Events\LocaleUpdated') ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed', function () use ($service, $app) {
                    $service->updateLocale($app);
                });
            }
        });
    }

    public function updateLocale($app = null)
    {
        $app = $app ?? $this->app;
        $app = $app && method_exists($app, 'getLocale') ? $app : app('translator');
        $locale = $app->getLocale();
        Carbon::setLocale($locale);
        CarbonImmutable::setLocale($locale);
        CarbonPeriod::setLocale($locale);
        CarbonInterval::setLocale($locale);

        if (class_exists(IlluminateCarbon::class)) {
            IlluminateCarbon::setLocale($locale);
        }

        if (class_exists(Date::class)) {
            try {
                $root = Date::getFacadeRoot();
                $root->setLocale($locale);
            } catch (Throwable $e) {
                // Non Carbon class in use in Date facade
            }
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

    private function forApp(callable $callback)
    {
        $callback($this->app);

        $app = method_exists(Container::class, 'getInstance') ? Container::getInstance() : null;

        if ($app && $app !== $this->app) {
            $callback($app);
        }
    }
}
