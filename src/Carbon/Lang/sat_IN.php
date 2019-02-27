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
 * - Red Hat Pune    libc-alpha@sourceware.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'D/M/YY',
    ],
    'months' => ['जनवरी', 'फरवरी', 'मार्च', 'अप्रेल', 'मई', 'जुन', 'जुलाई', 'अगस्त', 'सितम्बर', 'अखथबर', 'नवम्बर', 'दिसम्बर'],
    'months_short' => ['जनवरी', 'फरवरी', 'मार्च', 'अप्रेल', 'मई', 'जुन', 'जुलाई', 'अगस्त', 'सितम्बर', 'अखथबर', 'नवम्बर', 'दिसम्बर'],
    'weekdays' => ['सिंगेमाँहाँ', 'ओतेमाँहाँ', 'बालेमाँहाँ', 'सागुनमाँहाँ', 'सारदीमाँहाँ', 'जारुममाँहाँ', 'ञुहुममाँहाँ'],
    'weekdays_short' => ['सिंगे', 'ओते', 'बाले', 'सागुन', 'सारदी', 'जारुम', 'ञुहुम'],
    'weekdays_min' => ['सिंगे', 'ओते', 'बाले', 'सागुन', 'सारदी', 'जारुम', 'ञुहुम'],
    'day_of_first_week_of_year' => 1,
]);
