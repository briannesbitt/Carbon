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
 * - Sardinian Translators Team Massimeddu Cireddu massimeddu@gmail.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD. MM. YY',
    ],
    'months' => ['Ghennàrgiu', 'Freàrgiu', 'Martzu', 'Abrile', 'Maju', 'Làmpadas', 'Argiolas//Trìulas', 'Austu', 'Cabudanni', 'Santugaine//Ladàmine', 'Onniasantu//Santandria', 'Nadale//Idas'],
    'months_short' => ['Ghe', 'Fre', 'Mar', 'Abr', 'Maj', 'Làm', 'Arg', 'Aus', 'Cab', 'Lad', 'Onn', 'Nad'],
    'weekdays' => ['Domìnigu', 'Lunis', 'Martis', 'Mèrcuris', 'Giòbia', 'Chenàbura', 'Sàbadu'],
    'weekdays_short' => ['Dom', 'Lun', 'Mar', 'Mèr', 'Giò', 'Che', 'Sàb'],
    'weekdays_min' => ['Dom', 'Lun', 'Mar', 'Mèr', 'Giò', 'Che', 'Sàb'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
