<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Laravel;

use ArrayAccess;
use Symfony\Component\Translation\Translator;

class App implements ArrayAccess
{
    /**
     * @var string
     */
    protected $locale = 'en';

    /**
     * @var string
     */
    protected $fallbackLocale = 'en';

    /**
     * @var string
     */
    protected static $version;

    /**
     * @var Translator
     */
    public $translator;

    /**
     * @var \Illuminate\Events\EventDispatcher
     */
    public $events;

    public function register()
    {
        include_once __DIR__.'/EventDispatcher.php';
        $this->locale = 'de';
        $this->fallbackLocale = 'fr';
        $this->translator = new Translator($this->locale);
    }

    public function setEventDispatcher($dispatcher)
    {
        $this->events = $dispatcher;
    }

    public static function version($version = null)
    {
        if ($version !== null) {
            static::$version = $version;
        }

        return static::$version;
    }

    public static function getLocaleChangeEventName()
    {
        return version_compare((string) static::version(), '5.5') >= 0
            ? 'Illuminate\Foundation\Events\LocaleUpdated'
            : 'locale.changed';
    }

    public function setLocaleWithoutEvent(string $locale)
    {
        $this->locale = $locale;
        $this->translator->setLocale($locale);
    }

    public function setLocale(string $locale)
    {
        $this->setLocaleWithoutEvent($locale);
        $this->events->dispatch(static::getLocaleChangeEventName());
    }

    public function setFallbackLocale(string $fallbackLocale)
    {
        $this->fallbackLocale = $fallbackLocale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getFallbackLocale()
    {
        return $this->fallbackLocale;
    }

    public function bound($service)
    {
        return isset($this->{$service});
    }

    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        // noop
    }

    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        // noop
    }

    public function removeService($offset)
    {
        $this->$offset = null;
    }
}
