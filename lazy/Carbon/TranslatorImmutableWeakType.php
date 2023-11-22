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

if (!class_exists(LazyTranslatorImmutable::class, false)) {
    class LazyTranslatorImmutable extends AbstractTranslatorImmutable
    {
        public function setLocale($locale)
        {
            $this->setLocaleIdentifier($locale);
        }

        public function setConfigCacheFactory(ConfigCacheFactoryInterface $configCacheFactory)
        {
            $this->setConfigCacheFactoryObject($configCacheFactory);
        }

        public function setFallbackLocales(array $locales)
        {
            $this->setFallbackLocalesArray($locales);
        }
    }
}
