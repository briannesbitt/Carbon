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

/**
 * Trait Boundaries.
 *
 * startOf, endOf and derived method for each unit.
 *
 * Depends on the following properties:
 *
 * @property int $year
 * @property int $month
 * @property int $daysInMonth
 * @property int $quarter
 *
 * Depends on the following methods:
 *
 * @method $this setTime(int $hour, int $minute, int $second = 0, int $microseconds = 0)
 * @method $this setDate(int $year, int $month, int $day)
 * @method $this addMonths(int $value = 1)
 */
trait Macro
{
    /**
     * The registered macros.
     *
     * @var array
     */
    protected static $globalMacros = [];

    /**
     * The registered generic macros.
     *
     * @var array
     */
    protected static $globalGenericMacros = [];

    /**
     * Register a custom macro.
     *
     * @param string          $name
     * @param object|callable $macro
     *
     * @return void
     */
    public static function macro($name, $macro)
    {
        static::$globalMacros[$name] = $macro;
    }

    /**
     * Remove all macros and generic macros.
     */
    public static function resetMacros()
    {
        static::$globalMacros = [];
        static::$globalGenericMacros = [];
    }

    /**
     * Register a custom macro.
     *
     * @param object|callable $macro
     * @param int             $priority marco with higher priority is tried first
     *
     * @return void
     */
    public static function genericMacro($macro, $priority = 0)
    {
        if (!isset(static::$globalGenericMacros[$priority])) {
            static::$globalGenericMacros[$priority] = [];
            krsort(static::$globalGenericMacros, SORT_NUMERIC);
        }

        static::$globalGenericMacros[$priority][] = $macro;
    }

    /**
     * Mix another object into the class.
     *
     * @param object $mixin
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public static function mixin($mixin)
    {
        $methods = (new \ReflectionClass($mixin))->getMethods(
            \ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            $method->setAccessible(true);

            static::macro($method->name, $method->invoke($mixin));
        }
    }

    /**
     * Checks if macro is registered.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function hasMacro($name)
    {
        return isset(static::$globalMacros[$name]);
    }
}
