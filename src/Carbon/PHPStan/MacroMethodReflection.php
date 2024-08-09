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

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Type;

class MacroMethodReflection implements MethodReflection
{
    /** @var ClassReflection */
    private $declaringClass;

    /** @var string */
    private $methodName;

    /** @var ParametersAcceptor */
    private $macroClosureType;

    /** @var bool */
    private $static;

    /** @var string|null */
    private $docComment;

    public function __construct(
        ClassReflection $declaringClass,
        string $methodName,
        ParametersAcceptor $macroClosureType,
        bool $static,
        ?string $docComment
    ) {
        $this->declaringClass = $declaringClass;
        $this->methodName = $methodName;
        $this->macroClosureType = $macroClosureType;
        $this->static = $static;
        $this->docComment = $docComment;
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClass;
    }

    public function isStatic(): bool
    {
        return $this->static;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getDocComment(): ?string
    {
        return $this->docComment;
    }

    public function getName(): string
    {
        return $this->methodName;
    }

    public function getPrototype(): \PHPStan\Reflection\ClassMemberReflection
    {
        return $this;
    }

    public function getVariants(): array
    {
        return [$this->macroClosureType];
    }

    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeprecatedDescription(): ?string
    {
        return null;
    }

    public function isFinal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function isInternal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getThrowType(): ?Type
    {
        return null;
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return TrinaryLogic::createMaybe();
    }
}
