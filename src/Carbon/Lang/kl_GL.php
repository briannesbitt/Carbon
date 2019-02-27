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
 * - Danish Standards Association    bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'MMM DD YYYY',
    ],
    'months' => ['januaarip', 'februaarip', 'marsip', 'apriilip', 'maajip', 'juunip', 'juulip', 'aggustip', 'septembarip', 'oktobarip', 'novembarip', 'decembarip'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
    'weekdays' => ['sapaat', 'ataasinngorneq', 'marlunngorneq', 'pingasunngorneq', 'sisamanngorneq', 'tallimanngorneq', 'arfininngorneq'],
    'weekdays_short' => ['sap', 'ata', 'mar', 'pin', 'sis', 'tal', 'arf'],
    'weekdays_min' => ['sap', 'ata', 'mar', 'pin', 'sis', 'tal', 'arf'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
]);
