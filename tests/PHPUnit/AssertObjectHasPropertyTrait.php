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

namespace Tests\PHPUnit;

use PHPUnit\Framework\TestCase;

require_once method_exists(TestCase::class, 'assertObjectHasProperty')
    ? __DIR__.'/AssertObjectHasPropertyNoopTrait.php'
    : __DIR__.'/AssertObjectHasPropertyPolyfillTrait.php';
