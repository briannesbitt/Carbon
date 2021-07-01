<?php
declare(strict_types=1);

namespace Tests\Jenssegers;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

abstract class TestCaseBase extends TestCase
{
    public const LOCALE = 'en';

    protected function setUp(): void
    {
        parent::setUp();

        date_default_timezone_set('UTC');
        Carbon::setLocale(static::LOCALE);

        // Freeze the time for the test duration
        Carbon::setTestNow(Carbon::now());
    }
}
