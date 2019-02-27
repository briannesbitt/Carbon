<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - Sugar Labs // OLPC sugarlabs.org libc-alpha@sourceware.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['iniru', 'phiwriru', 'marsu', 'awril', 'mayu', 'huniyu', 'huliyu', 'agustu', 'siptiyimri', 'uktuwri', 'nuwiyimri', 'tisiyimri'],
    'months_short' => ['ini', 'phi', 'mar', 'awr', 'may', 'hun', 'hul', 'agu', 'sip', 'ukt', 'nuw', 'tis'],
    'weekdays' => ['tuminku', 'lunis', 'martis', 'miyirkulis', 'juywis', 'wiyirnis', 'sawatu'],
    'weekdays_short' => ['tum', 'lun', 'mar', 'miy', 'juy', 'wiy', 'saw'],
    'weekdays_min' => ['tum', 'lun', 'mar', 'miy', 'juy', 'wiy', 'saw'],
    'day_of_first_week_of_year' => 1,
]);
