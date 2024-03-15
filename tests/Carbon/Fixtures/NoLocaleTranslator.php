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

namespace Tests\Carbon\Fixtures;

use Carbon\Exceptions\NotLocaleAwareException;
use ReflectionMethod;
use Symfony\Component\Translation;
use Symfony\Contracts\Translation\TranslatorInterface;

$transMethod = new ReflectionMethod(
    class_exists(TranslatorInterface::class)
        ? TranslatorInterface::class
        : Translation\Translator::class,
    'trans',
);

if ($transMethod->hasReturnType()) {
    class NoLocaleTranslator implements TranslatorInterface
    {
        public function trans(string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
        {
            return $id;
        }

        public function getLocale(): string
        {
            throw new NotLocaleAwareException($this);
        }
    }

    return;
}

class NoLocaleTranslator implements TranslatorInterface
{
    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $id;
    }
}
