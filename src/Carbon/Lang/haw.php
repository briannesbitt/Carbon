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
    'months' => ['Ianuali', 'Pepeluali', 'Malaki', 'ʻApelila', 'Mei', 'Iune', 'Iulai', 'ʻAukake', 'Kepakemapa', 'ʻOkakopa', 'Nowemapa', 'Kekemapa'],
    'months_short' => ['Ian.', 'Pep.', 'Mal.', 'ʻAp.', 'Mei', 'Iun.', 'Iul.', 'ʻAu.', 'Kep.', 'ʻOk.', 'Now.', 'Kek.'],
    'weekdays' => ['Lāpule', 'Poʻakahi', 'Poʻalua', 'Poʻakolu', 'Poʻahā', 'Poʻalima', 'Poʻaono'],
    'weekdays_short' => ['LP', 'P1', 'P2', 'P3', 'P4', 'P5', 'P6'],
    'weekdays_min' => ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
    'formats' => [
        'LT' => 'h:mm a',
        'LTS' => 'h:mm:ss a',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY h:mm a',
        'LLLL' => 'dddd, D MMMM YYYY h:mm a',
    ],
]);
