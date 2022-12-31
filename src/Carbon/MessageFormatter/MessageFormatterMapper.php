<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\MessageFormatter;

use ReflectionMethod;
use Symfony\Component\Translation\Formatter\MessageFormatterInterface;

$transMethod = new ReflectionMethod(MessageFormatterInterface::class, 'format');

require $transMethod->getParameters()[0]->hasType()
    ? __DIR__.'/../../../lazy/Carbon/MessageFormatter/MessageFormatterMapperStrongType.php'
    : __DIR__.'/../../../lazy/Carbon/MessageFormatter/MessageFormatterMapperWeakType.php';

final class MessageFormatterMapper extends LazyMessageFormatter
{
}
