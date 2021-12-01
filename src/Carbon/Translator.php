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

use Closure;
use ReflectionException;
use ReflectionFunction;
use Symfony\Component\Translation;
use Symfony\Component\HttpKernel\Kernel;

if (Kernel::VERSION_ID < 60000) {
    class Translator extends AbstractTranslator
    {
        /**
         * Returns the translation.
         *
         * @param string $id
         * @param array $parameters
         * @param string $domain
         * @param string $locale
         *
         * @return string
         */
        public function trans($id, array $parameters = [], $domain = null, $locale = null)
        {
            return parent::trans($id, $parameters, $domain, $locale);
        }
    }
}
else
{
    class Translator extends AbstractTranslator
    {
        public function trans(?string $id, array $parameters = [], string $domain = null, string $locale = null): string
        {
            return parent::trans($id, $parameters, $domain, $locale);
        }
    }
}
