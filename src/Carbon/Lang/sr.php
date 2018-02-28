<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'year' => ':count godina|:count godine|:count godina',
    'y' => ':count godina|:count godine|:count godina',
    'month' => ':count mesec|:count meseca|:count meseci',
    'm' => ':count mesec|:count meseca|:count meseci',
    'week' => ':count nedelja|:count nedelje|:count nedelja',
    'w' => ':count nedelja|:count nedelje|:count nedelja',
    'day' => ':count dan|:count dana|:count dana',
    'd' => ':count dan|:count dana|:count dana',
    'hour' => ':count sat|:count sata|:count sati',
    'h' => ':count sat|:count sata|:count sati',
    'minute' => ':count minut|:count minuta |:count minuta',
    'min' => ':count minut|:count minuta |:count minuta',
    'second' => ':count sekund|:count sekunde|:count sekunde',
    's' => ':count sekund|:count sekunde|:count sekunde',
    'ago' => 'pre :time',
    'from_now' => ':time od sada',
    'after' => 'nakon :time',
    'before' => 'pre :time',

    'year_from_now' => '{1,21,31,41,51} :count godinu|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count godine|[5,Inf[ :count godina',
    'year_ago' => '{1,21,31,41,51} :count godinu|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count godine|[5,Inf[ :count godina',

    'week_from_now' => '{1} :count nedelju|{2,3,4} :count nedelje|[5,Inf[ :count nedelja',
    'week_ago' => '{1} :count nedelju|{2,3,4} :count nedelje|[5,Inf[ :count nedelja',
);
