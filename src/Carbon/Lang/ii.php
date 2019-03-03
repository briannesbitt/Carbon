<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'meridiem' => ['ꎸꄑ', 'ꁯꋒ'],
    'weekdays' => ['ꑭꆏꑍ', 'ꆏꊂꋍ', 'ꆏꊂꑍ', 'ꆏꊂꌕ', 'ꆏꊂꇖ', 'ꆏꊂꉬ', 'ꆏꊂꃘ'],
    'weekdays_short' => ['ꑭꆏ', 'ꆏꋍ', 'ꆏꑍ', 'ꆏꌕ', 'ꆏꇖ', 'ꆏꉬ', 'ꆏꃘ'],
    'weekdays_min' => ['ꑭꆏ', 'ꆏꋍ', 'ꆏꑍ', 'ꆏꌕ', 'ꆏꇖ', 'ꆏꉬ', 'ꆏꃘ'],
    'months' => null,
    'months_short' => ['ꋍꆪ', 'ꑍꆪ', 'ꌕꆪ', 'ꇖꆪ', 'ꉬꆪ', 'ꃘꆪ', 'ꏃꆪ', 'ꉆꆪ', 'ꈬꆪ', 'ꊰꆪ', 'ꊰꊪꆪ', 'ꊰꑋꆪ'],
    'formats' => [
        'LT' => 'h:mm a',
        'LTS' => 'h:mm:ss a',
        'L' => 'YYYY-MM-dd',
        'LL' => 'YYYY MMM D',
        'LLL' => 'YYYY MMMM D h:mm a',
        'LLLL' => 'YYYY MMMM D, dddd h:mm a',
    ],
]);
