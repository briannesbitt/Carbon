<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'meridiem' => ['a', 'p'],
    'weekdays' => ['dumingu', 'sigunda-fera', 'tersa-fera', 'kuarta-fera', 'kinta-fera', 'sesta-fera', 'sabadu'],
    'weekdays_short' => ['dum', 'sig', 'ter', 'kua', 'kin', 'ses', 'sab'],
    'weekdays_min' => ['du', 'si', 'te', 'ku', 'ki', 'se', 'sa'],
    'weekdays_standalone' => ['dumingu', 'sigunda-fera', 'tersa-fera', 'kuarta-fera', 'kinta-fera', 'sesta-fera', 'sábadu'],
    'months' => ['Janeru', 'Febreru', 'Marsu', 'Abril', 'Maiu', 'Junhu', 'Julhu', 'Agostu', 'Setenbru', 'Otubru', 'Nuvenbru', 'Dizenbru'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Otu', 'Nuv', 'Diz'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D [di] MMMM [di] YYYY HH:mm',
        'LLLL' => 'dddd, D [di] MMMM [di] YYYY HH:mm',
    ],
]);
