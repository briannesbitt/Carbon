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
 * - Akademe ya Luganda Kizito Birabwa kompyuta@kizito.uklinux.net
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['Janwaliyo', 'Febwaliyo', 'Marisi', 'Apuli', 'Maayi', 'Juuni', 'Julaayi', 'Agusito', 'Sebuttemba', 'Okitobba', 'Novemba', 'Desemba'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apu', 'Maa', 'Juu', 'Jul', 'Agu', 'Seb', 'Oki', 'Nov', 'Des'],
    'weekdays' => ['Sabiiti', 'Balaza', 'Lwakubiri', 'Lwakusatu', 'Lwakuna', 'Lwakutaano', 'Lwamukaaga'],
    'weekdays_short' => ['Sab', 'Bal', 'Lw2', 'Lw3', 'Lw4', 'Lw5', 'Lw6'],
    'weekdays_min' => ['Sab', 'Bal', 'Lw2', 'Lw3', 'Lw4', 'Lw5', 'Lw6'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
]);
