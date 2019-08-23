<?php
declare(strict_types=1);

namespace Tests\Laravel;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

        include_once __DIR__.'/ServiceProvider.php';
        $service = new ServiceProvider($dispatcher);

        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());

        $service->boot();
        $this->assertSame('en', Carbon::getLocale());
        $this->assertSame('en', CarbonImmutable::getLocale());
        $this->assertSame('en', CarbonPeriod::getLocale());

        $service->app->register();
        $service->boot();
        $this->assertSame('de', Carbon::getLocale());
        $this->assertSame('de', CarbonImmutable::getLocale());
        $this->assertSame('de', CarbonPeriod::getLocale());

        $service->app->setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertSame('fr', CarbonImmutable::getLocale());
        $this->assertSame('fr', CarbonPeriod::getLocale());
        $this->assertNull($service->register());

        // Reset language
        Carbon::setLocale('en');
        CarbonImmutable::setLocale('en');
        CarbonPeriod::setLocale('en');

        $service->app->removeService('events');
        $this->assertNull($service->boot());
    }
}
