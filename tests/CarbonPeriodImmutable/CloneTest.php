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

namespace Tests\CarbonPeriodImmutable;

use Carbon\CarbonPeriodImmutable;

class CloneTest extends \Tests\CarbonPeriod\CloneTest
{
    protected static string $periodClass = CarbonPeriodImmutable::class;
}
