<?php

namespace Carbon;

use Closure;
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
    protected static $messages = [];

    /**
     * List of custom directories that contain translation files.
     *
     * @var array
     */
    protected $directories = [];

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
        $this->directories = [__DIR__.'/Lang'];
        $this->addLoader('array', new Translation\Loader\ArrayLoader());
        parent::__construct($locale, $formatter, $cacheDir, $debug);
    }

    /**
     * Returns the list of directories translation files are searched in.
     *
     * @return array
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }

    /**
     * Set list of directories translation files are searched in.
     *
     * @param array $directories new directories list
     *
     * @return $this
     */
    public function setDirectories(array $directories)
    {
        $this->directories = $directories;

        return $this;
    }

    /**
     * Add a directory to the list translation files are searched in.
     *
     * @param string $directory new directory
     *
     * @return $this
     */
    public function addDirectory(string $directory)
    {
        $this->directories[] = $directory;

        return $this;
    }

    /**
     * Remove a directory from the list translation files are searched in.
     *
     * @param string $directories directory path
     *
     * @return $this
     */
    public function removeDirectory(string $directory)
    {
        $search = rtrim(preg_replace('\\', '/', $directory), '/');

        return $this->setDirectories(array_filter($this->getDirectories(), function ($item) use ($search) {
            return rtrim(preg_replace('\\', '/', $item), '/') !== $search;
        }));
    }

    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        if (null === $domain) {
            $domain = 'messages';
        }

        $format = $this->getCatalogue($locale)->get((string) $id, $domain);

        if ($format instanceof Closure) {
            return $format(...array_values($parameters));
        }

        return parent::trans($id, $parameters, $domain, $locale);
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
            static::$messages = [];

            return true;
        }

        foreach ($this->getDirectories() as $directory) {
            $directory = rtrim($directory, '\\/');
            if (file_exists($filename = "$directory/$locale.php")) {
                static::$messages[$locale] = require $filename;
                $this->addResource('array', static::$messages[$locale], $locale);

                return true;
            }
        }

        return false;
    }

    /**
     * Returns the list of files matching a given locale prefix (or all if empty).
     *
     * @param string $prefix prefix required to filter result
     *
     * @return array
     */
    public function getLocalesFiles($prefix = '')
    {
        $files = [];
        foreach ($this->getDirectories() as $directory) {
            $directory = rtrim($directory, '\\/');
            foreach (glob("$directory/$prefix*.php") as $file) {
                $files[] = $file;
            }
        }

        return array_unique($files);
    }

    /**
     * Returns the list of internally available locales and already loaded custom locales.
     * (It will ignore custom translator dynamic loading.)
     *
     * @param string $prefix prefix required to filter result
     *
     * @return array
     */
    public function getAvailableLocales($prefix = '')
    {
        $locales = [];
        foreach ($this->getLocalesFiles($prefix) as $file) {
            $locales[] = substr($file, strrpos($file, '/') + 1, -4);
        }

        return array_unique(array_merge($locales, array_keys(static::$messages)));
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
            isset(static::$messages[$locale]) ? static::$messages[$locale] : [],
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
