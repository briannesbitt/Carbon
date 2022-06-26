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

class MixinClass
{
    // Declaring final won't apply for macro, sub-class will always be able to override macros.
    final public static function foo(): string
    {
        return 'foo';
    }

    public static function bar(): string
    {
        return 'bar';
    }
}
