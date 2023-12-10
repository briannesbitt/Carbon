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

use Carbon\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Static config for localization.
 */
trait StaticLocalization
{
    /**
     * Default translator.
     *
     * @var TranslatorInterface
     */
    protected static $translator;

    /**
     * Options for diffForHumans().
     *
     * @var int
     */
    protected static $humanDiffOptions = 0;

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
     * Set the default translator instance to use.
     *
     * @param TranslatorInterface $translator
     *
     * @return void
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    /**
     * Initialize the default translator instance if necessary.
     *
     * @return TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::$translator ??= Translator::get();
    }
}
