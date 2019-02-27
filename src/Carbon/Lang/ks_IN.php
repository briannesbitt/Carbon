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
        'L' => 'M/D/YY',
    ],
    'months' => ['جنؤری', 'فرؤری', 'مارٕچ', 'اپریل', 'میٔ', 'جوٗن', 'جوٗلایی', 'اگست', 'ستمبر', 'اکتوٗبر', 'نومبر', 'دسمبر'],
    'months_short' => ['جنؤری', 'فرؤری', 'مارٕچ', 'اپریل', 'میٔ', 'جوٗن', 'جوٗلایی', 'اگست', 'ستمبر', 'اکتوٗبر', 'نومبر', 'دسمبر'],
    'weekdays' => ['آتهوار', 'ژءندروار', 'بوءںوار', 'بودهوار', 'برىسوار', 'جمع', 'بٹوار'],
    'weekdays_short' => ['آتهوار', 'ژءنتروار', 'بوءںوار', 'بودهوار', 'برىسوار', 'جمع', 'بٹوار'],
    'weekdays_min' => ['آتهوار', 'ژءنتروار', 'بوءںوار', 'بودهوار', 'برىسوار', 'جمع', 'بٹوار'],
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['دوپھربرونھ', 'دوپھرپتھ'],
]);
