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

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Laravel\ServiceProvider;
use Generator;
use Illuminate\Events\Dispatcher;
use Illuminate\Events\EventDispatcher;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use stdClass;

class ServiceProviderTest extends TestCase
{
    public static function dataForDispatchers(): Generator
    {
        if (!class_exists(Dispatcher::class)) {
            include_once __DIR__.'/Dispatcher.php';
        }

        if (!class_exists(EventDispatcher::class)) {
            include_once __DIR__.'/EventDispatcher.php';
        }

        yield [new Dispatcher()];
        yield [new EventDispatcher()];
    }

    #[DataProvider('dataForDispatchers')]
    public function testBoot(EventDispatcherBase $dispatcher)
    {
        // Reset language
        Carbon::setLocale('en');
        CarbonImmutable::setLocale('en');
        CarbonPeriod::setLocale('en');
        CarbonInterval::setLocale('en');
        Carbon::setFallbackLocale('en');
        CarbonImmutable::setFallbackLocale('en');
        CarbonPeriod::setFallbackLocale('en');
        CarbonInterval::setFallbackLocale('en');

        $service = new ServiceProvider($dispatcher);

        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());
        $this->assertSame('en', CarbonInterval::getLocale());
        $this->assertSame('en', Carbon::getFallbackLocale());
        $this->assertSame('en', CarbonImmutable::getFallbackLocale());
        $this->assertSame('en', CarbonPeriod::getFallbackLocale());
        $this->assertSame('en', CarbonInterval::getFallbackLocale());
        $service->boot();
        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());
        $this->assertSame('en', CarbonInterval::getLocale());
        $this->assertSame('en', Carbon::getFallbackLocale());
        $this->assertSame('en', CarbonImmutable::getFallbackLocale());
        $this->assertSame('en', CarbonPeriod::getFallbackLocale());
        $this->assertSame('en', CarbonInterval::getFallbackLocale());
        $service->app->register();
        $service->boot();
        $this->assertSame('de', Carbon::getLocale());
        $this->assertSame('de', CarbonImmutable::getLocale());
        $this->assertSame('de', CarbonPeriod::getLocale());
        $this->assertSame('de', CarbonInterval::getLocale());
        $this->assertSame('fr', Carbon::getFallbackLocale());
        $this->assertSame('fr', CarbonImmutable::getFallbackLocale());
        $this->assertSame('fr', CarbonPeriod::getFallbackLocale());
        $this->assertSame('fr', CarbonInterval::getFallbackLocale());
        $service->app->setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
        $this->assertNull($service->register());

        // Reset language
        Carbon::setLocale('en');
        Carbon::setFallbackLocale('en');

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
        Carbon::setFallbackLocale('en');
        CarbonImmutable::setFallbackLocale('en');
        CarbonPeriod::setFallbackLocale('en');
        CarbonInterval::setFallbackLocale('en');

        $service->boot();
        $service->app->register();
        $service->app->setLocaleWithoutEvent('fr');
        $service->app->setFallbackLocale('it');
        $dispatcher->dispatch('locale.changed');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
        $this->assertSame('en', Carbon::getFallbackLocale());
        $this->assertSame('en', CarbonImmutable::getFallbackLocale());
        $this->assertSame('en', CarbonPeriod::getFallbackLocale());
        $this->assertSame('en', CarbonInterval::getFallbackLocale());
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
        Carbon::setFallbackLocale('en');
        CarbonImmutable::setFallbackLocale('en');
        CarbonPeriod::setFallbackLocale('en');
        CarbonInterval::setFallbackLocale('en');

        $service->boot();
        $service->app->register();
        $service->app->setLocaleWithoutEvent('fr');
        $service->app->setFallbackLocale('it');
        $app = new App();
        $app->register();
        $app->setLocaleWithoutEvent('de_DE');
        $app->setFallbackLocale('es_ES');
        $dispatcher->dispatch('Illuminate\Foundation\Events\LocaleUpdated');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertSame('fr', CarbonInterval::getLocale());
        $this->assertSame('en', Carbon::getFallbackLocale());
        $this->assertSame('en', CarbonImmutable::getFallbackLocale());
        $this->assertSame('en', CarbonPeriod::getFallbackLocale());
        $this->assertSame('en', CarbonInterval::getFallbackLocale());

        $service->setAppGetter(static fn () => $app);
        $this->assertSame('fr', Carbon::getLocale());
        $service->updateLocale();
        $this->assertSame('de_DE', Carbon::getLocale());
        $service->setLocaleGetter(static fn () => 'ckb');
        $this->assertSame('de_DE', Carbon::getLocale());
        $service->updateLocale();
        $this->assertSame('ckb', Carbon::getLocale());
        $service->setLocaleGetter(null);
        $service->setAppGetter(static fn () => null);
        $service->updateLocale();
        $this->assertSame('ckb', Carbon::getLocale());

        $service->setAppGetter(static fn () => $app);
        $this->assertSame('en', Carbon::getFallbackLocale());
        $service->updateFallbackLocale();
        $this->assertSame('es_ES', Carbon::getFallbackLocale());
        $service->setFallbackLocaleGetter(static fn () => 'ckb');
        $this->assertSame('es_ES', Carbon::getFallbackLocale());
        $service->updateFallbackLocale();
        $this->assertSame('ckb', Carbon::getFallbackLocale());
        $service->setFallbackLocaleGetter(null);
        $service->setAppGetter(static fn () => null);
        $service->updateFallbackLocale();
        $this->assertSame('ckb', Carbon::getFallbackLocale());
    }

    public function testUpdateLocale()
    {
        if (class_exists('Illuminate\Support\Carbon')) {
            $this->markTestSkipped('This test cannot be run with Laravel 5.5 classes available via autoload.');
        }

        eval('
            namespace Illuminate\Support;
            class Carbon
            {
                public static $locale;
                public static $fallbackLocale;

                public static function setLocale($locale)
                {
                    static::$locale = $locale;
                }

                public static function setFallbackLocale($locale)
                {
                    static::$fallbackLocale = $locale;
                }
            }
        ');

        eval('
            namespace Illuminate\Support\Facades;
            use Exception;
            class Date
            {
                public static $locale;
                public static $fallbackLocale;

                public static function getFacadeRoot()
                {
                    return new static();
                }

                public function setLocale($locale)
                {
                    static::$locale = $locale;

                    if ($locale === "fr") {
                        throw new Exception("stop");
                    }
                }

                public function setFallbackLocale($locale)
                {
                    static::$fallbackLocale = $locale;

                    if ($locale === "es") {
                        throw new Exception("stop");
                    }
                }
            }
        ');

        $dispatcher = new Dispatcher();
        $service = new ServiceProvider($dispatcher);
        $service->boot();
        $service->app->register();

        $this->assertSame('en', SupportCarbon::$locale);
        $this->assertSame('en', Date::$locale);
        $this->assertSame('en', SupportCarbon::$fallbackLocale);
        $this->assertSame('en', Date::$fallbackLocale);

        $service->updateLocale();

        $this->assertSame('de', SupportCarbon::$locale);
        $this->assertSame('de', Date::$locale);
        $this->assertSame('en', SupportCarbon::$fallbackLocale);
        $this->assertSame('en', Date::$fallbackLocale);

        $service->updateFallbackLocale();

        $this->assertSame('de', SupportCarbon::$locale);
        $this->assertSame('de', Date::$locale);
        $this->assertSame('fr', SupportCarbon::$fallbackLocale);
        $this->assertSame('fr', Date::$fallbackLocale);

        $service->app->setLocale('fr');
        $service->app->setFallbackLocale('gl');
        $service->updateLocale();

        $this->assertSame('fr', SupportCarbon::$locale);
        $this->assertSame('fr', Date::$locale);
        $this->assertSame('fr', SupportCarbon::$fallbackLocale);
        $this->assertSame('fr', Date::$fallbackLocale);

        $service->updateFallbackLocale();

        $this->assertSame('gl', SupportCarbon::$fallbackLocale);
        $this->assertSame('gl', Date::$fallbackLocale);

        eval('
            use Illuminate\Events\Dispatcher;
            use Tests\Laravel\App;
            function app($id)
            {
                $app = new App();
                $app->setEventDispatcher(new Dispatcher());
                $app->register();
                $app->setLocale("it");

                return $app;
            }
        ');

        $service->app = new stdClass();
        $service->updateLocale();

        $this->assertSame('it', SupportCarbon::$locale);
        $this->assertSame('it', Date::$locale);
    }
}
