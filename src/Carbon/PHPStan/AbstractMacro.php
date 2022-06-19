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

namespace Carbon\PHPStan;

use Closure;
use PHPStan\Reflection\Php\BuiltinMethodReflection;
use PHPStan\TrinaryLogic;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionType;
use stdClass;
use Throwable;

abstract class AbstractMacro implements BuiltinMethodReflection
{
    /**
     * The reflection function/method.
     *
     * @var ReflectionFunction|ReflectionMethod
     */
    protected $reflectionFunction;

    /**
     * The class name.
     *
     * @var class-string
     */
    private $className;

    /**
     * The method name.
     *
     * @var string
     */
    private $methodName;

    /**
     * The parameters.
     *
     * @var ReflectionParameter[]
     */
    private $parameters;

    /**
     * The is static.
     *
     * @var bool
     */
    private $static = false;

    /**
     * Macro constructor.
     *
     * @param string $className
     * @phpstan-param class-string $className
     *
     * @param string   $methodName
     * @param callable $macro
     */
    public function __construct(string $className, string $methodName, $macro)
    {
        $this->className = $className;
        $this->methodName = $methodName;
        $this->reflectionFunction = \is_array($macro)
            ? new ReflectionMethod($macro[0], $macro[1])
            : new ReflectionFunction($macro);
        $this->parameters = $this->reflectionFunction->getParameters();

        if ($this->reflectionFunction->isClosure()) {
            try {
                $closure = $this->reflectionFunction->getClosure();
                $boundClosure = Closure::bind($closure, new stdClass());
                $this->static = (!$boundClosure || (new ReflectionFunction($boundClosure))->getClosureThis() === null);
            } catch (Throwable $e) {
                $this->static = true;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDeclaringClass(): ReflectionClass
    {
        return new ReflectionClass($this->className);
    }

    /**
     * {@inheritdoc}
     */
    public function isPrivate(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isFinal(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isInternal(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isAbstract(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isStatic(): bool
    {
        return $this->static;
    }

    /**
     * {@inheritdoc}
     */
    public function getDocComment(): ?string
    {
        return $this->reflectionFunction->getDocComment() ?: null;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->methodName;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnType(): ?ReflectionType
    {
        return $this->reflectionFunction->getReturnType();
    }

    /**
     * {@inheritdoc}
     */
    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createFromBoolean(
            $this->reflectionFunction->isDeprecated() ||
            preg_match('/@deprecated/i', $this->getDocComment() ?: '')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isVariadic(): bool
    {
        return $this->reflectionFunction->isVariadic();
    }

    /**
     * {@inheritdoc}
     */
    public function getPrototype(): BuiltinMethodReflection
    {
        return $this;
    }

    public function getTentativeReturnType(): ?ReflectionType
    {
        return null;
    }
}
