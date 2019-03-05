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
 * - Information from native speakers Hannah Sarvasy nungon.localization@gmail.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['jenuari', 'febuari', 'mas', 'epril', 'mei', 'jun', 'julai', 'ögus', 'septemba', 'öktoba', 'nöwemba', 'diksemba'],
    'months_short' => ['jen', 'feb', 'mas', 'epr', 'mei', 'jun', 'jul', 'ögu', 'sep', 'ökt', 'nöw', 'dis'],
    'weekdays' => ['sönda', 'mönda', 'sinda', 'mitiwö', 'sogipbono', 'nenggo', 'söndanggie'],
    'weekdays_short' => ['sön', 'mön', 'sin', 'mit', 'soi', 'nen', 'sab'],
    'weekdays_min' => ['sön', 'mön', 'sin', 'mit', 'soi', 'nen', 'sab'],
    'day_of_first_week_of_year' => 1,

    'year' => ':count yep', // less reliable
    'y' => ':count yep', // less reliable
    'a_year' => ':count yep', // less reliable

    'day' => ':count yep', // less reliable
    'd' => ':count yep', // less reliable
    'a_day' => ':count yep', // less reliable

    'hour' => ':count yep', // less reliable
    'h' => ':count yep', // less reliable
    'a_hour' => ':count yep', // less reliable
]);
