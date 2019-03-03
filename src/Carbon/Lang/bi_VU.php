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
    'months' => ['jenuware', 'febwari', 'maj', 'epril', 'mei', 'jun', 'julae', 'ogis', 'septemba', 'oktoba', 'novemba', 'disemba'],
    'months_short' => ['jen', 'feb', 'maj', 'epr', 'mei', 'jun', 'jul', 'ogi', 'sep', 'okt', 'nov', 'dis'],
    'weekdays' => ['sande', 'mande', 'maj', 'wota', 'fraede', 'sarede'],
    'weekdays_short' => ['san', 'man', 'maj', 'wot', 'fra', 'sar'],
    'weekdays_min' => ['san', 'man', 'maj', 'wot', 'fra', 'sar'],
]);
