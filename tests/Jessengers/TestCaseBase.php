<?php

namespace Tests\Jessengers;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TestCaseBase extends TestCase
{
    const LOCALE = 'en';

    public function setUp(): void
    {
        date_default_timezone_set('UTC');
        Carbon::setLocale(static::LOCALE);
        $this->languages = ['en', 'fr', 'it', 'ja', 'ru', 'ar'];

        // Freeze the time for the test duration
        Carbon::setTestNow(Carbon::now());
    }
}
