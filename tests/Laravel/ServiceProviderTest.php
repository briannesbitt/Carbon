<?php

declare(strict_types=1);

namespace Tests\Laravel;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;
use PHPUnit\Framework\TestCase;

class ServiceProviderTest extends TestCase
{
    public function getDispatchers()
    {
        if (!class_exists(Dispatcher::class)) {
            include_once __DIR__.'/Dispatcher.php';
        }

        if (!class_exists(EventDispatcher::class)) {
            include_once __DIR__.'/EventDispatcher.php';
        }

        return [
            [new Dispatcher()],
            [new EventDispatcher()],
        ];
    }

    /**
     * @dataProvider getDispatchers
     */
    public function testBoot($dispatcher)
    {
        // Reset language
        Carbon::setLocale('en');
        CarbonImmutable::setLocale('en');
        CarbonPeriod::setLocale('en');
        CarbonInterval::setLocale('en');

        $service = new ServiceProvider($dispatcher);

        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());
        $this->assertSame('en', CarbonInterval::getLocale());
        $service->boot();
        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());
        $this->assertSame('en', CarbonInterval::getLocale());
        $service->app->register();
        $service->boot();
        $this->assertSame('de', Carbon::getLocale());
        $this->assertSame('de', CarbonImmutable::getLocale());
        $this->assertSame('de', CarbonPeriod::getLocale());
        $this->assertSame('de', CarbonInterval::getLocale());
        $service->app->setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
        $this->assertNull($service->register());

        // Reset language
        Carbon::setLocale('en');

        $service->app->removeService('events');
        $this->assertNull($service->boot());
    }

    public function testListenerWithoutLocaleUpdatedClass()
    {
        if (class_exists('Illuminate\Foundation\Events\LocaleUpdated')) {
            $this->markTestSkipped('This test cannot be run with Laravel 5.5 classes available via autoload.');
        }

        $dispatcher = new Dispatcher();
        $service = new ServiceProvider($dispatcher);

        Carbon::setLocale('en');
        CarbonImmutable::setLocale('en');
        CarbonPeriod::setLocale('en');
        CarbonInterval::setLocale('en');

        $service->boot();
        $service->app->register();
        $service->app->setLocaleWithoutEvent('fr');
        $dispatcher->dispatch('locale.changed');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
    }

    public function testListenerWithLocaleUpdatedClass()
    {
        if (!class_exists('Illuminate\Foundation\Events\LocaleUpdated')) {
            eval('namespace Illuminate\Foundation\Events; class LocaleUpdated {}');
        }

        $dispatcher = new Dispatcher();
        $service = new ServiceProvider($dispatcher);

        Carbon::setLocale('en');
        CarbonImmutable::setLocale('en');
        CarbonPeriod::setLocale('en');
        CarbonInterval::setLocale('en');

        $service->boot();
        $service->app->register();
        $service->app->setLocaleWithoutEvent('fr');
        $dispatcher->dispatch('Illuminate\Foundation\Events\LocaleUpdated');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
    }

    public function testUpdateLocale()
    {
        if (class_exists('Illuminate\Support\Carbon')) {
            $this->markTestSkipped('This test cannot be run with Laravel 5.5 classes available via autoload.');
        }

        eval('namespace Illuminate\Support;
        class Carbon
        {
            public static $locale = null;

            public static function setLocale($locale)
            {
                static::$locale = $locale;
            }
        }');

        eval('namespace Illuminate\Support\Facades;
        class Date
        {
            public static $locale = null;

            public static function getFacadeRoot()
            {
                return new static();
            }

            public function setLocale($locale)
            {
                static::$locale = $locale;

                if ($locale === "fr") {
                    throw new \Exception("stop");
                }
            }
        }');

        $dispatcher = new Dispatcher();
        $service = new ServiceProvider($dispatcher);
        $service->boot();
        $service->app->register();
        $service->updateLocale();

        $this->assertSame('de', \Illuminate\Support\Carbon::$locale);
        $this->assertSame('de', \Illuminate\Support\Facades\Date::$locale);

        $service->app->setLocale('fr');
        $service->updateLocale();

        $this->assertSame('fr', \Illuminate\Support\Carbon::$locale);
        $this->assertSame('fr', \Illuminate\Support\Facades\Date::$locale);

        eval('namespace Carbon\Laravel;
        function app()
        {
            $app = new \Tests\Laravel\App();
            $app->setEventDispatcher(new \Illuminate\Events\Dispatcher());
            $app->register();
            $app->setLocale("it");

            return $app;
        }
        ');

        $service->app = new \stdClass();
        $service->updateLocale();

        $this->assertSame('it', \Illuminate\Support\Carbon::$locale);
        $this->assertSame('it', \Illuminate\Support\Facades\Date::$locale);
    }
}
