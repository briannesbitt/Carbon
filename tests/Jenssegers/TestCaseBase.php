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
