<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use DateInterval;
use InvalidArgumentException;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
 * A simple API extension for DateInterval.
 * The implementation provides helpers to handle weeks but only days are saved.
 * Weeks are calculated based on the total days of the current instance.
 *
 * @property int $years Total years of the current interval.
 * @property int $months Total months of the current interval.
 * @property int $weeks Total weeks of the current interval calculated from the days.
 * @property int $dayz Total days of the current interval (weeks * 7 + days).
 * @property int $hours Total hours of the current interval.
 * @property int $minutes Total minutes of the current interval.
 * @property int $seconds Total seconds of the current interval.
 * @property-read int $dayzExcludeWeeks Total days remaining in the final week of the current instance (days % 7).
 * @property-read int $daysExcludeWeeks alias of dayzExcludeWeeks
 *
 * @method static CarbonInterval years($years = 1) Create instance specifying a number of years.
 * @method static CarbonInterval year($years = 1) Alias for years()
 * @method static CarbonInterval months($months = 1) Create instance specifying a number of months.
 * @method static CarbonInterval month($months = 1) Alias for months()
 * @method static CarbonInterval weeks($weeks = 1) Create instance specifying a number of weeks.
 * @method static CarbonInterval week($weeks = 1) Alias for weeks()
 * @method static CarbonInterval days($days = 1) Create instance specifying a number of days.
 * @method static CarbonInterval dayz($days = 1) Alias for days()
 * @method static CarbonInterval day($days = 1) Alias for days()
 * @method static CarbonInterval hours($hours = 1) Create instance specifying a number of hours.
 * @method static CarbonInterval hour($hours = 1) Alias for hours()
 * @method static CarbonInterval minutes($minutes = 1) Create instance specifying a number of minutes.
 * @method static CarbonInterval minute($minutes = 1) Alias for minutes()
 * @method static CarbonInterval seconds($seconds = 1) Create instance specifying a number of seconds.
 * @method static CarbonInterval second($seconds = 1) Alias for seconds()
 * @method CarbonInterval years() years($years = 1) Set the years portion of the current interval.
 * @method CarbonInterval year() year($years = 1) Alias for years().
 * @method CarbonInterval months() months($months = 1) Set the months portion of the current interval.
 * @method CarbonInterval month() month($months = 1) Alias for months().
 * @method CarbonInterval weeks() weeks($weeks = 1) Set the weeks portion of the current interval.  Will overwrite dayz value.
 * @method CarbonInterval week() week($weeks = 1) Alias for weeks().
 * @method CarbonInterval days() days($days = 1) Set the days portion of the current interval.
 * @method CarbonInterval dayz() dayz($days = 1) Alias for days().
 * @method CarbonInterval day() day($days = 1) Alias for days().
 * @method CarbonInterval hours() hours($hours = 1) Set the hours portion of the current interval.
 * @method CarbonInterval hour() hour($hours = 1) Alias for hours().
 * @method CarbonInterval minutes() minutes($minutes = 1) Set the minutes portion of the current interval.
 * @method CarbonInterval minute() minute($minutes = 1) Alias for minutes().
 * @method CarbonInterval seconds() seconds($seconds = 1) Set the seconds portion of the current interval.
 * @method CarbonInterval second() second($seconds = 1) Alias for seconds().
 */
class CarbonInterval extends DateInterval
{
    /**
     * Interval spec period designators
     */
    const PERIOD_PREFIX = 'P';
    const PERIOD_YEARS = 'Y';
    const PERIOD_MONTHS = 'M';
    const PERIOD_DAYS = 'D';
    const PERIOD_TIME_PREFIX = 'T';
    const PERIOD_HOURS = 'H';
    const PERIOD_MINUTES = 'M';
    const PERIOD_SECONDS = 'S';

    /**
     * A translator to ... er ... translate stuff
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected static $translator;

    /**
     * Before PHP 5.4.20/5.5.4 instead of FALSE days will be set to -99999 when the interval instance
     * was created by DateTime:diff().
     */
    const PHP_DAYS_FALSE = -99999;

