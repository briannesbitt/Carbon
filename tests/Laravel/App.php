<?php
declare(strict_types=1);

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
    protected static $version;

    /**
     * @var Translator
     */
    public $translator;

    /**
     * @var \Illuminate\Events\EventDispatcher
     */
    public $events;

    public function register(): void
    {
        include_once __DIR__.'/EventDispatcher.php';
        $this->locale = 'de';
        $this->translator = new Translator($this->locale);
    }

    public function setEventDispatcher($dispatcher): void
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

    public static function getLocaleChangeEventName(): string
    {
        return version_compare((string) static::version(), '5.5') >= 0
            ? 'Illuminate\Foundation\Events\LocaleUpdated'
            : 'locale.changed';
    }

    public function setLocaleWithoutEvent($locale): void
    {
        $this->locale = $locale;
        $this->translator->setLocale($locale);
    }

    public function setLocale($locale): void
    {
        $this->setLocaleWithoutEvent($locale);
        $this->events->dispatch(static::getLocaleChangeEventName());
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function bound($service): bool
    {
        return isset($this->{$service});
    }

    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        // noop
    }

    public function offsetUnset($offset)
    {
        // noop
    }

    public function removeService($offset): void
    {
        $this->$offset = null;
    }
}
