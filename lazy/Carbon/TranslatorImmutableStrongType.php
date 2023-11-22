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

use Symfony\Component\Config\ConfigCacheFactoryInterface;
use Symfony\Component\Translation\Exception\InvalidArgumentException;

if (!class_exists(LazyTranslatorImmutable::class, false)) {
    class LazyTranslatorImmutable extends AbstractTranslatorImmutable
    {
        /**
         * @throws InvalidArgumentException
         */
        public function setLocale(string $locale): void
        {
            $this->setLocaleIdentifier($locale);
        }

        public function setConfigCacheFactory(ConfigCacheFactoryInterface $configCacheFactory): void
        {
            $this->setConfigCacheFactoryObject($configCacheFactory);
        }

        public function setFallbackLocales(array $locales): void
        {
            $this->setFallbackLocalesArray($locales);
        }
    }
}
