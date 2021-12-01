<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use ReflectionMethod;
use Symfony\Contracts\Translation\TranslatorInterface;

$transMethod = new ReflectionMethod(TranslatorInterface::class, 'trans');

require $transMethod->hasReturnType()
    ? __DIR__ . '/TranslatorStrongType.php'
    : __DIR__ . '/TranslatorWeakType.php';
