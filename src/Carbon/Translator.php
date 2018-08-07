<?php

namespace Carbon;

use Closure;
use Symfony\Component\Translation;

class Translator extends Translation\Translator
{
    /**
     * Translator singletons for each language.
     *
     * @var array
     */
    protected static $singletons = [];

    /**
     * List of custom localized messages.
     *
     * @var array
     */
    protected $messages = [];

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
        $locale = $locale ?: 'en';

        if (!isset(static::$singletons[$locale])) {
            static::$singletons[$locale] = new static($locale ?: 'en');
        }

        return static::$singletons[$locale];
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
     * @param string $directory directory path
     *
     * @return $this
     */
    public function removeDirectory(string $directory)
    {
        $search = rtrim(strtr($directory, '\\', '/'), '/');

        return $this->setDirectories(array_filter($this->getDirectories(), function ($item) use ($search) {
            return rtrim(strtr($item, '\\', '/'), '/') !== $search;
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
            $this->messages = [];

            return true;
        }

        foreach ($this->getDirectories() as $directory) {
            $directory = rtrim($directory, '\\/');
            if (file_exists($filename = "$directory/$locale.php")) {
                $this->messages[$locale] = require $filename;
                $this->addResource('array', $this->messages[$locale], $locale);

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

        return array_unique(array_merge($locales, array_keys($this->messages)));
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
        if (isset($this->messages[$locale])) {
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
        $this->messages[$locale] = array_merge(
            isset($this->messages[$locale]) ? $this->messages[$locale] : [],
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
        return $locale === null ? $this->messages : $this->messages[$locale];
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

        if ($this->getLocale() === $locale) {
            return true;
        }

        if ($locale === 'auto') {
            $completeLocale = setlocale(LC_TIME, 0);
            $locale = preg_replace('/^([^_.-]+).*$/', '$1', $completeLocale);
            $locales = $this->getAvailableLocales($locale);

            $completeLocaleChunks = preg_split('/[_.-]+/', $completeLocale);
            $getScore = function ($language) use ($completeLocaleChunks) {
                $chunks = preg_split('/[_.-]+/', $language);
                $score = 0;
                foreach ($completeLocaleChunks as $index => $chunk) {
                    if (!isset($chunks[$index])) {
                        $score++;

                        continue;
                    }
                    if (strtolower($chunks[$index]) === strtolower($chunk)) {
                        $score += 10;
                    }
                }

                return $score;
            };
            usort($locales, function ($a, $b) use ($getScore) {
                $a = $getScore($a);
                $b = $getScore($b);

                if ($a === $b) {
                    return 0;
                }

                return $a < $b ? 1 : -1;
            });
            $locale = $locales[0];
        }

        // If subtag (ex: en_CA) first load the macro (ex: en) to have a fallback
        if (strpos($locale, '_') !== false) {
            if ($this->loadMessagesFromFile($macroLocale = preg_replace('/^([^_]+).*$/', '$1', $locale))) {
                parent::setLocale($macroLocale);
            }
        }

        if ($this->loadMessagesFromFile($locale)) {
            parent::setLocale($locale);

            return true;
        }

        return false;
    }
}
