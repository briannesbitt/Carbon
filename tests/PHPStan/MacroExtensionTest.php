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
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;
use Tests\AbstractTestCase;

class MacroExtensionTest extends AbstractTestCase
{
    private function mockReflectionProvider()
    {
        $carbonReflection = $this->createMock(ClassReflection::class);
        $carbonReflection->method('getName')->willReturn(Carbon::class);
        $carbonReflection->method('isSubclassOf')->with(CarbonInterface::class)->willReturn(true);

        $intervalReflection = $this->createMock(ClassReflection::class);
        $intervalReflection->method('getName')->willReturn(CarbonInterval::class);
        $intervalReflection->method('isSubclassOf')->with(CarbonInterface::class)->willReturn(false);

        $interfaceReflection = $this->createMock(ClassReflection::class);
        $interfaceReflection->method('getName')->willReturn(CarbonInterface::class);
        $interfaceReflection->method('isSubclassOf')->with(CarbonInterface::class)->willReturn(false);

        $reflectionProvider = $this->createMock(ReflectionProvider::class);
        $reflectionProvider->method('getClass')->willReturnCallback(
            function (string $className) use ($carbonReflection, $interfaceReflection, $intervalReflection) {
                if ($className === Carbon::class) {
                    return $carbonReflection;
                }
                if ($className === CarbonInterface::class) {
                    return $interfaceReflection;
                }
                if ($className === CarbonInterval::class) {
                    return $intervalReflection;
                }
                $this->fail("Reflection received unexpected class $className");
            }
        );

        return $reflectionProvider;
    }

    public function testHasMacro()
    {
        $scanner = new MacroScanner($this->mockReflectionProvider());

        $this->assertFalse($scanner->hasMethod(Carbon::class, 'foo'));

        Carbon::macro('foo', function ($someArg) {
        });

        $this->assertTrue($scanner->hasMethod(Carbon::class, 'foo'));
        $this->assertFalse($scanner->hasMethod(CarbonInterval::class, 'foo'));
        $this->assertFalse($scanner->hasMethod(CarbonInterface::class, 'foo'));
    }

    public function testGetMacro()
    {
        $scanner = new MacroScanner($this->mockReflectionProvider());
        Carbon::macro('foo', function (): CarbonInterval {
        });

        $this->assertSame(
            CarbonInterval::class,
            $scanner->getMethod(Carbon::class, 'foo')->getReturnType()->getName()
        );
    }
}
