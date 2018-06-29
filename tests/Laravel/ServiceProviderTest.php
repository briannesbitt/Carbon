<?php

namespace Tests\Carbon\Laravel;

use Carbon\Carbon;
use Carbon\Laravel\ServiceProvider;
use PHPUnit\Framework\TestCase;

class ServiceProviderTest extends TestCase
{
    public function testBoot()
    {
        include_once __DIR__.'/ServiceProvider.php';
        $service = new ServiceProvider();

        $this->assertSame('en', Carbon::getLocale());
        $service->boot();
        $this->assertSame('de', Carbon::getLocale());
        $service->app->setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
        $this->assertNull($service->register());
    }
}