    /**
     * Determine if the interval was created via DateTime:diff() or not.
     *
     * @param DateInterval $interval
     *
     * @return bool
     */
    private static function wasCreatedFromDiff(DateInterval $interval)
    {
        return $interval->days !== false && $interval->days !== static::PHP_DAYS_FALSE;
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new CarbonInterval instance.
     *
     * @param int $years
     * @param int $months
     * @param int $weeks
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     */
    public function __construct($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $spec = static::PERIOD_PREFIX;

        $spec .= $years > 0 ? $years.static::PERIOD_YEARS : '';
        $spec .= $months > 0 ? $months.static::PERIOD_MONTHS : '';

        $specDays = 0;
        $specDays += $weeks > 0 ? $weeks * Carbon::DAYS_PER_WEEK : 0;
        $specDays += $days > 0 ? $days : 0;

        $spec .= $specDays > 0 ? $specDays.static::PERIOD_DAYS : '';

        if ($hours > 0 || $minutes > 0 || $seconds > 0) {
            $spec .= static::PERIOD_TIME_PREFIX;
            $spec .= $hours > 0 ? $hours.static::PERIOD_HOURS : '';
            $spec .= $minutes > 0 ? $minutes.static::PERIOD_MINUTES : '';
            $spec .= $seconds > 0 ? $seconds.static::PERIOD_SECONDS : '';
        }

        if ($spec === static::PERIOD_PREFIX) {
            // Allow the zero interval.
            $spec .= '0'.static::PERIOD_YEARS;
        }

        parent::__construct($spec);
    }

    /**
     * Create a new CarbonInterval instance from specific values.
     * This is an alias for the constructor that allows better fluent
     * syntax as it allows you to do CarbonInterval::create(1)->fn() rather than
     * (new CarbonInterval(1))->fn().
     *
     * @param int $years
     * @param int $months
     * @param int $weeks
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     *
     * @return static
     */
    public static function create($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds);
    }

    /**
     * Provide static helpers to create instances.  Allows CarbonInterval::years(3).
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $name
     * @param array  $args
     *
     * @return static
     */
    public static function __callStatic($name, $args)
    {
        $arg = count($args) === 0 ? 1 : $args[0];

        switch ($name) {
            case 'years':
            case 'year':
                return new static($arg);

            case 'months':
            case 'month':
                return new static(null, $arg);

            case 'weeks':
            case 'week':
                return new static(null, null, $arg);

            case 'days':
            case 'dayz':
            case 'day':
                return new static(null, null, null, $arg);

            case 'hours':
            case 'hour':
                return new static(null, null, null, null, $arg);

            case 'minutes':
            case 'minute':
                return new static(null, null, null, null, null, $arg);

            case 'seconds':
            case 'second':
                return new static(null, null, null, null, null, null, $arg);
        }
    }

    /**
     * Create a CarbonInterval instance from a DateInterval one.  Can not instance
     * DateInterval objects created from DateTime::diff() as you can't externally
     * set the $days field.
     *
     * @param DateInterval $di
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function instance(DateInterval $di)
    {
        if (static::wasCreatedFromDiff($di)) {
            throw new InvalidArgumentException('Can not instance a DateInterval object created from DateTime::diff().');
        }

        $instance = new static($di->y, $di->m, 0, $di->d, $di->h, $di->i, $di->s);
        $instance->invert = $di->invert;
        $instance->days = $di->days;

        return $instance;
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// LOCALIZATION //////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Initialize the translator instance if necessary.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected static function translator()
    {
        if (static::$translator === null) {
            static::$translator = new Translator('en');
            static::$translator->addLoader('array', new ArrayLoader());
            static::setLocale('en');
        }

        return static::$translator;
    }

    /**
     * Get the translator instance in use
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }

    /**
     * Set the translator instance to use
     *
     * @param TranslatorInterface $translator
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    /**
     * Get the current translator locale
     *
     * @return string
     */
    public static function getLocale()
    {
        return static::translator()->getLocale();
    }

