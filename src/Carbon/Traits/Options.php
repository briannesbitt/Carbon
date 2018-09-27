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

/**
 * Trait Options.
 *
 * Embed base methods to change settings of Carbon classes.
 *
 * Depends on the following methods:
 *
 * @method \Carbon\Carbon|\Carbon\CarbonImmutable shiftTimezone($timezone) Set the timezone
 */
trait Options
{
    use Localization;

    /**
     * Customizable PHP_INT_SIZE override.
     *
     * @var int
     */
    public static $PHPIntSize = PHP_INT_SIZE;

    /**
     * First day of week.
     *
     * @var int
     */
    protected static $weekStartsAt = CarbonInterface::MONDAY;

    /**
     * Last day of week.
     *
     * @var int
     */
    protected static $weekEndsAt = CarbonInterface::SUNDAY;

    /**
     * Days of weekend.
     *
     * @var array
     */
    protected static $weekendDays = [
        CarbonInterface::SATURDAY,
        CarbonInterface::SUNDAY,
    ];

    /**
     * Format regex patterns.
     *
     * @var array
     */
    protected static $regexFormats = [
        'd' => '(3[01]|[12][0-9]|0[1-9])',
        'D' => '([a-zA-Z]{3})',
        'j' => '([123][0-9]|[1-9])',
        'l' => '([a-zA-Z]{2,})',
        'N' => '([1-7])',
        'S' => '([a-zA-Z]{2})',
        'w' => '([0-6])',
        'z' => '(36[0-5]|3[0-5][0-9]|[12][0-9]{2}|[1-9]?[0-9])',
        'W' => '(5[012]|[1-4][0-9]|[1-9])',
        'F' => '([a-zA-Z]{2,})',
        'm' => '(1[012]|0[1-9])',
        'M' => '([a-zA-Z]{3})',
        'n' => '(1[012]|[1-9])',
        't' => '(2[89]|3[01])',
        'L' => '(0|1)',
        'o' => '([1-9][0-9]{0,4})',
        'Y' => '([1-9][0-9]{0,4})',
        'y' => '([0-9]{2})',
        'a' => '(am|pm)',
        'A' => '(AM|PM)',
        'B' => '([0-9]{3})',
        'g' => '(1[012]|[1-9])',
        'G' => '(2[0-3]|1?[0-9])',
        'h' => '(1[012]|0[1-9])',
        'H' => '(2[0-3]|[01][0-9])',
        'i' => '([0-5][0-9])',
        's' => '([0-5][0-9])',
        'u' => '([0-9]{1,6})',
        'v' => '([0-9]{1,3})',
        'e' => '([a-zA-Z]{1,5})|([a-zA-Z]*\/[a-zA-Z]*)',
        'I' => '(0|1)',
        'O' => '([\+\-](1[012]|0[0-9])[0134][05])',
        'P' => '([\+\-](1[012]|0[0-9]):[0134][05])',
        'T' => '([a-zA-Z]{1,5})',
        'Z' => '(-?[1-5]?[0-9]{1,4})',
        'U' => '([0-9]*)',

        // The formats below are combinations of the above formats.
        'c' => '(([1-9][0-9]{0,4})\-(1[012]|0[1-9])\-(3[01]|[12][0-9]|0[1-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])[\+\-](1[012]|0[0-9]):([0134][05]))', // Y-m-dTH:i:sP
        'r' => '(([a-zA-Z]{3}), ([123][0-9]|[1-9]) ([a-zA-Z]{3}) ([1-9][0-9]{0,4}) (2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9]) [\+\-](1[012]|0[0-9])([0134][05]))', // D, j M Y H:i:s O
    ];

    /**
     * Indicates if months should be calculated with overflow.
     * Global setting.
     *
     * @var bool
     */
    protected static $monthsOverflow = true;

    /**
     * Indicates if years should be calculated with overflow.
     * Global setting.
     *
     * @var bool
     */
    protected static $yearsOverflow = true;

    /**
     * Indicates if the strict mode is in use.
     * Global setting.
     *
     * @var bool
     */
    protected static $strictModeEnabled = true;

    /**
     * Indicates if months should be calculated with overflow.
     * Specific setting.
     *
     * @var bool|null
     */
    protected $localMonthsOverflow = null;

    /**
     * Indicates if years should be calculated with overflow.
     * Specific setting.
     *
     * @var bool|null
     */
    protected $localYearsOverflow = null;

    /**
     * Indicates if the strict mode is in use.
     * Specific setting.
     *
     * @var bool|null
     */
    protected $localStrictModeEnabled = null;

    /**
     * Options for diffForHumans and forHumans methods.
     *
     * @var bool|null
     */
    protected $localHumanDiffOptions = null;

    /**
     * Format to use on string cast.
     *
     * @var string|null
     */
    protected $localToStringFormat = null;

