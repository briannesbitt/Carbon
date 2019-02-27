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
 * - International Components for Unicode    akhilesh.k@samsung.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'dddd DD MMM YYYY',
    ],
    'months' => ['Sānuali', 'Fēpueli', 'Maʻasi', 'ʻEpeleli', 'Mē', 'Sune', 'Siulai', 'ʻAokosi', 'Sepitema', 'ʻOkatopa', 'Nōvema', 'Tīsema'],
    'months_short' => ['Sān', 'Fēp', 'Maʻa', 'ʻEpe', 'Mē', 'Sun', 'Siu', 'ʻAok', 'Sep', 'ʻOka', 'Nōv', 'Tīs'],
    'weekdays' => ['Sāpate', 'Mōnite', 'Tūsite', 'Pulelulu', 'Tuʻapulelulu', 'Falaite', 'Tokonaki'],
    'weekdays_short' => ['Sāp', 'Mōn', 'Tūs', 'Pul', 'Tuʻa', 'Fal', 'Tok'],
    'weekdays_min' => ['Sāp', 'Mōn', 'Tūs', 'Pul', 'Tuʻa', 'Fal', 'Tok'],
    'meridiem' => ['hengihengi', 'efiafi'],
]);
