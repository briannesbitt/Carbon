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

namespace Carbon;

use Carbon\MessageFormatter\MessageFormatterMapper;
use Closure;
use ReflectionException;
use ReflectionFunction;
use ReflectionProperty;
use Symfony\Component\Translation\Formatter\MessageFormatterInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator as SymfonyTranslator;
use Throwable;

abstract class AbstractTranslator extends SymfonyTranslator
{
    public const REGION_CODE_LENGTH = 2;

    /**
     * Translator singletons for each language.
     *
     * @var array
     */
    protected static array $singletons = [];

    /**
     * List of custom localized messages.
     *
     * @var array
     */
    protected array $messages = [];

    /**
     * List of custom directories that contain translation files.
     *
     * @var string[]
     */
    protected array $directories = [];

    /**
     * Set to true while constructing.
     */
    protected bool $initializing = false;

    /**
     * List of locales aliases.
     *
     * @var array<string, string>
     */
    protected array $aliases = [
        'me' => 'sr_Latn_ME',
        'scr' => 'sh',
    ];

    /**
     * Return a singleton instance of Translator.
     *
     * @param string|null $locale optional initial locale ("en" - english by default)
     *
     * @return static
     */
    public static function get(?string $locale = null): static
    {
        $locale = $locale ?: 'en';
        $key = static::class === Translator::class ? $locale : static::class.'|'.$locale;
        $count = \count(static::$singletons);

        // Remember only the last 10 translators created
        if ($count > 10) {
            foreach (\array_slice(array_keys(static::$singletons), 0, $count - 10) as $index) {
                unset(static::$singletons[$index]);
            }
        }

        static::$singletons[$key] ??= new static($locale);

        return static::$singletons[$key];
    }

    public function __construct($locale, ?MessageFormatterInterface $formatter = null, $cacheDir = null, $debug = false)
    {
        $this->initialize($locale, $formatter, $cacheDir, $debug);
    }

