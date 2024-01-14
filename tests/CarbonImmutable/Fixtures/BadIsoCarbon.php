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

namespace Tests\CarbonImmutable\Fixtures;

use Carbon\CarbonImmutable as Carbon;

class BadIsoCarbon extends Carbon
{
    public static function getIsoUnits(): array
    {
        return [
            'MMM' => ['fooxyz', ['barxyz']],
        ];
    }
}
