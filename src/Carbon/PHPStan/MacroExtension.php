<?php

namespace Carbon\PHPStan;

use Carbon\CarbonInterface;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\BrokerAwareExtension;
use PHPStan\Reflection\Php\PhpMethodReflectionFactory;
use PHPStan\Reflection\MethodsClassReflectionExtension;

/**
 * @internal
 */
final class Extension implements MethodsClassReflectionExtension, BrokerAwareExtension
{
    /**
     * @var \PHPStan\Reflection\Php\PhpMethodReflectionFactory
     */
    protected $methodReflectionFactory;

    /**
     * Extension constructor.
     *
     * @param \PHPStan\Reflection\Php\PhpMethodReflectionFactory $methodReflectionFactory
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
        if(!$classReflection->implements(CarbonInterface::class)) {
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
        $property = $classReflection->getProperty('globalMacros');
        $property->setAccessible(true);
        $macro = $property->getValue()[$methodName];

        return new Macro(
            $classReflection->getName(),
            $methodName,
            new \ReflectionFunction($macro)
        );
    }
}
