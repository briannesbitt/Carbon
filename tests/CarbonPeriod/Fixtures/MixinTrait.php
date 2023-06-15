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

trait MixinTrait
{
    public function oneMoreDay()
    {
        return $this->setEndDate($this->endNextDay());
    }

    public function endNextDay()
    {
        return $this->getEndDate()->addDay();
    }

    public function copyOneMoreDay()
    {
        return $this->copy()->oneMoreDay();
    }
}
