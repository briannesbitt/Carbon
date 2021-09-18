<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon\Fixtures;

trait FooBar
{
    public function super($string)
    {
        return 'super'.$string.' / '.$this->format('l').' / '.($this->isMutable() ? 'mutable' : 'immutable');
    }

    public function me()
    {
        return $this;
    }

    public static function noThis()
    {
        return isset(${'this'});
    }
}
