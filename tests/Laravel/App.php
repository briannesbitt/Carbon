<?php

use Illuminate\Events\EventDispatcher;
use Symfony\Component\Translation\Translator;

class App implements ArrayAccess
{
    /**
     * @var string
     */
    protected static $version;

    /**
     * @var Translator
     */
    public $translator;

    /**
     * @var EventDispatcher
     */
    public $events;

    public function __construct()
    {
        include_once __DIR__.'/EventDispatcher.php';
        $this->translator = new Translator('de');
        $this->events = new EventDispatcher();
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
        return version_compare(static::version(), '5.5') >= 0 ? 'Illuminate\Foundation\Events\LocaleUpdated' : 'locale.changed';
    }

    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
        $this->events->dispatch(static::getLocaleChangeEventName());
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
}
