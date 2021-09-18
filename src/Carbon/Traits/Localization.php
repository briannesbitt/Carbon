<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Traits;

use Carbon\CarbonInterface;
use Carbon\Exceptions\InvalidTypeException;
use Carbon\Exceptions\NotLocaleAwareException;
use Carbon\Language;
use Carbon\Translator;
use Closure;
use Symfony\Component\Translation\TranslatorBagInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Contracts\Translation\LocaleAwareInterface;
use Symfony\Contracts\Translation\TranslatorInterface as ContractsTranslatorInterface;

if (!interface_exists('Symfony\\Component\\Translation\\TranslatorInterface')) {
    class_alias(
        'Symfony\\Contracts\\Translation\\TranslatorInterface',
        'Symfony\\Component\\Translation\\TranslatorInterface'
    );
}

/**
 * Trait Localization.
 *
 * Embed default and locale translators and translation base methods.
 */
trait Localization
{
    /**
     * Default translator.
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected static $translator;

    /**
     * Specific translator of the current instance.
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $localTranslator;

    /**
     * Options for diffForHumans().
     *
     * @var int
     */
    protected static $humanDiffOptions = CarbonInterface::NO_ZERO_DIFF;

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     * @see settings
     *
     * @param int $humanDiffOptions
     */
    public static function setHumanDiffOptions($humanDiffOptions)
    {
        static::$humanDiffOptions = $humanDiffOptions;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     * @see settings
     *
     * @param int $humanDiffOption
     */
    public static function enableHumanDiffOption($humanDiffOption)
    {
        static::$humanDiffOptions = static::getHumanDiffOptions() | $humanDiffOption;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     * @see settings
     *
     * @param int $humanDiffOption
     */
    public static function disableHumanDiffOption($humanDiffOption)
    {
        static::$humanDiffOptions = static::getHumanDiffOptions() & ~$humanDiffOption;
    }

    /**
     * Return default humanDiff() options (merged flags as integer).
     *
     * @return int
     */
    public static function getHumanDiffOptions()
    {
        return static::$humanDiffOptions;
    }

    /**
     * Get the default translator instance in use.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }

    /**
     * Set the default translator instance to use.
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     *
     * @return void
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    /**
     * Return true if the current instance has its own translator.
     *
     * @return bool
     */
    public function hasLocalTranslator()
    {
        return isset($this->localTranslator);
    }

    /**
     * Get the translator of the current instance or the default if none set.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public function getLocalTranslator()
    {
        return $this->localTranslator ?: static::translator();
    }

    /**
     * Set the translator for the current instance.
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     *
     * @return $this
     */
    public function setLocalTranslator(TranslatorInterface $translator)
    {
        $this->localTranslator = $translator;

        return $this;
    }

    /**
     * Returns raw translation message for a given key.
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator the translator to use
     * @param string                                             $key        key to find
     * @param string|null                                        $locale     current locale used if null
     * @param string|null                                        $default    default value if translation returns the key
     *
     * @return string
     */
    public static function getTranslationMessageWith($translator, string $key, ?string $locale = null, ?string $default = null)
    {
        if (!($translator instanceof TranslatorBagInterface && $translator instanceof TranslatorInterface)) {
            throw new InvalidTypeException(
                'Translator does not implement '.TranslatorInterface::class.' and '.TranslatorBagInterface::class.'. '.
                (\is_object($translator) ? \get_class($translator) : \gettype($translator)).' has been given.'
            );
        }

        if (!$locale && $translator instanceof LocaleAwareInterface) {
            $locale = $translator->getLocale();
        }

        $result = $translator->getCatalogue($locale)->get($key);

        return $result === $key ? $default : $result;
    }

    /**
     * Returns raw translation message for a given key.
     *
     * @param string                                             $key        key to find
     * @param string|null                                        $locale     current locale used if null
     * @param string|null                                        $default    default value if translation returns the key
     * @param \Symfony\Component\Translation\TranslatorInterface $translator an optional translator to use
     *
     * @return string
     */
    public function getTranslationMessage(string $key, ?string $locale = null, ?string $default = null, $translator = null)
    {
        return static::getTranslationMessageWith($translator ?: $this->getLocalTranslator(), $key, $locale, $default);
    }

    /**
     * Translate using translation string or callback available.
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param string                                             $key
     * @param array                                              $parameters
     * @param null                                               $number
     *
     * @return string
     */
    public static function translateWith(TranslatorInterface $translator, string $key, array $parameters = [], $number = null): string
    {
        $message = static::getTranslationMessageWith($translator, $key, null, $key);
        if ($message instanceof Closure) {
            return (string) $message(...array_values($parameters));
        }

        if ($number !== null) {
            $parameters['%count%'] = $number;
        }
        if (isset($parameters['%count%'])) {
            $parameters[':count'] = $parameters['%count%'];
        }

        // @codeCoverageIgnoreStart
        $choice = $translator instanceof ContractsTranslatorInterface
            ? $translator->trans($key, $parameters)
            : $translator->transChoice($key, $number, $parameters);
        // @codeCoverageIgnoreEnd

        return (string) $choice;
    }

    /**
     * Translate using translation string or callback available.
     *
     * @param string                                                  $key
     * @param array                                                   $parameters
     * @param string|int|float|null                                   $number
     * @param \Symfony\Component\Translation\TranslatorInterface|null $translator
     * @param bool                                                    $altNumbers
     *
     * @return string
     */
    public function translate(string $key, array $parameters = [], $number = null, ?TranslatorInterface $translator = null, bool $altNumbers = false): string
    {
        $translation = static::translateWith($translator ?: $this->getLocalTranslator(), $key, $parameters, $number);

        if ($number !== null && $altNumbers) {
            return str_replace($number, $this->translateNumber($number), $translation);
        }

        return $translation;
    }

    /**
     * Returns the alternative number for a given integer if available in the current locale.
     *
     * @param int $number
     *
     * @return string
     */
    public function translateNumber(int $number): string
    {
        $translateKey = "alt_numbers.$number";
        $symbol = $this->translate($translateKey);

        if ($symbol !== $translateKey) {
            return $symbol;
        }

        if ($number > 99 && $this->translate('alt_numbers.99') !== 'alt_numbers.99') {
            $start = '';
            foreach ([10000, 1000, 100] as $exp) {
                $key = "alt_numbers_pow.$exp";
                if ($number >= $exp && $number < $exp * 10 && ($pow = $this->translate($key)) !== $key) {
                    $unit = floor($number / $exp);
                    $number -= $unit * $exp;
                    $start .= ($unit > 1 ? $this->translate("alt_numbers.$unit") : '').$pow;
                }
            }
            $result = '';
            while ($number) {
                $chunk = $number % 100;
                $result = $this->translate("alt_numbers.$chunk").$result;
                $number = floor($number / 100);
            }

            return "$start$result";
        }

        if ($number > 9 && $this->translate('alt_numbers.9') !== 'alt_numbers.9') {
            $result = '';
            while ($number) {
                $chunk = $number % 10;
                $result = $this->translate("alt_numbers.$chunk").$result;
                $number = floor($number / 10);
            }

            return $result;
        }

        return (string) $number;
    }

    /**
     * Translate a time string from a locale to an other.
     *
     * @param string      $timeString date/time/duration string to translate (may also contain English)
     * @param string|null $from       input locale of the $timeString parameter (`Carbon::getLocale()` by default)
     * @param string|null $to         output locale of the result returned (`"en"` by default)
     * @param int         $mode       specify what to translate with options:
     *                                - CarbonInterface::TRANSLATE_ALL (default)
     *                                - CarbonInterface::TRANSLATE_MONTHS
     *                                - CarbonInterface::TRANSLATE_DAYS
     *                                - CarbonInterface::TRANSLATE_UNITS
     *                                - CarbonInterface::TRANSLATE_MERIDIEM
     *                                You can use pipe to group: CarbonInterface::TRANSLATE_MONTHS | CarbonInterface::TRANSLATE_DAYS
     *
     * @return string
     */
    public static function translateTimeString($timeString, $from = null, $to = null, $mode = CarbonInterface::TRANSLATE_ALL)
    {
        // Fallback source and destination locales
        $from = $from ?: static::getLocale();
        $to = $to ?: 'en';

        if ($from === $to) {
            return $timeString;
        }

        // Standardize apostrophe
        $timeString = strtr($timeString, ['’' => "'"]);

        $fromTranslations = [];
        $toTranslations = [];

        foreach (['from', 'to'] as $key) {
            $language = $$key;
            $translator = Translator::get($language);
            $translations = $translator->getMessages();

            if (!isset($translations[$language])) {
                return $timeString;
            }

            $translationKey = $key.'Translations';
            $messages = $translations[$language];
            $months = $messages['months'] ?? [];
            $weekdays = $messages['weekdays'] ?? [];
            $meridiem = $messages['meridiem'] ?? ['AM', 'PM'];

            if ($key === 'from') {
                foreach (['months', 'weekdays'] as $variable) {
                    $list = $messages[$variable.'_standalone'] ?? null;

                    if ($list) {
                        foreach ($$variable as $index => &$name) {
                            $name .= '|'.$messages[$variable.'_standalone'][$index];
                        }
                    }
                }
            }

            $$translationKey = array_merge(
                $mode & CarbonInterface::TRANSLATE_MONTHS ? static::getTranslationArray($months, 12, $timeString) : [],
                $mode & CarbonInterface::TRANSLATE_MONTHS ? static::getTranslationArray($messages['months_short'] ?? [], 12, $timeString) : [],
                $mode & CarbonInterface::TRANSLATE_DAYS ? static::getTranslationArray($weekdays, 7, $timeString) : [],
                $mode & CarbonInterface::TRANSLATE_DAYS ? static::getTranslationArray($messages['weekdays_short'] ?? [], 7, $timeString) : [],
                $mode & CarbonInterface::TRANSLATE_DIFF ? static::translateWordsByKeys([
                    'diff_now',
                    'diff_today',
                    'diff_yesterday',
                    'diff_tomorrow',
                    'diff_before_yesterday',
                    'diff_after_tomorrow',
                ], $messages, $key) : [],
                $mode & CarbonInterface::TRANSLATE_UNITS ? static::translateWordsByKeys([
                    'year',
                    'month',
                    'week',
                    'day',
                    'hour',
                    'minute',
                    'second',
                ], $messages, $key) : [],
                $mode & CarbonInterface::TRANSLATE_MERIDIEM ? array_map(function ($hour) use ($meridiem) {
                    if (\is_array($meridiem)) {
                        return $meridiem[$hour < 12 ? 0 : 1];
                    }

                    return $meridiem($hour, 0, false);
                }, range(0, 23)) : []
            );
        }

        return substr(preg_replace_callback('/(?<=[\d\s+.\/,_-])('.implode('|', $fromTranslations).')(?=[\d\s+.\/,_-])/iu', function ($match) use ($fromTranslations, $toTranslations) {
            [$chunk] = $match;

            foreach ($fromTranslations as $index => $word) {
                if (preg_match("/^$word\$/iu", $chunk)) {
                    return $toTranslations[$index] ?? '';
                }
            }

            return $chunk; // @codeCoverageIgnore
        }, " $timeString "), 1, -1);
    }

    /**
     * Translate a time string from the current locale (`$date->locale()`) to an other.
     *
     * @param string      $timeString time string to translate
     * @param string|null $to         output locale of the result returned ("en" by default)
     *
     * @return string
     */
    public function translateTimeStringTo($timeString, $to = null)
    {
        return static::translateTimeString($timeString, $this->getTranslatorLocale(), $to);
    }

    /**
     * Get/set the locale for the current instance.
     *
     * @param string|null $locale
     * @param string      ...$fallbackLocales
     *
     * @return $this|string
     */
    public function locale(string $locale = null, ...$fallbackLocales)
    {
        if ($locale === null) {
            return $this->getTranslatorLocale();
        }

        if (!$this->localTranslator || $this->getTranslatorLocale($this->localTranslator) !== $locale) {
            $translator = Translator::get($locale);

            if (!empty($fallbackLocales)) {
                $translator->setFallbackLocales($fallbackLocales);

                foreach ($fallbackLocales as $fallbackLocale) {
                    $messages = Translator::get($fallbackLocale)->getMessages();

                    if (isset($messages[$fallbackLocale])) {
                        $translator->setMessages($fallbackLocale, $messages[$fallbackLocale]);
                    }
                }
            }

            $this->setLocalTranslator($translator);
        }

        return $this;
    }

    /**
     * Get the current translator locale.
     *
     * @return string
     */
    public static function getLocale()
    {
        return static::getLocaleAwareTranslator()->getLocale();
    }

    /**
     * Set the current translator locale and indicate if the source locale file exists.
     * Pass 'auto' as locale to use closest language from the current LC_TIME locale.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function setLocale($locale)
    {
        return static::getLocaleAwareTranslator()->setLocale($locale) !== false;
    }

    /**
     * Set the fallback locale.
     *
     * @see https://symfony.com/doc/current/components/translation.html#fallback-locales
     *
     * @param string $locale
     */
    public static function setFallbackLocale($locale)
    {
        $translator = static::getTranslator();

        if (method_exists($translator, 'setFallbackLocales')) {
            $translator->setFallbackLocales([$locale]);

            if ($translator instanceof Translator) {
                $preferredLocale = $translator->getLocale();
                $translator->setMessages($preferredLocale, array_replace_recursive(
                    $translator->getMessages()[$locale] ?? [],
                    Translator::get($locale)->getMessages()[$locale] ?? [],
                    $translator->getMessages($preferredLocale)
                ));
            }
        }
    }

    /**
     * Get the fallback locale.
     *
     * @see https://symfony.com/doc/current/components/translation.html#fallback-locales
     *
     * @return string|null
     */
    public static function getFallbackLocale()
    {
        $translator = static::getTranslator();

        if (method_exists($translator, 'getFallbackLocales')) {
            return $translator->getFallbackLocales()[0] ?? null;
        }

        return null;
    }

    /**
     * Set the current locale to the given, execute the passed function, reset the locale to previous one,
     * then return the result of the closure (or null if the closure was void).
     *
     * @param string   $locale locale ex. en
     * @param callable $func
     *
     * @return mixed
     */
    public static function executeWithLocale($locale, $func)
    {
        $currentLocale = static::getLocale();
        $result = $func(static::setLocale($locale) ? static::getLocale() : false, static::translator());
        static::setLocale($currentLocale);

        return $result;
    }

    /**
     * Returns true if the given locale is internally supported and has short-units support.
     * Support is considered enabled if either year, day or hour has a short variant translated.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function localeHasShortUnits($locale)
    {
        return static::executeWithLocale($locale, function ($newLocale, TranslatorInterface $translator) {
            return $newLocale &&
                (
                    ($y = static::translateWith($translator, 'y')) !== 'y' &&
                    $y !== static::translateWith($translator, 'year')
                ) || (
                    ($y = static::translateWith($translator, 'd')) !== 'd' &&
                    $y !== static::translateWith($translator, 'day')
                ) || (
                    ($y = static::translateWith($translator, 'h')) !== 'h' &&
                    $y !== static::translateWith($translator, 'hour')
                );
        });
    }

    /**
     * Returns true if the given locale is internally supported and has diff syntax support (ago, from now, before, after).
     * Support is considered enabled if the 4 sentences are translated in the given locale.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function localeHasDiffSyntax($locale)
    {
        return static::executeWithLocale($locale, function ($newLocale, TranslatorInterface $translator) {
            if (!$newLocale) {
                return false;
            }

            foreach (['ago', 'from_now', 'before', 'after'] as $key) {
                if ($translator instanceof TranslatorBagInterface && $translator->getCatalogue($newLocale)->get($key) instanceof Closure) {
                    continue;
                }

                if ($translator->trans($key) === $key) {
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * Returns true if the given locale is internally supported and has words for 1-day diff (just now, yesterday, tomorrow).
     * Support is considered enabled if the 3 words are translated in the given locale.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function localeHasDiffOneDayWords($locale)
    {
        return static::executeWithLocale($locale, function ($newLocale, TranslatorInterface $translator) {
            return $newLocale &&
                $translator->trans('diff_now') !== 'diff_now' &&
                $translator->trans('diff_yesterday') !== 'diff_yesterday' &&
                $translator->trans('diff_tomorrow') !== 'diff_tomorrow';
        });
    }

    /**
     * Returns true if the given locale is internally supported and has words for 2-days diff (before yesterday, after tomorrow).
     * Support is considered enabled if the 2 words are translated in the given locale.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function localeHasDiffTwoDayWords($locale)
    {
        return static::executeWithLocale($locale, function ($newLocale, TranslatorInterface $translator) {
            return $newLocale &&
                $translator->trans('diff_before_yesterday') !== 'diff_before_yesterday' &&
                $translator->trans('diff_after_tomorrow') !== 'diff_after_tomorrow';
        });
    }

    /**
     * Returns true if the given locale is internally supported and has period syntax support (X times, every X, from X, to X).
     * Support is considered enabled if the 4 sentences are translated in the given locale.
     *
     * @param string $locale locale ex. en
     *
     * @return bool
     */
    public static function localeHasPeriodSyntax($locale)
    {
        return static::executeWithLocale($locale, function ($newLocale, TranslatorInterface $translator) {
            return $newLocale &&
                $translator->trans('period_recurrences') !== 'period_recurrences' &&
                $translator->trans('period_interval') !== 'period_interval' &&
                $translator->trans('period_start_date') !== 'period_start_date' &&
                $translator->trans('period_end_date') !== 'period_end_date';
        });
    }

    /**
     * Returns the list of internally available locales and already loaded custom locales.
     * (It will ignore custom translator dynamic loading.)
     *
     * @return array
     */
    public static function getAvailableLocales()
    {
        $translator = static::getLocaleAwareTranslator();

        return $translator instanceof Translator
            ? $translator->getAvailableLocales()
            : [$translator->getLocale()];
    }

    /**
     * Returns list of Language object for each available locale. This object allow you to get the ISO name, native
     * name, region and variant of the locale.
     *
     * @return Language[]
     */
    public static function getAvailableLocalesInfo()
    {
        $languages = [];
        foreach (static::getAvailableLocales() as $id) {
            $languages[$id] = new Language($id);
        }

        return $languages;
    }

    /**
     * Initialize the default translator instance if necessary.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected static function translator()
    {
        if (static::$translator === null) {
            static::$translator = Translator::get();
        }

        return static::$translator;
    }

    /**
     * Get the locale of a given translator.
     *
     * If null or omitted, current local translator is used.
     * If no local translator is in use, current global translator is used.
     *
     * @param null $translator
     *
     * @return string|null
     */
    protected function getTranslatorLocale($translator = null): ?string
    {
        if (\func_num_args() === 0) {
            $translator = $this->getLocalTranslator();
        }

        $translator = static::getLocaleAwareTranslator($translator);

        return $translator ? $translator->getLocale() : null;
    }

    /**
     * Throw an error if passed object is not LocaleAwareInterface.
     *
     * @param LocaleAwareInterface|null $translator
     *
     * @return LocaleAwareInterface|null
     */
    protected static function getLocaleAwareTranslator($translator = null)
    {
        if (\func_num_args() === 0) {
            $translator = static::translator();
        }

        if ($translator && !($translator instanceof LocaleAwareInterface || method_exists($translator, 'getLocale'))) {
            throw new NotLocaleAwareException($translator);
        }

        return $translator;
    }

    /**
     * Return the word cleaned from its translation codes.
     *
     * @param string $word
     *
     * @return string
     */
    private static function cleanWordFromTranslationString($word)
    {
        $word = str_replace([':count', '%count', ':time'], '', $word);
        $word = strtr($word, ['’' => "'"]);
        $word = preg_replace('/({\d+(,(\d+|Inf))?}|[\[\]]\d+(,(\d+|Inf))?[\[\]])/', '', $word);

        return trim($word);
    }

    /**
     * Translate a list of words.
     *
     * @param string[] $keys     keys to translate.
     * @param string[] $messages messages bag handling translations.
     * @param string   $key      'to' (to get the translation) or 'from' (to get the detection RegExp pattern).
     *
     * @return string[]
     */
    private static function translateWordsByKeys($keys, $messages, $key): array
    {
        return array_map(function ($wordKey) use ($messages, $key) {
            $message = $key === 'from' && isset($messages[$wordKey.'_regexp'])
                ? $messages[$wordKey.'_regexp']
                : ($messages[$wordKey] ?? null);

            if (!$message) {
                return '>>DO NOT REPLACE<<';
            }

            $parts = explode('|', $message);

            return $key === 'to'
                ? static::cleanWordFromTranslationString(end($parts))
                : '(?:'.implode('|', array_map([static::class, 'cleanWordFromTranslationString'], $parts)).')';
        }, $keys);
    }

    /**
     * Get an array of translations based on the current date.
     *
     * @param callable $translation
     * @param int      $length
     * @param string   $timeString
     *
     * @return string[]
     */
    private static function getTranslationArray($translation, $length, $timeString): array
    {
        $filler = '>>DO NOT REPLACE<<';

        if (\is_array($translation)) {
            return array_pad($translation, $length, $filler);
        }

        $list = [];
        $date = static::now();

        for ($i = 0; $i < $length; $i++) {
            $list[] = $translation($date, $timeString, $i) ?? $filler;
        }

        return $list;
    }
}
