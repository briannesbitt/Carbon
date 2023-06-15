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

use Carbon\CarbonInterface;

trait CarbonTimezoneTrait
{
    public function toAppTz(bool $shift = false, string $tz = 'UTC'): CarbonInterface
    {
        return $shift
            ? $this->shiftTimezone($tz)
            : $this->timezone($tz);
    }

    public function copyWithAppTz(bool $shift = false, string $tz = 'UTC'): CarbonInterface
    {
        return ($shift
            ? $this->shiftTimezone($tz)
            : $this->timezone($tz)
        )->copy();
    }
}
