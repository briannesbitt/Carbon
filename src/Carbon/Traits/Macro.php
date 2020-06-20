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

/**
 * Trait Macros.
 *
 * Allows users to register macros within the Carbon class.
 */
trait Macro
{
    use Mixin;

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
     * @example
     * ```
     * $userSettings = [
     *   'locale' => 'pt',
     *   'timezone' => 'America/Sao_Paulo',
     * ];
     * Carbon::macro('userFormat', function () use ($userSettings) {
     *   return $this->copy()->locale($userSettings['locale'])->tz($userSettings['timezone'])->calendar();
     * });
     * echo Carbon::yesterday()->hours(11)->userFormat();
     * ```
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
     * Checks if macro is registered globally.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function hasMacro($name)
    {
        return isset(static::$globalMacros[$name]);
    }

    /**
     * Get the raw callable macro registered globally for a given name.
     *
     * @param string $name
     *
     * @return callable|null
     */
    public static function getMacro($name)
    {
        return static::$globalMacros[$name] ?? null;
    }

    /**
     * Checks if macro is registered globally or locally.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasLocalMacro($name)
    {
        return ($this->localMacros && isset($this->localMacros[$name])) || static::hasMacro($name);
    }

    /**
     * Get the raw callable macro registered globally or locally for a given name.
     *
     * @param string $name
     *
     * @return callable|null
     */
    public function getLocalMacro($name)
    {
        return ($this->localMacros ?? [])[$name] ?? static::getMacro($name);
    }
}
