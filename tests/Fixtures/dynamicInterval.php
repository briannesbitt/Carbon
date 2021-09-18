<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonInterval;

return new CarbonInterval(function (DateTimeInterface $date, bool $negated = false): DateTime {
    $sign = $negated ? '-' : '+';
    $days = $date->format('j');

    return new DateTime(
        $date->modify("$sign $days days")
            ->format('Y-m-d H:i:s'),
    );
});
