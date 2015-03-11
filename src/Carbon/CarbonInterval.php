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
 * A simple API extension for DateTimeInterval
 *
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
     * @var TranslatorInterface
     */
    protected static $translator;

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    public function __construct($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $spec = static::PERIOD_PREFIX;

        $spec .= $years > 0 ? $years.static::PERIOD_YEARS : '';
        $spec .= $months > 0 ? $months.static::PERIOD_MONTHS : '';

        $specDays = 0;
        $specDays += $weeks > 0 ? $weeks * Carbon::DAYS_PER_WEEK : 0;
        $specDays += $days > 0 ? $days : 0;

        $spec .= ($specDays > 0) ? $specDays.static::PERIOD_DAYS : '';

        if ($hours > 0 || $minutes > 0 || $seconds > 0) {
            $spec .= static::PERIOD_TIME_PREFIX;
            $spec .= $hours > 0 ? $hours.static::PERIOD_HOURS : '';
            $spec .= $minutes > 0 ? $minutes.static::PERIOD_MINUTES : '';
            $spec .= $seconds > 0 ? $seconds.static::PERIOD_SECONDS : '';
        }

        parent::__construct($spec);
    }

    public static function create($years = 0, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        return new CarbonInterval($years, $months, $weeks, $days, $hours, $minutes, $seconds);
    }

    public static function __callStatic($name, $args) {
        $arg = count($args) == 0 ? 1 : $args[0];

        switch ($name) {
            case 'years':
            case 'year':
                return new CarbonInterval($arg);

            case 'months':
            case 'month':
                return new CarbonInterval(null, $arg);

            case 'weeks':
            case 'week':
                return new CarbonInterval(null, null, $arg);

            case 'days':
            case 'dayz':
            case 'day':
                return new CarbonInterval(null, null, null, $arg);

            case 'hours':
            case 'hour':
                return new CarbonInterval(null, null, null, null, $arg);

            case 'minutes':
            case 'minute':
                return new CarbonInterval(null, null, null, null, null, $arg);

            case 'seconds':
            case 'second':
                return new CarbonInterval(null, null, null, null, null, null, $arg);
        }
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// LOCALIZATION //////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Intialize the translator instance if necessary.
     *
     * @return TranslatorInterface
     */
    protected static function translator()
    {
        if (static::$translator == null) {
            static::$translator = new Translator('en');
            static::$translator->addLoader('array', new ArrayLoader());
            static::setLocale('en');
        }

        return static::$translator;
    }

    /**
     * Get the translator instance in use
     *
     * @return TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }

    /**
     * Set the translator instance to use
     *
     * @param TranslatorInterface
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    public static function getLocale()
    {
        return static::translator()->getLocale();
    }

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
     * @throws InvalidArgumentException
     *
     * @return integer
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
                return $this->d >= Carbon::DAYS_PER_WEEK ? (int) ($this->d / Carbon::DAYS_PER_WEEK) : 0;

            case 'daysExcludeWeeks':
            case 'dayzExcludeWeeks':
                return $this->d % Carbon::DAYS_PER_WEEK;

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    // Allow fluent calls on the setters
    public function __call($name, $args) {
        $arg = count($args) == 0 ? 1 : $args[0];

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

    public function __set($name, $val) {
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

            default:
                throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }
    }

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

    public function __toString()
    {
        return $this->forHumans();
    }
}
