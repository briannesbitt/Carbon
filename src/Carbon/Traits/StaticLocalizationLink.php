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

use Carbon\CarbonImmutable;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Static config for localization linked to CarbonImmutable.
 */
trait StaticLocalizationLink
{
    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     * @see settings
     *
     * @param int $humanDiffOptions
     */
    public static function setHumanDiffOptions($humanDiffOptions)
    {
        CarbonImmutable::setHumanDiffOptions($humanDiffOptions);
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
        CarbonImmutable::enableHumanDiffOption($humanDiffOption);
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
        CarbonImmutable::disableHumanDiffOption($humanDiffOption);
    }

    /**
     * Return default humanDiff() options (merged flags as integer).
     *
     * @return int
     */
    public static function getHumanDiffOptions()
    {
        return CarbonImmutable::getHumanDiffOptions();
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
        CarbonImmutable::setTranslator($translator);
    }

    /**
     * Initialize the default translator instance if necessary.
     *
     * @return TranslatorInterface
     */
    public static function getTranslator()
    {
        return CarbonImmutable::getTranslator();
    }
}
