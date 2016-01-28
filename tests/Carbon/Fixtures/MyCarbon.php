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

use Carbon\Carbon;
use DateTime;

class MyCarbon extends Carbon
{
    /**
     * {@inheritdoc}
     */
    public static function instance(DateTime $dt)
    {
        return parent::instance($dt);
    }
}
