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
    'months' => ['Pherekgong', 'Hlakola', 'Tlhakubele', 'Mmese', 'Motsheanong', 'Phupjane', 'Phupu', 'Phato', 'Leotse', 'Mphalane', 'Pudungwana', 'Tshitwe'],
    'months_short' => ['Phe', 'Hla', 'TlH', 'Mme', 'Mot', 'Jan', 'Upu', 'Pha', 'Leo', 'Mph', 'Pud', 'Tsh'],
    'weekdays' => ['Sontaha', 'Mantaha', 'Labobedi', 'Laboraro', 'Labone', 'Labohlano', 'Moqebelo'],
    'weekdays_short' => ['Son', 'Mma', 'Bed', 'Rar', 'Ne', 'Hla', 'Moq'],
    'weekdays_min' => ['Son', 'Mma', 'Bed', 'Rar', 'Ne', 'Hla', 'Moq'],
    'day_of_first_week_of_year' => 1,
]);
