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

use PHPStan\BetterReflection\Reflection;
use ReflectionMethod;

if (!class_exists(AbstractReflectionMacro::class, false)) {
    abstract class AbstractReflectionMacro extends AbstractMacro
    {
        /**
         * {@inheritdoc}
         */
        public function getReflection(): ?Reflection\Adapter\ReflectionMethod
        {
            if ($this->reflectionFunction instanceof Reflection\Adapter\ReflectionMethod) {
                return $this->reflectionFunction;
            }

            return $this->reflectionFunction instanceof ReflectionMethod
                ? new Reflection\Adapter\ReflectionMethod(
                    Reflection\ReflectionMethod::createFromName(
                        $this->reflectionFunction->getDeclaringClass()->getName(),
                        $this->reflectionFunction->getName()
                    )
                )
                : null;
        }
    }
}
