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
use Carbon\Language;
use Carbon\Translator;
use Closure;
use InvalidArgumentException;
use Symfony\Component\Translation\TranslatorBagInterface;
use Symfony\Component\Translation\TranslatorInterface;

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
    public static function getTranslationMessageWith($translator, string $key, string $locale = null, string $default = null)
    {
        if (!($translator instanceof TranslatorBagInterface && $translator instanceof TranslatorInterface)) {
            throw new InvalidArgumentException(
                'Translator does not implement '.TranslatorInterface::class.' and '.TranslatorBagInterface::class.'.'
            );
        }

        $result = $translator->getCatalogue($locale ?? $translator->getLocale())->get($key);

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
    public function getTranslationMessage(string $key, string $locale = null, string $default = null, $translator = null)
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
            return $message(...array_values($parameters));
        }

        if ($number !== null) {
            $parameters['%count%'] = $number;
        }
        if (isset($parameters['%count%'])) {
            $parameters[':count'] = $parameters['%count%'];
        }

        return $translator->transChoice($key, $number, $parameters);
    }

    /**
     * Translate using translation string or callback available.
     *
     * @param string                                             $key
     * @param array                                              $parameters
     * @param null                                               $number
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     *
     * @return string
     */
    public function translate(string $key, array $parameters = [], $number = null, TranslatorInterface $translator = null): string
    {
        return static::translateWith($translator ?: $this->getLocalTranslator(), $key, $parameters, $number);
    }

    /**
     * Translate a time string from a locale to an other.
     *
     * @param string      $timeString time string to translate
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
        $from = $from ?: static::getLocale();
        $to = $to ?: 'en';

        if ($from === $to) {
            return $timeString;
        }

        $cleanWord = function ($word) {
            $word = str_replace([':count', '%count', ':time'], '', $word);
            $word = preg_replace('/({\d+(,(\d+|Inf))?}|[\[\]]\d+(,(\d+|Inf))?[\[\]])/', '', $word);

            return trim($word);
        };

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
            $months = $messages['months'];
            $weekdays = $messages['weekdays'];
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
                $mode & CarbonInterface::TRANSLATE_MONTHS ? array_pad($months, 12, '>>DO NOT REPLACE<<') : [],
                $mode & CarbonInterface::TRANSLATE_MONTHS ? array_pad($messages['months_short'], 12, '>>DO NOT REPLACE<<') : [],
                $mode & CarbonInterface::TRANSLATE_DAYS ? array_pad($weekdays, 7, '>>DO NOT REPLACE<<') : [],
                $mode & CarbonInterface::TRANSLATE_DAYS ? array_pad($messages['weekdays_short'], 7, '>>DO NOT REPLACE<<') : [],
                $mode & CarbonInterface::TRANSLATE_UNITS ? array_map(function ($unit) use ($messages, $key, $cleanWord) {
                    $parts = explode('|', $messages[$unit]);

                    return $key === 'to'
                        ? $cleanWord(end($parts))
                        : '(?:'.implode('|', array_map($cleanWord, $parts)).')';
                }, [
                    'year',
                    'month',
                    'week',
                    'day',
                    'hour',
                    'minute',
                    'second',
                ]) : [],
                $mode & CarbonInterface::TRANSLATE_MERIDIEM ? array_map(function ($hour) use ($meridiem) {
                    if (is_array($meridiem)) {
                        return $meridiem[$hour < 12 ? 0 : 1];
                    }

                    return $meridiem($hour, 0, false);
                }, range(0, 23)) : []
            );
        }

        return substr(preg_replace_callback('/(?<=[\d\s+.\/,_-])('.implode('|', $fromTranslations).')(?=[\d\s+.\/,_-])/i', function ($match) use ($fromTranslations, $toTranslations) {
            [$chunk] = $match;

            foreach ($fromTranslations as $index => $word) {
                if (preg_match("/^$word\$/i", $chunk)) {
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
        return static::translateTimeString($timeString, $this->getLocalTranslator()->getLocale(), $to);
    }

    /**
     * Get/set the locale for the current instance.
     *
     * @param string|null $locale
     * @param string[]    ...$fallbackLocales
     *
     * @return $this|string
     */
    public function locale(string $locale = null, ...$fallbackLocales)
    {
        if ($locale === null) {
            return $this->getLocalTranslator()->getLocale();
        }

        if (!$this->localTranslator || $this->localTranslator->getLocale() !== $locale) {
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
        return static::translator()->getLocale();
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
        return static::translator()->setLocale($locale) !== false;
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
        $result = call_user_func($func, static::setLocale($locale) ? static::getLocale() : false, static::translator());
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
        $translator = static::translator();

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
}
