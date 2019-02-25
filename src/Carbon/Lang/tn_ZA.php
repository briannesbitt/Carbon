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
 * - Zuza Software Foundation (Translate.org.za) Dwayne Bailey dwayne@translate.org.za
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Ferikgong', 'Tlhakole', 'Mopitlwe', 'Moranang', 'Motsheganong', 'Seetebosigo', 'Phukwi', 'Phatwe', 'Lwetse', 'Diphalane', 'Ngwanatsele', 'Sedimonthole'],
    'months_short' => ['Fer', 'Tlh', 'Mop', 'Mor', 'Mot', 'See', 'Phu', 'Pha', 'Lwe', 'Dip', 'Ngw', 'Sed'],
    'weekdays' => ['laTshipi', 'Mosupologo', 'Labobedi', 'Laboraro', 'Labone', 'Labotlhano', 'Lamatlhatso'],
    'weekdays_short' => ['Tsh', 'Mos', 'Bed', 'Rar', 'Ne', 'Tlh', 'Mat'],
    'weekdays_min' => ['Tsh', 'Mos', 'Bed', 'Rar', 'Ne', 'Tlh', 'Mat'],
    'day_of_first_week_of_year' => 1,
]);
