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
namespace Tests\CarbonPeriod\Fixtures;

use Carbon\CarbonInterface;
use DateTime;

abstract class AbstractCarbon extends DateTime implements CarbonInterface
{
    public function __construct($time = null, $tz = null)
    {
        parent::__construct($time, $tz);
    }

    public static function __set_state($dump)
    {
        return new static($dump);
    }

    public function add($unit, $value = 1, $overflow = null)
    {
        return parent::add($unit);
    }

    public function sub($unit, $value = 1, $overflow = null)
    {
        return parent::sub($unit);
    }

    public function modify($modify)
    {
        return parent::modify($modify);
    }

    public static function createFromFormat($format, $time, $tz = null)
    {
        return parent::createFromFormat($format);
    }
}
