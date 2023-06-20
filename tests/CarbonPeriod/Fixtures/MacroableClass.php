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

use BadMethodCallException;
use Carbon\Traits\Macro;
use Closure;

class MacroableClass
{
    use Macro;

    public $endDate;

    protected $localMacros = [];

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function cast($className)
    {
        $new = new $className();

        return $new->setEndDate($this->endDate);
    }

    public function __call($method, $parameters)
    {
        $macro = static::$globalMacros[$method] ?? null;

        if ($macro instanceof Closure) {
            return $macro->call($this);
        }

        throw new BadMethodCallException("$method not found");
    }
}
