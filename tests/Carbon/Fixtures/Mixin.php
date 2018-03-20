<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon\Fixtures;

class Mixin
{
    public $timezone = null;

    public function setUserTimezone()
    {
        $mixin = $this;

        return function ($timezone) use ($mixin) {
            $mixin->timezone = $timezone;
        };
    }

    public function userFormat()
    {
        $mixin = $this;

        return function ($format, $self) use ($mixin) {
            if ($mixin->timezone) {
                $self->setTimezone($mixin->timezone);
            }

            return $self->format($format);
        };
    }
}
