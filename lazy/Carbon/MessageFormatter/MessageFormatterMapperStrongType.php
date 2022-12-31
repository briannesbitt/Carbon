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

use Symfony\Component\Translation\Formatter\MessageFormatter;
use Symfony\Component\Translation\Formatter\MessageFormatterInterface;

if (!class_exists(LazyMessageFormatter::class, false)) {
    abstract class LazyMessageFormatter implements MessageFormatterInterface
    {
        /**
         * Wrapped formatter.
         *
         * @var MessageFormatterInterface
         */
        private $formatter;

        public function __construct(?MessageFormatterInterface $formatter = null)
        {
            $this->formatter = $formatter ?? new MessageFormatter();
        }

        public function format(string $message, string $locale, array $parameters = []): string
        {
            return $this->formatter->format(
                $message,
                preg_replace('/[_@][A-Za-z][a-z]{2,}/', '', $locale),
                $parameters
            );
        }
    }
}
