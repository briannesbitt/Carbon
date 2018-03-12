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

        if (file_exists($filename = __DIR__.'/Lang/'.$locale.'.php')) {
            parent::setLocale($locale);
            $this->addResource('array', require $filename, $locale);

            return true;
        }

        return false;
    }
}
