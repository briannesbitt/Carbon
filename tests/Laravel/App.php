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
    protected $locale;

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
        return version_compare((string) static::version(), '5.5') >= 0 ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed';
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->translator->setLocale($locale);
        $this->events->dispatch(static::getLocaleChangeEventName());
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function bound($service)
    {
        return isset($this->{$service});
    }

    public function offsetExists($offset)
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

    public function removeService($offset)
    {
        $this->$offset = null;
    }
}
