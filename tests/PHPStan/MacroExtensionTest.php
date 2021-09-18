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
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\PHPStan\MacroScanner;
use Tests\AbstractTestCase;

class MacroExtensionTest extends AbstractTestCase
{
    public function testHasMacro()
    {
        $scanner = new MacroScanner();

        $this->assertFalse($scanner->hasMethod(Carbon::class, 'foo'));

        Carbon::macro('foo', function () {
        });

        $this->assertTrue($scanner->hasMethod(Carbon::class, 'foo'));
        $this->assertFalse($scanner->hasMethod(CarbonInterval::class, 'foo'));
        $this->assertFalse($scanner->hasMethod(CarbonInterface::class, 'foo'));
    }

    public function testGetMacro()
    {
        $scanner = new MacroScanner();
        Carbon::macro('foo', function (): CarbonInterval {
        });

        $this->assertSame(
            CarbonInterval::class,
            $scanner->getMethod(Carbon::class, 'foo')->getReturnType()->getName()
        );
    }
}
