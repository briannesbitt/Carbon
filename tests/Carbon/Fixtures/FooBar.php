<?php

namespace Tests\Carbon\Fixtures;

trait FooBar
{
    public function super($string): string
    {
        return 'super'.$string.' / '.$this->format('l').' / '.($this->isMutable() ? 'mutable' : 'immutable');
    }

    public function me(): self
    {
        return $this;
    }

    public static function noThis(): bool
    {
        return isset(${'this'});
    }
}
