<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Traits;

use Carbon\CarbonInterface;
use Carbon\Translator;
use Closure;
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
     * Get/set the locale for the current instance.
     *
     * @param string|null $locale
     *
     * @return $this|string
     */
    public function locale(string $locale = null)
    {
        if ($locale === null) {
            return $this->getLocalTranslator()->getLocale();
        }

        if (!$this->localTranslator || $this->localTranslator->getLocale() !== $locale) {
            $this->setLocalTranslator(Translator::get($locale));
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
                    ($y = $translator->trans('y')) !== 'y' &&
                    $y !== $translator->trans('year')
                ) || (
                    ($y = $translator->trans('d')) !== 'd' &&
                    $y !== $translator->trans('day')
                ) || (
                    ($y = $translator->trans('h')) !== 'h' &&
                    $y !== $translator->trans('hour')
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
}
