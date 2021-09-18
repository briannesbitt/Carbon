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

namespace Tests;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

abstract class AbstractTestCaseWithOldNow extends AbstractTestCase
{
    /**
     * @var bool
     */
    protected $oldNow = true;

    /**
     * @var bool
     */
    protected $oldImmutableNow = true;

    protected function tearDown(): void
    {
        Carbon::resetMacros();
        Carbon::serializeUsing(null);

        CarbonImmutable::resetMacros();
        CarbonImmutable::serializeUsing(null);

        parent::tearDown();
    }
}