    /**
     * Set the current translator locale
     *
     * @param string $locale
     */
    public static function setLocale($locale)
    {
        static::translator()->setLocale($locale);

        // Ensure the locale has been loaded.
        static::translator()->addResource('array', require __DIR__.'/Lang/'.$locale.'.php', $locale);
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// GETTERS AND SETTERS /////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get a part of the CarbonInterval object
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    public function __get($name)
    {
        switch ($name) {
            case 'years':
                return $this->y;

            case 'months':
                return $this->m;

            case 'dayz':
                return $this->d;

            case 'hours':
                return $this->h;

            case 'minutes':
                return $this->i;

            case 'seconds':
                return $this->s;

            case 'weeks':
                return (int) floor($this->d / Carbon::DAYS_PER_WEEK);

            case 'daysExcludeWeeks':
            case 'dayzExcludeWeeks':
                return $this->d % Carbon::DAYS_PER_WEEK;

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    /**
     * Set a part of the CarbonInterval object
     *
     * @param string $name
     * @param int    $val
     *
     * @throws \InvalidArgumentException
     */
    public function __set($name, $val)
    {
        switch ($name) {
            case 'years':
                $this->y = $val;
                break;

            case 'months':
                $this->m = $val;
                break;

            case 'weeks':
                $this->d = $val * Carbon::DAYS_PER_WEEK;
                break;

            case 'dayz':
                $this->d = $val;
                break;

            case 'hours':
                $this->h = $val;
                break;

            case 'minutes':
                $this->i = $val;
                break;

            case 'seconds':
                $this->s = $val;
                break;
        }
    }

    /**
     * Allow setting of weeks and days to be cumulative.
     *
     * @param int $weeks Number of weeks to set
     * @param int $days  Number of days to set
     *
     * @return static
     */
    public function weeksAndDays($weeks, $days)
    {
        $this->dayz = ($weeks * Carbon::DAYS_PER_WEEK) + $days;

        return $this;
    }

    /**
     * Allow fluent calls on the setters... CarbonInterval::years(3)->months(5)->day().
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $name
     * @param array  $args
     *
     * @return static
     */
    public function __call($name, $args)
    {
        $arg = count($args) === 0 ? 1 : $args[0];

        switch ($name) {
            case 'years':
            case 'year':
                $this->years = $arg;
                break;

            case 'months':
            case 'month':
                $this->months = $arg;
                break;

            case 'weeks':
            case 'week':
                $this->dayz = $arg * Carbon::DAYS_PER_WEEK;
                break;

            case 'days':
            case 'dayz':
            case 'day':
                $this->dayz = $arg;
                break;

            case 'hours':
            case 'hour':
                $this->hours = $arg;
                break;

            case 'minutes':
            case 'minute':
                $this->minutes = $arg;
                break;

            case 'seconds':
            case 'second':
                $this->seconds = $arg;
                break;
        }

        return $this;
    }

    /**
     * Get the current interval in a human readable format in the current locale.
     *
     * @return string
     */
    public function forHumans()
    {
        $periods = array(
            'year' => $this->years,
            'month' => $this->months,
            'week' => $this->weeks,
            'day' => $this->daysExcludeWeeks,
            'hour' => $this->hours,
            'minute' => $this->minutes,
            'second' => $this->seconds,
        );

        $parts = array();
        foreach ($periods as $unit => $count) {
            if ($count > 0) {
                array_push($parts, static::translator()->transChoice($unit, $count, array(':count' => $count)));
            }
        }

        return implode(' ', $parts);
    }

    /**
     * Format the instance as a string using the forHumans() function.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->forHumans();
    }

    /**
     * Add the passed interval to the current instance
     *
     * @param DateInterval $interval
     *
     * @return static
     */
    public function add(DateInterval $interval)
    {
        $sign = $interval->invert === 1 ? -1 : 1;

        if (static::wasCreatedFromDiff($interval)) {
            $this->dayz += $interval->days * $sign;
        } else {
            $this->years += $interval->y * $sign;
            $this->months += $interval->m * $sign;
            $this->dayz += $interval->d * $sign;
            $this->hours += $interval->h * $sign;
            $this->minutes += $interval->i * $sign;
            $this->seconds += $interval->s * $sign;
        }

        return $this;
    }

    /**
     * Get the interval_spec string
     *
     * @return string
     */
    public function spec()
    {
        $date = array_filter(array(
            static::PERIOD_YEARS => $this->y,
            static::PERIOD_MONTHS => $this->m,
            static::PERIOD_DAYS => $this->d,
        ));

        $time = array_filter(array(
            static::PERIOD_HOURS => $this->h,
            static::PERIOD_MINUTES => $this->i,
            static::PERIOD_SECONDS => $this->s,
        ));

        $specString = static::PERIOD_PREFIX;

        foreach ($date as $key => $value) {
            $specString .= $value.$key;
        }

        if (count($time) > 0) {
            $specString .= static::PERIOD_TIME_PREFIX;
            foreach ($time as $key => $value) {
                $specString .= $value.$key;
            }
        }

        return $specString === static::PERIOD_PREFIX ? 'PT0S' : $specString;
    }
}
