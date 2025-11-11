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
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\PHPStan\MacroExtension;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Testing\PHPStanTestCase;
use PHPStan\Type\ClosureTypeFactory;
use PHPStan\Type\VerbosityLevel;
use PHPUnit\Framework\Attributes\RequiresPhp;

/**
 * PHPStan is calling deprecated ->setAccessible() method, they already fixed it,
 * but did not release a new version with the fix.
 *
 * Disabling this test for PHP 8.5 until the patch is out.
 */
#[RequiresPhp('< 8.5')]
class MacroExtensionTest extends PHPStanTestCase
{
    private ReflectionProvider $reflectionProvider;
    private MacroExtension $extension;

    protected function setUp(): void
    {
        parent::setUp();

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
        $variant = $method->getVariants()[0];

        $this->assertSame(
            CarbonInterval::class,
            $variant->getReturnType()->describe(VerbosityLevel::typeOnly()),
        );
    }

    public function testIsStatic()
    {
        Carbon::macro('calendarBerlin', static function (): string {
            return self::this()->tz('Europe/Berlin')->calendar();
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'calendarBerlin');

        $this->assertTrue($method->isStatic());

        Carbon::macro('calendarBerlinNonStatic', function (): string {
            return $this->tz('Europe/Berlin')->calendar();
        });

        $method = $this->extension->getMethod($carbon, 'calendarBerlinNonStatic');
        $this->assertFalse($method->isStatic());
    }

    public function testGetDeclaringClass()
    {
        Carbon::macro('lower', 'strtolower');
        $carbon = $this->reflectionProvider->getClass(Carbon::class);

        $method = $this->extension->getMethod($carbon, 'lower');
        $this->assertSame(Carbon::class, $method->getDeclaringClass()->getName());

        CarbonImmutable::macro('lowerImmutable', 'strtolower');

        $carbonImmutable = $this->reflectionProvider->getClass(CarbonImmutable::class);

        $method = $this->extension->getMethod($carbonImmutable, 'lowerImmutable');
        $this->assertSame(CarbonImmutable::class, $method->getDeclaringClass()->getName());
    }

    public function testIsPrivate()
    {
        Carbon::macro('lowerVisibility', 'strtolower');

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'lowerVisibility');
        $this->assertFalse($method->isPrivate());
    }

    public function testIsPublic()
    {
        Carbon::macro('lowerVisibility', 'strtolower');

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'lowerVisibility');
        $this->assertTrue($method->isPublic());
    }

    public function testIsFinal()
    {
        $mixinClass = new class() {
            // Declaring final won't apply for macro, sub-class will always be able to override macros.
            final public static function foo(): string
            {
                return 'foo';
            }

            public static function bar(): string
            {
                return 'bar';
            }
        };

        $carbon = $this->reflectionProvider->getClass(Carbon::class);

        Carbon::macro('foo', [$mixinClass, 'foo']);
        $method = $this->extension->getMethod($carbon, 'foo');

        $this->assertTrue($method->isFinal()->yes());

        Carbon::macro('bar', [$mixinClass, 'bar']);
        $method = $this->extension->getMethod($carbon, 'bar');

        $this->assertTrue($method->isFinal()->no());
    }

    public function testIsInternal()
    {
        Carbon::macro('lowerVisibility', 'strtolower');

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'lowerVisibility');
        $this->assertFalse($method->isInternal()->yes());
    }

    public function testGetDocComment()
    {
        Carbon::macro(
            'closureWithDocComment',
            /**
             * Foo.
             */
            function () {
                return 'foo';
            },
        );

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'closureWithDocComment');

        $this->assertSame(
            "/**\n* Foo.\n*/",
            preg_replace('/^[\t ]+/m', '', $method->getDocComment()),
        );
    }

    public function testGetName()
    {
        Carbon::macro('lowerVisibility', 'strtolower');
        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'lowerVisibility');

        $this->assertSame('lowerVisibility', $method->getName());
    }

    public function testGetParameters()
    {
        Carbon::macro('noParameters', function () {
        });
        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'noParameters');

        $variant = $method->getVariants()[0];

        $this->assertSame([], $variant->getParameters());

        Carbon::macro('twoParameters', function (string $a, $b = 9) {
        });
        $method = $this->extension->getMethod($carbon, 'twoParameters');
        $variant = $method->getVariants()[0];
        $parameters = $variant->getParameters();

        $this->assertCount(2, $parameters);
        $this->assertSame('a', $parameters[0]->getName());
        $this->assertNull($parameters[0]->getDefaultValue());
        $this->assertSame('string', $parameters[0]->getType()->describe(VerbosityLevel::typeOnly()));
        $this->assertSame('b', $parameters[1]->getName());
        $this->assertNotNull($parameters[1]->getDefaultValue());
        $this->assertSame('9', $parameters[1]->getDefaultValue()->describe(VerbosityLevel::value()));
        $this->assertSame('mixed', $parameters[1]->getType()->describe(VerbosityLevel::typeOnly()));
    }

    public function testGetReturnType()
    {
        Carbon::macro('noReturnType', function () {
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'noReturnType');

        $variant = $method->getVariants()[0];

        $this->assertSame('mixed', $variant->getReturnType()->describe(VerbosityLevel::typeOnly()));

        Carbon::macro('carbonReturnType', function (): Carbon {
        });

        $method = $this->extension->getMethod($carbon, 'carbonReturnType');
        $variant = $method->getVariants()[0];

        $this->assertSame(Carbon::class, $variant->getReturnType()->describe(VerbosityLevel::typeOnly()));
    }

    public function testIsDeprecated()
    {
        Carbon::macro(
            'deprecated',
            /**
             * @deprecated since 3.0.0
             */
            function () {
            },
        );

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'deprecated');

        $this->assertTrue($method->isDeprecated()->yes());
        $this->assertNull($method->getDeprecatedDescription());

        Carbon::macro(
            'discouraged',
            /**
             * @discouraged since 3.0.0
             */
            function () {
            },
        );

        $method = $this->extension->getMethod($carbon, 'discouraged');

        $this->assertFalse($method->isDeprecated()->yes());
        $this->assertNull($method->getDeprecatedDescription());
    }

    public function testIsVariadic()
    {
        Carbon::macro('variadic', function (...$params) {
        });
        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'variadic');
        $variant = $method->getVariants()[0];

        $this->assertTrue($variant->isVariadic());

        Carbon::macro('notVariadic', function ($params) {
        });

        $method = $this->extension->getMethod($carbon, 'notVariadic');
        $variant = $method->getVariants()[0];

        $this->assertFalse($variant->isVariadic());
    }

    public function testGetPrototype()
    {
        Carbon::macro('prototype', function () {
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'prototype');

        $this->assertSame($method, $method->getPrototype());
    }

    public function testGetThrowType()
    {
        Carbon::macro('throwType', function () {
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'throwType');

        $this->assertNull($method->getThrowType());
    }

    public function testHasSideEffects()
    {
        Carbon::macro('hasSideEffects', function () {
        });

        $carbon = $this->reflectionProvider->getClass(Carbon::class);
        $method = $this->extension->getMethod($carbon, 'hasSideEffects');

        $this->assertTrue($method->hasSideEffects()->maybe());
    }
}
