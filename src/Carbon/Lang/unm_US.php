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
 * - bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['enikwsi', 'chkwali', 'xamokhwite', 'kwetayoxe', 'tainipen', 'kichinipen', 'lainipen', 'winaminke', 'kichitahkok', 'puksit', 'wini', 'muxkotae'],
    'months_short' => ['eni', 'chk', 'xam', 'kwe', 'tai', 'nip', 'lai', 'win', 'tah', 'puk', 'kun', 'mux'],
    'weekdays' => ['kentuwei', 'manteke', 'tusteke', 'lelai', 'tasteke', 'pelaiteke', 'sateteke'],
    'weekdays_short' => ['ken', 'man', 'tus', 'lel', 'tas', 'pel', 'sat'],
    'weekdays_min' => ['ken', 'man', 'tus', 'lel', 'tas', 'pel', 'sat'],
    'day_of_first_week_of_year' => 1,
]);
