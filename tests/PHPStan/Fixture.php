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

namespace Tests\PHPStan;

use Carbon\Carbon;

class Fixture
{
    public function testCarbonMacroCalledStatically(): string
    {
        return Carbon::foo(15);
    }

    public function testCarbonMacroCalledDynamically(): string
    {
        return Carbon::now()->foo(42);
    }
}
