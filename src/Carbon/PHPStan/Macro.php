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

use PHPStan\Reflection\Php\BuiltinMethodReflection;
use ReflectionMethod;

$method = new ReflectionMethod(BuiltinMethodReflection::class, 'getFileName');

if ($method->hasReturnType()) {
    final class Macro extends AbstractMacro
    {
        /**
         * {@inheritdoc}
         */
        public function getFileName(): string
        {
            return $this->reflectionFunction->getFileName();
        }

        /**
         * {@inheritdoc}
         */
        public function getStartLine(): ?int
        {
            return $this->reflectionFunction->getStartLine();
        }

        /**
         * {@inheritdoc}
         */
        public function getEndLine(): ?int
        {
            return $this->reflectionFunction->getEndLine();
        }
    }

    return;
}

final class Macro extends AbstractMacro
{
    /**
     * {@inheritdoc}
     *
     * @return string|false
     */
    public function getFileName()
    {
        return $this->reflectionFunction->getFileName();
    }

    /**
     * {@inheritdoc}
     *
     * @return int|false
     */
    public function getStartLine()
    {
        return $this->reflectionFunction->getStartLine();
    }

    /**
     * {@inheritdoc}
     *
     * @return int|false
     */
    public function getEndLine()
    {
        return $this->reflectionFunction->getEndLine();
    }
}
