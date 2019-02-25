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
    'months' => ['eyoMqungu', 'eyoMdumba', 'eyoKwindla', 'uTshazimpuzi', 'uCanzibe', 'eyeSilimela', 'eyeKhala', 'eyeThupa', 'eyoMsintsi', 'eyeDwarha', 'eyeNkanga', 'eyoMnga'],
    'months_short' => ['Mqu', 'Mdu', 'Kwi', 'Tsh', 'Can', 'Sil', 'Kha', 'Thu', 'Msi', 'Dwa', 'Nka', 'Mng'],
    'weekdays' => ['iCawa', 'uMvulo', 'lwesiBini', 'lwesiThathu', 'ulweSine', 'lwesiHlanu', 'uMgqibelo'],
    'weekdays_short' => ['Caw', 'Mvu', 'Bin', 'Tha', 'Sin', 'Hla', 'Mgq'],
    'weekdays_min' => ['Caw', 'Mvu', 'Bin', 'Tha', 'Sin', 'Hla', 'Mgq'],
    'day_of_first_week_of_year' => 1,
]);
