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
 * - Reşat SABIQ tilde.birlik@gmail.com
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'Mayıs', 'İyun', 'İyul', 'Avgust', 'Sentâbr', 'Oktâbr', 'Noyabr', 'Dekabr'],
    'months_short' => ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'İyn', 'İyl', 'Avg', 'Sen', 'Okt', 'Noy', 'Dek'],
    'weekdays' => ['Bazar', 'Bazarertesi', 'Salı', 'Çarşembe', 'Cumaaqşamı', 'Cuma', 'Cumaertesi'],
    'weekdays_short' => ['Baz', 'Ber', 'Sal', 'Çar', 'Caq', 'Cum', 'Cer'],
    'weekdays_min' => ['Baz', 'Ber', 'Sal', 'Çar', 'Caq', 'Cum', 'Cer'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['ÜE', 'ÜS'],
]);
