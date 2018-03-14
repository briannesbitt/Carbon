<?php

namespace Carbon;

use Symfony\Component\Translation;

class Translator extends Translation\Translator
{
    /**
     * Singleton for Translator.
     *
     * @var static
     */
    protected static $singleton;

    /**
     * List of custom localized messages.
     *
     * @var array
     */
    protected static $messages = array();

    /**
     * Return a singleton instance of Translator.
     *
     * @param string|null $locale optional initial locale ("en" - english by default)
     *
     * @return static
     */
    public static function get($locale = null)
    {
        if (static::$singleton === null) {
            static::$singleton = new static($locale ?: 'en');
        }

        return static::$singleton;
    }

    public function __construct($locale, Translation\Formatter\MessageFormatterInterface $formatter = null, $cacheDir = null, $debug = false)
    {
        $this->addLoader('array', new Translation\Loader\ArrayLoader());
        parent::__construct($locale, $formatter, $cacheDir, $debug);
    }

    /**
     * Reset messages of a locale (all locale if no locale passed).
     * Remove custom messages and reload initial messages from matching
     * file in Lang directory.
     *
     * @param string|null $locale
     *
     * @return bool
     */
    public function resetMessages($locale = null)
    {
        if ($locale === null) {
            static::$messages = array();

            return true;
        }

        if (file_exists($filename = __DIR__.'/Lang/'.$locale.'.php')) {
            static::$messages[$locale] = require $filename;
            $this->addResource('array', static::$messages[$locale], $locale);

            return true;
        }

        return false;
    }

    /**
     * Init messages language from matching file in Lang directory.
     *
     * @param string $locale
     *
     * @return bool
     */
    protected function loadMessagesFromFile($locale)
    {
        if (isset(static::$messages[$locale])) {
            return true;
        }

        return $this->resetMessages($locale);
    }

    /**
     * Set messages of a locale and take file first if present.
     *
     * @param string $locale
     * @param array  $messages
     *
     * @return $this
     */
    public function setMessages($locale, $messages)
    {
        $this->loadMessagesFromFile($locale);
        $this->addResource('array', $messages, $locale);
        static::$messages[$locale] = array_merge(
            isset(static::$messages[$locale]) ? static::$messages[$locale] : array(),
            $messages
        );

        return $this;
    }

    /**
     * Get messages of a locale, if none given, return all the
     * languages.
     *
     * @param string|null $locale
     *
     * @return array
     */
    public function getMessages($locale = null)
    {
        return $locale === null ? static::$messages : static::$messages[$locale];
    }

    /**
     * Set the current translator locale and indicate if the source locale file exists
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public function setLocale($locale)
    {
        $locale = preg_replace_callback('/[-_]([a-z]{2,})/', function ($matches) {
            // _2-letters is a region, _3+-letters is a variant
            return '_'.call_user_func(strlen($matches[1]) > 2 ? 'ucfirst' : 'strtoupper', $matches[1]);
        }, strtolower($locale));

        if ($this->loadMessagesFromFile($locale)) {
            parent::setLocale($locale);

            return true;
        }

        return false;
    }
}
