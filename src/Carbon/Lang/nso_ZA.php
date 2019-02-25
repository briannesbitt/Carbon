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
    'months' => ['Janaware', 'Febereware', 'Matšhe', 'Aprele', 'Mei', 'June', 'Julae', 'Agostose', 'Setemere', 'Oktobere', 'Nofemere', 'Disemere'],
    'months_short' => ['Jan', 'Feb', 'Mat', 'Apr', 'Mei', 'Jun', 'Jul', 'Ago', 'Set', 'Okt', 'Nof', 'Dis'],
    'weekdays' => ['LaMorena', 'Mošupologo', 'Labobedi', 'Laboraro', 'Labone', 'Labohlano', 'Mokibelo'],
    'weekdays_short' => ['Son', 'Moš', 'Bed', 'Rar', 'Ne', 'Hla', 'Mok'],
    'weekdays_min' => ['Son', 'Moš', 'Bed', 'Rar', 'Ne', 'Hla', 'Mok'],
    'day_of_first_week_of_year' => 1,
]);