    /**
     * Returns the list of directories translation files are searched in.
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
    public function setDirectories(array $directories): static
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
    public function addDirectory(string $directory): static
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
    public function removeDirectory(string $directory): static
    {
        $search = rtrim(strtr($directory, '\\', '/'), '/');

        return $this->setDirectories(array_filter(
            $this->getDirectories(),
            static fn ($item) => rtrim(strtr($item, '\\', '/'), '/') !== $search,
        ));
    }

    /**
     * Reset messages of a locale (all locale if no locale passed).
     * Remove custom messages and reload initial messages from matching
     * file in Lang directory.
     */
    public function resetMessages(?string $locale = null): bool
    {
        if ($locale === null) {
            $this->messages = [];
            $this->catalogues = [];
            $this->modifyResources(static function (array $resources): array {
                foreach ($resources as &$list) {
                    array_splice($list, 1);
                }

                return $resources;
            });

            return true;
        }

        $this->assertValidLocale($locale);

        foreach ($this->getDirectories() as $directory) {
            $file = \sprintf('%s/%s.php', rtrim($directory, '\\/'), $locale);
            $data = @include $file;

            if ($data !== false) {
                $this->messages[$locale] = $data;
                unset($this->catalogues[$locale]);
                $this->modifyResources(static function (array $resources) use ($locale): array {
                    unset($resources[$locale]);

                    return $resources;
                });
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
    public function getLocalesFiles(string $prefix = ''): array
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
    public function getAvailableLocales(string $prefix = ''): array
    {
        $locales = [];
        foreach ($this->getLocalesFiles($prefix) as $file) {
            $locales[] = substr($file, strrpos($file, '/') + 1, -4);
        }

        return array_unique(array_merge($locales, array_keys($this->messages)));
    }

    protected function translate(?string $id, array $parameters = [], ?string $domain = null, ?string $locale = null): string
    {
        if ($domain === null) {
            $domain = 'messages';
        }

        $catalogue = $this->getCatalogue($locale);
        $format = $this instanceof TranslatorStrongTypeInterface
            ? $this->getFromCatalogue($catalogue, (string) $id, $domain)
            : $this->getCatalogue($locale)->get((string) $id, $domain); // @codeCoverageIgnore

        if ($format instanceof Closure) {
            // @codeCoverageIgnoreStart
            try {
                $count = (new ReflectionFunction($format))->getNumberOfRequiredParameters();
            } catch (ReflectionException) {
                $count = 0;
            }
            // @codeCoverageIgnoreEnd

            return $format(
                ...array_values($parameters),
                ...array_fill(0, max(0, $count - \count($parameters)), null)
            );
        }

        return parent::trans($id, $parameters, $domain, $locale);
    }

    /**
     * Init messages language from matching file in Lang directory.
     *
     * @param string $locale
     *
     * @return bool
     */
    protected function loadMessagesFromFile(string $locale): bool
    {
        return isset($this->messages[$locale]) || $this->resetMessages($locale);
    }

    /**
     * Set messages of a locale and take file first if present.
     *
     * @param string $locale
     * @param array  $messages
     *
     * @return $this
     */
    public function setMessages(string $locale, array $messages): static
    {
        $this->loadMessagesFromFile($locale);
        $this->addResource('array', $messages, $locale);
        $this->messages[$locale] = array_merge(
            $this->messages[$locale] ?? [],
            $messages
        );

        return $this;
    }

    /**
     * Set messages of the current locale and take file first if present.
     *
     * @param array $messages
     *
     * @return $this
     */
    public function setTranslations(array $messages): static
    {
        return $this->setMessages($this->getLocale(), $messages);
    }

    /**
     * Get messages of a locale, if none given, return all the
     * languages.
     */
    public function getMessages(?string $locale = null): array
    {
        return $locale === null ? $this->messages : $this->messages[$locale];
    }

    /**
     * Set the current translator locale and indicate if the source locale file exists
     *
     * @param string $locale locale ex. en
     */
    public function setLocale($locale): void
    {
        $locale = preg_replace_callback('/[-_]([a-z]{2,}|\d{2,})/', function ($matches) {
            // _2-letters or YUE is a region, _3+-letters is a variant
            $upper = strtoupper($matches[1]);

            if ($upper === 'YUE' || $upper === 'ISO' || \strlen($upper) <= static::REGION_CODE_LENGTH) {
                return "_$upper";
            }

            return '_'.ucfirst($matches[1]);
        }, strtolower($locale));

        $previousLocale = $this->getLocale();

        if ($previousLocale === $locale && isset($this->messages[$locale])) {
            return;
        }

        unset(static::$singletons[$previousLocale]);

        if ($locale === 'auto') {
            $completeLocale = setlocale(LC_TIME, '0');
            $locale = preg_replace('/^([^_.-]+).*$/', '$1', $completeLocale);
            $locales = $this->getAvailableLocales($locale);

            $completeLocaleChunks = preg_split('/[_.-]+/', $completeLocale);

            $getScore = static fn ($language) => self::compareChunkLists(
                $completeLocaleChunks,
                preg_split('/[_.-]+/', $language),
            );

            usort($locales, static fn ($first, $second) => $getScore($second) <=> $getScore($first));

            $locale = $locales[0];
        }

        if (isset($this->aliases[$locale])) {
            $locale = $this->aliases[$locale];
        }

        // If subtag (ex: en_CA) first load the macro (ex: en) to have a fallback
        if (str_contains($locale, '_') &&
            $this->loadMessagesFromFile($macroLocale = preg_replace('/^([^_]+).*$/', '$1', $locale))
        ) {
            parent::setLocale($macroLocale);
        }

        if (!$this->loadMessagesFromFile($locale) && !$this->initializing) {
            return;
        }

        parent::setLocale($locale);
    }

    /**
     * Show locale on var_dump().
     *
     * @return array
     */
    public function __debugInfo()
    {
        return [
            'locale' => $this->getLocale(),
        ];
    }

    public function __serialize(): array
    {
        return [
            'locale' => $this->getLocale(),
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->initialize($data['locale'] ?? 'en');
    }

    private function initialize($locale, ?MessageFormatterInterface $formatter = null, $cacheDir = null, $debug = false): void
    {
        parent::setLocale($locale);
        $this->initializing = true;
        $this->directories = [__DIR__.'/Lang'];
        $this->addLoader('array', new ArrayLoader());
        parent::__construct($locale, new MessageFormatterMapper($formatter), $cacheDir, $debug);
        $this->initializing = false;
    }

    private static function compareChunkLists($referenceChunks, $chunks)
    {
        $score = 0;

        foreach ($referenceChunks as $index => $chunk) {
            if (!isset($chunks[$index])) {
                $score++;

                continue;
            }

            if (strtolower($chunks[$index]) === strtolower($chunk)) {
                $score += 10;
            }
        }

        return $score;
    }

    /** @codeCoverageIgnore */
    private function modifyResources(callable $callback): void
    {
        try {
            $resourcesProperty = new ReflectionProperty(SymfonyTranslator::class, 'resources');
            $resources = $resourcesProperty->getValue($this);
            $resourcesProperty->setValue($this, $callback($resources));
        } catch (Throwable) {
            // Clear resources if available, if not, then nothing to clean
        }
    }
}
