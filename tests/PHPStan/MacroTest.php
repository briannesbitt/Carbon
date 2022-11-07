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
use Carbon\PHPStan\Macro;
use ReflectionClass;
use Tests\AbstractTestCase;

class MacroTest extends AbstractTestCase
{
    public function testIsStatic()
    {
        $macro = new Macro(Carbon::class, 'calendarBerlin', static function (): string {
            return self::this()->tz('Europe/Berlin')->calendar();
        });

        $this->assertTrue($macro->isStatic());

        $macro = new Macro(Carbon::class, 'calendarBerlin', function (): string {
            return $this->tz('Europe/Berlin')->calendar();
        });

        $this->assertFalse($macro->isStatic());
    }

    public function testGetDeclaringClass()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertSame(Carbon::class, $macro->getDeclaringClass()->getName());

        $macro = new Macro(CarbonImmutable::class, 'lower', 'strtolower');

        $this->assertSame(CarbonImmutable::class, $macro->getDeclaringClass()->getName());
    }

    public function testIsPrivate()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertFalse($macro->isPrivate());
    }

    public function testIsPublic()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertTrue($macro->isPublic());
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

        $macro = new Macro(Carbon::class, 'foo', [$mixinClass, 'foo']);

        $this->assertFalse($macro->isFinal());

        $macro = new Macro(Carbon::class, 'bar', [$mixinClass, 'bar']);

        $this->assertFalse($macro->isFinal());
    }

    public function testIsInternal()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertFalse($macro->isInternal());
    }

    public function testIsAbstract()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertFalse($macro->isAbstract());
    }

    public function testGetDocComment()
    {
        $macro = new Macro(
            Carbon::class,
            'foo',
            /**
             * Foo.
             */
            function () {
                return 'foo';
            }
        );

        $this->assertSame(
            "/**\n* Foo.\n*/",
            preg_replace('/^[\t ]+/m', '', $macro->getDocComment())
        );
    }

    public function testGetFileName()
    {
        $macro = new Macro(Carbon::class, 'foo', function () {
        });

        $this->assertSame(__FILE__, $macro->getFileName());
    }

    public function testGetName()
    {
        $macro = new Macro(Carbon::class, 'lower', 'strtolower');

        $this->assertSame('lower', $macro->getName());
    }

    public function testGetParameters()
    {
        $macro = new Macro(Carbon::class, 'lower', function () {
        });

        $this->assertSame([], $macro->getParameters());

        $macro = new Macro(Carbon::class, 'lower', function (string $a, $b = 9) {
        });
        $parameters = $macro->getParameters();

        $this->assertCount(2, $parameters);
        $this->assertSame('a', $parameters[0]->getName());
        $this->assertTrue($parameters[0]->hasType());
        $this->assertFalse($parameters[0]->isDefaultValueAvailable());
        $this->assertSame('string', $parameters[0]->getType()->getName());
        $this->assertSame('b', $parameters[1]->getName());
        $this->assertTrue($parameters[1]->isDefaultValueAvailable());
        $this->assertFalse($parameters[1]->hasType());
        $this->assertNull($parameters[1]->getType());
        $this->assertSame(9, $parameters[1]->getDefaultValue());
    }

    public function testGetReturnType()
    {
        $macro = new Macro(Carbon::class, 'lower', function () {
        });

        $this->assertNull($macro->getReturnType());

        $macro = new Macro(Carbon::class, 'lower', function (): Carbon {
        });

        $this->assertSame(Carbon::class, $macro->getReturnType()->getName());
    }

    public function testGetLines()
    {
        $line = __LINE__;
        $macro = new Macro(Carbon::class, 'foo', function () {
            return 'foo';
        });

        $this->assertSame($line + 1, $macro->getStartLine());
        $this->assertSame($line + 3, $macro->getEndLine());
    }

    public function testIsDeprecated()
    {
        $macro = new Macro(
            Carbon::class,
            'lower',
            /**
             * @deprecated since 3.0.0
             */
            function () {
            }
        );

        $this->assertTrue($macro->isDeprecated()->yes());

        $macro = new Macro(
            Carbon::class,
            'lower',
            /**
             * @discouraged since 3.0.0
             */
            function () {
            }
        );

        $this->assertFalse($macro->isDeprecated()->yes());
    }

    public function testIsVariadic()
    {
        $macro = new Macro(Carbon::class, 'lower', function (...$params) {
        });

        $this->assertTrue($macro->isVariadic());

        $macro = new Macro(Carbon::class, 'lower', function ($params) {
        });

        $this->assertFalse($macro->isVariadic());
    }

    public function testGetPrototype()
    {
        $macro = new Macro(Carbon::class, 'lower', function () {
        });

        $this->assertSame($macro, $macro->getPrototype());
    }

    public function testGetReflection()
    {
        require_once __DIR__.'/MixinClass.php';

        $mixinClass = MixinClass::class;

        $macro = new Macro(Carbon::class, 'foo', [$mixinClass, 'foo']);

        $this->assertSame(
            (new ReflectionClass($mixinClass))->getName(),
            $macro->getReflection()->getDeclaringClass()->getName()
        );
        $this->assertSame('foo', $macro->getReflection()->getName());
        $this->assertNull($macro->getTentativeReturnType());
        $this->assertTrue($macro->returnsByReference()->no());

        $macro = new Macro(Carbon::class, 'bar', function () {
        });

        $this->assertNull($macro->getReflection());
        $this->assertNull($macro->getTentativeReturnType());
    }
}
