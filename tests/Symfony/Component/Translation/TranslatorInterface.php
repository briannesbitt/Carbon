<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation;

use Symfony\Contracts\Translation\TranslatorInterface as NewTranslatorInterface;

/**
 * @internal Fix the IDE auto-completion.
 */
interface TranslatorInterface extends NewTranslatorInterface
{
    // This is a polyfill for Symfony < 5 compatibility.
}
