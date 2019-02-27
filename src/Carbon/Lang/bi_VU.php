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
 * - Samsung Electronics Co., Ltd.    akhilesh.k@samsung.com & maninder1.s@samsung.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'dddd DD MMM YYYY',
    ],
    'months' => ['Jenuware', 'Febwari', 'Maj', 'Epril', 'Mei', 'Jun', 'Julae', 'Ogis', 'Septemba', 'Oktoba', 'Novemba', 'Disemba'],
    'months_short' => ['Jan', ''],
    'weekdays' => ['Sande', ''],
    'weekdays_short' => ['San', ''],
    'weekdays_min' => ['San', ''],
]);
