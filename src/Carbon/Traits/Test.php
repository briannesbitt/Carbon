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
use Carbon\CarbonTimeZone;
use Closure;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use Throwable;

trait Test
{
    ///////////////////////////////////////////////////////////////////
    ///////////////////////// TESTING AIDS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * A test Carbon instance to be returned when now instances are created.
     *
     * @var Closure|static|null
     */
    protected static $testNow;

    /**
     * The timezone to resto to when clearing the time mock.
     *
     * @var string|null
     */
    protected static $testDefaultTimezone;

    /**
     * Set a Carbon instance (real or mock) to be returned when a "now"
     * instance is created.  The provided instance will be returned
     * specifically under the following conditions:
     *   - A call to the static now() method, ex. Carbon::now()
     *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
     *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
     *   - When a string containing the desired time is passed to Carbon::parse().
     *
     * Note the timezone parameter was left out of the examples above and
     * has no affect as the mock value will be returned regardless of its value.
     *
     * Only the moment is mocked with setTestNow(), the timezone will still be the one passed
     * as parameter of date_default_timezone_get() as a fallback (see setTestNowAndTimezone()).
     *
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * /!\ Use this method for unit tests only.
     *
     * @param DateTimeInterface|Closure|static|string|false|null $testNow real or mock Carbon instance
     */
    public static function setTestNow($testNow = null)
    {
        static::$testNow = $testNow instanceof self || $testNow instanceof Closure
            ? $testNow
            : static::make($testNow);
    }

    /**
     * Set a Carbon instance (real or mock) to be returned when a "now"
     * instance is created.  The provided instance will be returned
     * specifically under the following conditions:
     *   - A call to the static now() method, ex. Carbon::now()
     *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
     *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
     *   - When a string containing the desired time is passed to Carbon::parse().
     *
     * It will also align default timezone (e.g. call date_default_timezone_set()) with
     * the second argument or if null, with the timezone of the given date object.
     *
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * /!\ Use this method for unit tests only.
     *
     * @param DateTimeInterface|Closure|static|string|false|null $testNow real or mock Carbon instance
     */
    public static function setTestNowAndTimezone($testNow = null, $tz = null)
    {
        if ($testNow) {
            self::$testDefaultTimezone = self::$testDefaultTimezone ?? date_default_timezone_get();
        }

        $useDateInstanceTimezone = $testNow instanceof DateTimeInterface;

        if ($useDateInstanceTimezone) {
            self::setDefaultTimezone($testNow->getTimezone()->getName(), $testNow);
        }

        static::setTestNow($testNow);

        if (!$useDateInstanceTimezone) {
            $now = static::getMockedTestNow(\func_num_args() === 1 ? null : $tz);
            $tzName = $now ? $now->tzName : null;
            self::setDefaultTimezone($tzName ?? self::$testDefaultTimezone ?? 'UTC', $now);
        }

        if (!$testNow) {
            self::$testDefaultTimezone = null;
        }
    }

    /**
     * Temporarily sets a static date to be used within the callback.
     * Using setTestNow to set the date, executing the callback, then
     * clearing the test instance.
     *
     * /!\ Use this method for unit tests only.
     *
     * @param DateTimeInterface|Closure|static|string|false|null $testNow  real or mock Carbon instance
     * @param Closure|null                                       $callback
     *
     * @return mixed
     */
    public static function withTestNow($testNow = null, $callback = null)
    {
        static::setTestNow($testNow);

        try {
            $result = $callback();
        } finally {
            static::setTestNow();
        }

        return $result;
    }

    /**
     * Get the Carbon instance (real or mock) to be returned when a "now"
     * instance is created.
     *
     * @return Closure|static the current instance used for testing
     */
    public static function getTestNow()
    {
        return static::$testNow;
    }

    /**
     * Determine if there is a valid test instance set. A valid test instance
     * is anything that is not null.
     *
     * @return bool true if there is a test instance, otherwise false
     */
    public static function hasTestNow()
    {
        return static::getTestNow() !== null;
    }

    /**
     * Get the mocked date passed in setTestNow() and if it's a Closure, execute it.
     *
     * @param string|\DateTimeZone $tz
     *
     * @return \Carbon\CarbonImmutable|\Carbon\Carbon|null
     */
    protected static function getMockedTestNow($tz)
    {
        $testNow = static::getTestNow();

        if ($testNow instanceof Closure) {
            $realNow = new DateTimeImmutable('now');
            $testNow = $testNow(static::parse(
                $realNow->format('Y-m-d H:i:s.u'),
                $tz ?: $realNow->getTimezone()
            ));
        }
        /* @var \Carbon\CarbonImmutable|\Carbon\Carbon|null $testNow */

        return $testNow instanceof CarbonInterface
            ? $testNow->avoidMutation()->tz($tz)
            : $testNow;
    }

    protected static function mockConstructorParameters(&$time, $tz)
    {
        /** @var \Carbon\CarbonImmutable|\Carbon\Carbon $testInstance */
        $testInstance = clone static::getMockedTestNow($tz);

        if (static::hasRelativeKeywords($time)) {
            $testInstance = $testInstance->modify($time);
        }

        $time = $testInstance instanceof self
            ? $testInstance->rawFormat(static::MOCK_DATETIME_FORMAT)
            : $testInstance->format(static::MOCK_DATETIME_FORMAT);
    }

    private static function setDefaultTimezone($timezone, DateTimeInterface $date = null)
    {
        $previous = null;
        $success = false;

        try {
            $success = date_default_timezone_set($timezone);
        } catch (Throwable $exception) {
            $previous = $exception;
        }

        if (!$success) {
            $suggestion = @CarbonTimeZone::create($timezone)->toRegionName($date);

            throw new InvalidArgumentException(
                "Timezone ID '$timezone' is invalid".
                ($suggestion && $suggestion !== $timezone ? ", did you mean '$suggestion'?" : '.')."\n".
                "It must be one of the IDs from DateTimeZone::listIdentifiers(),\n".
                'For the record, hours/minutes offset are relevant only for a particular moment, '.
                'but not as a default timezone.',
                0,
                $previous
            );
        }
    }
}
