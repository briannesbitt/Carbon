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
 * - Red Hat, Pune    bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'D-M-YY',
    ],
    'months' => ['जानेवारी', 'फेब्रुवारी', 'मार्च', 'एप्रिल', 'मे', 'जून', 'जुलै', 'ओगस्ट', 'सेप्टेंबर', 'ओक्टोबर', 'नोव्हेंबर', 'डिसेंबर'],
    'months_short' => ['जानेवारी', 'फेब्रुवारी', 'मार्च', 'एप्रिल', 'मे', 'जून', 'जुलै', 'ओगस्ट', 'सेप्टेंबर', 'ओक्टोबर', 'नोव्हेंबर', 'डिसेंबर'],
    'weekdays' => ['आयतार', 'सोमार', 'मंगळवार', 'बुधवार', 'बेरेसतार', 'शुकरार', 'शेनवार'],
    'weekdays_short' => ['आयतार', 'सोमार', 'मंगळवार', 'बुधवार', 'बेरेसतार', 'शुकरार', 'शेनवार'],
    'weekdays_min' => ['आयतार', 'सोमार', 'मंगळवार', 'बुधवार', 'बेरेसतार', 'शुकरार', 'शेनवार'],
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['म.पू.', 'म.नं.'],
]);
