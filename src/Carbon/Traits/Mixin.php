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
use Generator;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Throwable;

/**
 * Trait Mixin.
 *
 * Allows mixing in entire classes with multiple macros.
 */
trait Mixin
{
    /**
     * Stack of macro instance contexts.
     *
     * @var array
     */
    protected static $macroContextStack = [];

    /**
     * Mix another object into the class.
     *
     * @example
     * ```
     * Carbon::mixin(new class {
     *   public function addMoon() {
     *     return function () {
     *       return $this->addDays(30);
     *     };
     *   }
     *   public function subMoon() {
     *     return function () {
     *       return $this->subDays(30);
     *     };
     *   }
     * });
     * $fullMoon = Carbon::create('2018-12-22');
     * $nextFullMoon = $fullMoon->addMoon();
     * $blackMoon = Carbon::create('2019-01-06');
     * $previousBlackMoon = $blackMoon->subMoon();
     * echo "$nextFullMoon\n";
     * echo "$previousBlackMoon\n";
     * ```
     *
     * @param object|string $mixin
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public static function mixin($mixin)
    {
        \is_string($mixin) && trait_exists($mixin)
            ? static::loadMixinTrait($mixin)
            : static::loadMixinClass($mixin);
    }

    /**
     * @param object|string $mixin
     *
     * @throws ReflectionException
     */
    private static function loadMixinClass($mixin)
    {
        $methods = (new ReflectionClass($mixin))->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            if ($method->isConstructor() || $method->isDestructor()) {
                continue;
            }

            $method->setAccessible(true);

            static::macro($method->name, $method->invoke($mixin));
        }
    }

    /**
     * @param string $trait
     */
    private static function loadMixinTrait($trait)
    {
        $context = eval(self::getAnonymousClassCodeForTrait($trait));
        $className = \get_class($context);

        foreach (self::getMixableMethods($context) as $name) {
            $closureBase = Closure::fromCallable([$context, $name]);

            static::macro($name, function () use ($closureBase, $className) {
                /** @phpstan-ignore-next-line */
                $context = isset($this) ? $this->cast($className) : new $className();

                try {
                    $closure = $closureBase->bindTo($context);
                } catch (Throwable $throwable) {
                    $closure = $closureBase;
                }

                return $closure(...\func_get_args());
            });
        }
    }

    private static function getAnonymousClassCodeForTrait(string $trait)
    {
        return 'return new class() extends '.static::class.' {use '.$trait.';};';
    }

    private static function getMixableMethods(self $context): Generator
    {
        foreach (get_class_methods($context) as $name) {
            if (method_exists(static::class, $name)) {
                continue;
            }

            yield $name;
        }
    }

    /**
     * Stack a Carbon context from inside calls of self::this() and execute a given action.
     *
     * @param static|null $context
     * @param callable    $callable
     *
     * @throws Throwable
     *
     * @return mixed
     */
    protected static function bindMacroContext($context, callable $callable)
    {
        static::$macroContextStack[] = $context;
        $exception = null;
        $result = null;

        try {
            $result = $callable();
        } catch (Throwable $throwable) {
            $exception = $throwable;
        }

        array_pop(static::$macroContextStack);

        if ($exception) {
            throw $exception;
        }

        return $result;
    }

    /**
     * Return the current context from inside a macro callee or a new one if static.
     *
     * @return static
     */
    protected static function this()
    {
        return end(static::$macroContextStack) ?: new static();
    }
}
