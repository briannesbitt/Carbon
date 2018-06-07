<?php

namespace Carbon;

use DateTimeZone;

class CarbonTimeZone extends DateTimeZone
{
    public function __construct($timezone = 'UTC')
    {
        if (is_int($timezone)) {
            $timezone = ($timezone < 0 ? '-' : '+').str_pad($timezone, 4, '0', STR_PAD_LEFT);
        }

        parent::__construct($timezone);
    }
}
