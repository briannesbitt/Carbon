<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;

function foobar_filter($date)
{
    return $date < Carbon::parse('2017-03-13') || $date > Carbon::parse('2017-03-14');
}
