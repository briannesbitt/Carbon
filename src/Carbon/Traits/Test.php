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

use Closure;
use DateTimeImmutable;

trait Test
{
    ///////////////////////////////////////////////////////////////////
    ///////////////////////// TESTING AIDS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * A test Carbon instance to be returned when now instances are created.
     *
     * @var static
     */
    protected static $testNow;

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
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * /!\ Use this method for unit tests only.
     *
     * @param Closure|static|string|false|null $testNow real or mock Carbon instance
     */
    public static function setTestNow($testNow = null)
    {
        if ($testNow === false) {
            $testNow = null;
        }

        static::$testNow = \is_string($testNow) ? static::parse($testNow) : $testNow;
    }

    /**
     * Temporarily sets a static date to be used within the callback.
     * Using setTestNow to set the date, executing the callback, then
     * clearing the test instance.
     *
     * /!\ Use this method for unit tests only.
     *
     * @param Closure|static|string|false|null $testNow real or mock Carbon instance
     * @param Closure|null $callback
     *
     * @return mixed
     */
    public static function withTestNow($testNow = null, $callback = null)
    {
        static::setTestNow($testNow);
        $result = $callback();
        static::setTestNow();

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
     * Return the given timezone and set it to the test instance if not null.
     * If null, get the timezone from the test instance and return it.
     *
     * @param string|\DateTimeZone    $tz
     * @param \Carbon\CarbonInterface $testInstance
     *
     * @return string|\DateTimeZone
     */
    protected static function handleMockTimezone($tz, &$testInstance)
    {
        //shift the time according to the given time zone
        if ($tz !== null && $tz !== static::getMockedTestNow($tz)->getTimezone()) {
            $testInstance = $testInstance->setTimezone($tz);

            return $tz;
        }

        return $testInstance->getTimezone();
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

        return $testNow;
    }

    protected static function mockConstructorParameters(&$time, &$tz)
    {
        /** @var \Carbon\CarbonImmutable|\Carbon\Carbon $testInstance */
        $testInstance = clone static::getMockedTestNow($tz);

        $tz = static::handleMockTimezone($tz, $testInstance);

        if (static::hasRelativeKeywords($time)) {
            $testInstance = $testInstance->modify($time);
        }

        $time = $testInstance instanceof self ? $testInstance->rawFormat(static::MOCK_DATETIME_FORMAT) : $testInstance->format(static::MOCK_DATETIME_FORMAT);
    }
}
