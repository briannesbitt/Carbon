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
use Carbon\CarbonInterval;
use Carbon\PHPStan\MacroExtension;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Testing\PHPStanTestCase;
use PHPStan\Type\ClosureTypeFactory;
use PHPStan\Type\VerbosityLevel;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\RequiresPhpunit;

#[RequiresPhpunit('<11')]
#[RequiresPhp('<8.4')]
class MacroExtensionTest extends PHPStanTestCase
{
    /** @var ReflectionProvider */
    private $reflectionProvider;

    /** @var MacroExtension */
    private $extension;

    protected function setUp(): void
    {
        $this->reflectionProvider = $this->createReflectionProvider();
        $this->extension = new MacroExtension(
            $this->reflectionProvider,
            self::getContainer()->getByType(ClosureTypeFactory::class)
        );
    }

    public function testHasMacro()
    {
        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $this->assertFalse($this->extension->hasMethod($carbon, 'foo'));

        Carbon::macro('foo', function ($someArg) {
        });

        $carbonInterval = $this->reflectionProvider->getClass(CarbonInterval::class);

        $this->assertTrue($this->extension->hasMethod($carbon, 'foo'));
        $this->assertFalse($this->extension->hasMethod($carbonInterval, 'foo'));
        $this->assertFalse($this->extension->hasMethod($carbonInterval, 'foo'));
    }

    public function testGetMacro()
    {
        Carbon::macro('foo', function (): CarbonInterval {
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'foo');
        $variant = ParametersAcceptorSelector::selectSingle($method->getVariants());

        $this->assertSame(
            CarbonInterval::class,
            $variant->getReturnType()->describe(VerbosityLevel::typeOnly()),
        );
    }
}