    /**
     * Format to use on JSON serialization.
     *
     * @var string|null
     */
    protected $localSerializer = null;

    /**
     * Instance-specific macros.
     *
     * @var array|null
     */
    protected $localMacros = null;

    /**
     * Instance-specific generic macros.
     *
     * @var array|null
     */
    protected $localGenericMacros = null;

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     * @see settings
     *
     * Enable the strict mode (or disable with passing false).
     *
     * @param bool $strictModeEnabled
     */
    public static function useStrictMode($strictModeEnabled = true)
    {
        static::$strictModeEnabled = $strictModeEnabled;
    }

    /**
     * Returns true if the strict mode is globally in use, false else.
     * (It can be overridden in specific instances.)
     *
     * @return bool
     */
    public static function isStrictModeEnabled()
    {
        return static::$strictModeEnabled;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     *             Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
     *             are available for quarters, years, decade, centuries, millennia (singular and plural forms).
     * @see settings
     *
     * Indicates if months should be calculated with overflow.
     *
     * @param bool $monthsOverflow
     *
     * @return void
     */
    public static function useMonthsOverflow($monthsOverflow = true)
    {
        static::$monthsOverflow = $monthsOverflow;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     *             Or you can use method variants: addMonthsWithOverflow/addMonthsNoOverflow, same variants
     *             are available for quarters, years, decade, centuries, millennia (singular and plural forms).
     * @see settings
     *
     * Reset the month overflow behavior.
     *
     * @return void
     */
    public static function resetMonthsOverflow()
    {
        static::$monthsOverflow = true;
    }

    /**
     * Get the month overflow global behavior (can be overridden in specific instances).
     *
     * @return bool
     */
    public static function shouldOverflowMonths()
    {
        return static::$monthsOverflow;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     *             Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
     *             are available for quarters, years, decade, centuries, millennia (singular and plural forms).
     * @see settings
     *
     * Indicates if years should be calculated with overflow.
     *
     * @param bool $yearsOverflow
     *
     * @return void
     */
    public static function useYearsOverflow($yearsOverflow = true)
    {
        static::$yearsOverflow = $yearsOverflow;
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather use the ->settings() method.
     *             Or you can use method variants: addYearsWithOverflow/addYearsNoOverflow, same variants
     *             are available for quarters, years, decade, centuries, millennia (singular and plural forms).
     * @see settings
     *
     * Reset the month overflow behavior.
     *
     * @return void
     */
    public static function resetYearsOverflow()
    {
        static::$yearsOverflow = true;
    }

    /**
     * Get the month overflow global behavior (can be overridden in specific instances).
     *
     * @return bool
     */
    public static function shouldOverflowYears()
    {
        return static::$yearsOverflow;
    }

    /**
     * Set specific options.
     *  - strictMode: true|false|null
     *  - monthOverflow: true|false|null
     *  - yearOverflow: true|false|null
     *  - humanDiffOptions: int|null
     *  - toStringFormat: string|Closure|null
     *  - toJsonFormat: string|Closure|null
     *  - locale: string|null
     *  - timezone: \DateTimeZone|string|int|null
     *  - macros: array|null
     *  - genericMacros: array|null
     *
     * @param array $settings
     *
     * @return $this
     */
    public function settings(array $settings)
    {
        $this->localStrictModeEnabled = $settings['strictMode'] ?? null;
        $this->localMonthsOverflow = $settings['monthOverflow'] ?? null;
        $this->localYearsOverflow = $settings['yearOverflow'] ?? null;
        $this->localHumanDiffOptions = $settings['humanDiffOptions'] ?? null;
        $this->localToStringFormat = $settings['toStringFormat'] ?? null;
        $this->localSerializer = $settings['toJsonFormat'] ?? null;
        $this->localMacros = $settings['macros'] ?? null;
        $this->localGenericMacros = $settings['genericMacros'] ?? null;
        $date = $this;
        if (isset($settings['locale'])) {
            $date = $date->locale($settings['locale']);
        }
        if (isset($settings['timezone'])) {
            $date = $date->shiftTimezone($settings['timezone']);
        }

        return $date;
    }

    /**
     * Returns current local settings.
     *
     * @return array
     */
    public function getSettings()
    {
        $settings = [];
        $map = [
            'localStrictModeEnabled' => 'strictMode',
            'localMonthsOverflow' => 'monthOverflow',
            'localYearsOverflow' => 'yearOverflow',
            'localHumanDiffOptions' => 'humanDiffOptions',
            'localToStringFormat' => 'toStringFormat',
            'localSerializer' => 'toJsonFormat',
            'localMacros' => 'macros',
            'localGenericMacros' => 'genericMacros',
            'locale' => 'locale',
            'tzName' => 'timezone',
        ];
        foreach ($map as $property => $key) {
            $value = $this->$property ?? null;
            if ($value !== null) {
                $settings[$key] = $value;
            }
        }

        return $settings;
    }
}
