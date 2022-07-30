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

use PHPStan\BetterReflection\Reflection\Adapter;
use PHPStan\Reflection\Php\BuiltinMethodReflection;
use ReflectionMethod;

$method = new ReflectionMethod(BuiltinMethodReflection::class, 'getReflection');

require $method->hasReturnType() && $method->getReturnType()->getName() === Adapter\ReflectionMethod::class
    ? __DIR__.'/../../../lazy/Carbon/PHPStan/AbstractMacroStatic.php'
    : __DIR__.'/../../../lazy/Carbon/PHPStan/AbstractMacroBuiltin.php';

$method = new ReflectionMethod(BuiltinMethodReflection::class, 'getFileName');

require $method->hasReturnType()
    ? __DIR__.'/../../../lazy/Carbon/PHPStan/MacroStrongType.php'
    : __DIR__.'/../../../lazy/Carbon/PHPStan/MacroWeakType.php';

final class Macro extends LazyMacro
{
}
