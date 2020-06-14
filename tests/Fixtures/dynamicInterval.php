<?php

use Carbon\CarbonInterval;

return new CarbonInterval(function (DateTimeInterface $date, bool $negated = false): DateTime {
    $sign = $negated ? '-' : '+';
    $days = $date->format('j');

    return new DateTime(
        $date->modify("$sign $days days")
            ->format('Y-m-d H:i:s')
    );
});
