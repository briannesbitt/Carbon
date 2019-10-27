<?php

namespace Carbon\PHPStan;

use Carbon\CarbonInterface;
use PHPStan\Broker\Broker;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\BrokerAwareExtension;
use PHPStan\Reflection\Php\PhpMethodReflectionFactory;
use PHPStan\Reflection\MethodsClassReflectionExtension;

class MacroExtension implements MethodsClassReflectionExtension
{
    /**
     * @var \PHPStan\Reflection\Php\PhpMethodReflectionFactory
     */
    protected $methodReflectionFactory;

    /**
     * Extension constructor.
     *
     * @param  \PHPStan\Reflection\Php\PhpMethodReflectionFactory  $methodReflectionFactory
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
        if (!in_array(
            CarbonInterface::class,
            $classReflection->getInterfaces()
        )) {
            /** @var CarbonInterface $class */
            $class = $classReflection->getName();

            return $class::hasMacro($methodName);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $className = $classReflection->getName();
        $reflectionClass = new \ReflectionClass($className);
        $property = $reflectionClass->getProperty('globalMacros');

        $property->setAccessible(true);
        $macro = $property->getValue()[$methodName];

        return new Macro(
            $classReflection->getName(),
            $methodName,
            new \ReflectionFunction($macro)
        );
    }
}
