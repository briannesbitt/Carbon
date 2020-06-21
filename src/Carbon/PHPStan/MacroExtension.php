<?php

namespace Carbon\PHPStan;

use Carbon\CarbonInterface;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\Php\PhpMethodReflectionFactory;
use PHPStan\Type\TypehintHelper;
use ReflectionClass;
use ReflectionFunction;

final class MacroExtension implements MethodsClassReflectionExtension
{
    /**
     * @var PhpMethodReflectionFactory
     */
    protected $methodReflectionFactory;

    /**
     * Extension constructor.
     *
     * @param PhpMethodReflectionFactory $methodReflectionFactory
     */
    public function __construct(PhpMethodReflectionFactory $methodReflectionFactory)
    {
        $this->methodReflectionFactory = $methodReflectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        /** @var CarbonInterface $class */
        $class = $classReflection->getName();

        return is_a($class, CarbonInterface::class, true) && $class::hasMacro($methodName);
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $className = $classReflection->getName();
        $reflectionClass = new ReflectionClass($className);
        $property = $reflectionClass->getProperty('globalMacros');

        $property->setAccessible(true);
        $macro = $property->getValue()[$methodName];
        $builtinMacro = new Macro(
            $classReflection->getName(),
            $methodName,
            new ReflectionFunction($macro)
        );

        return $this->methodReflectionFactory->create(
            $classReflection,
            null,
            $builtinMacro,
            $classReflection->getActiveTemplateTypeMap(),
            [],
            TypehintHelper::decideTypeFromReflection($builtinMacro->getReturnType()),
            null,
            null,
            $builtinMacro->isDeprecated()->yes(),
            $builtinMacro->isInternal(),
            $builtinMacro->isFinal(),
            $builtinMacro->getDocComment()
        );
    }
}
