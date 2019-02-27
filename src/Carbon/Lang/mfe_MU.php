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
 * - Samsung Electronics Co., Ltd.    akhilesh.k@samsung.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['zanvie', 'fevriye', 'mars', 'avril', 'me', 'zin', 'zilye', 'out', 'septam', 'oktob', 'novam', 'desam'],
    'months_short' => ['zan', 'fev', 'mar', 'avr', 'me', 'zin', 'zil', 'out', 'sep', 'okt', 'nov', 'des'],
    'weekdays' => ['dimans', 'lindi', 'mardi', 'merkredi', 'zedi', 'vandredi', 'samdi'],
    'weekdays_short' => ['dim', 'lin', 'mar', 'mer', 'ze', 'van', 'sam'],
    'weekdays_min' => ['dim', 'lin', 'mar', 'mer', 'ze', 'van', 'sam'],
]);
