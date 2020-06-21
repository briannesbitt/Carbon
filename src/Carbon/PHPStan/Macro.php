<?php

declare(strict_types=1);

namespace Carbon\PHPStan;

use Closure;
use ErrorException;
use PHPStan\Reflection\Php\BuiltinMethodReflection;
use PHPStan\TrinaryLogic;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionType;
use stdClass;

final class Macro implements BuiltinMethodReflection
{
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
     * The reflection function.
     *
     * @var ReflectionFunction
     */
    private $reflectionFunction;

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
     * @param string             $methodName
     * @param ReflectionFunction $reflectionFunction
     */
    public function __construct(string $className, string $methodName, ReflectionFunction $reflectionFunction)
    {
        $this->className = $className;
        $this->methodName = $methodName;
        $this->reflectionFunction = $reflectionFunction;
        $this->parameters = $this->reflectionFunction->getParameters();

        if ($this->reflectionFunction->isClosure()) {
            try {
                /** @var Closure $closure */
                $closure = $this->reflectionFunction->getClosure();
                $boundClosure = Closure::bind($closure, new stdClass);
                $this->static = (!$boundClosure || (new \ReflectionFunction($boundClosure))->getClosureThis() === null);
            } catch (ErrorException $e) {
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
     * Set the is static value.
     *
     * @param bool $static
     *
     * @return void
     */
    public function setStatic(bool $static): void
    {
        $this->static = $static;
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
    public function getFileName()
    {
        return $this->reflectionFunction->getFileName();
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
     * Set the parameters value.
     *
     * @param ReflectionParameter[] $parameters
     *
     * @return void
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
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
    public function getStartLine()
    {
        return $this->reflectionFunction->getStartLine();
    }

    /**
     * {@inheritdoc}
     */
    public function getEndLine()
    {
        return $this->reflectionFunction->getEndLine();
    }

    /**
     * {@inheritdoc}
     */
    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createFromBoolean($this->reflectionFunction->isDeprecated());
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

    /**
     * {@inheritdoc}
     */
    public function getReflection(): ?ReflectionMethod
    {
        return null;
    }
}
