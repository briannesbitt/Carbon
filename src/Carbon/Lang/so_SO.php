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
 * - Ge'ez Frontier Foundation    locales@geez.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Bisha Koobaad', 'Bisha Labaad', 'Bisha Saddexaad', 'Bisha Afraad', 'Bisha Shanaad', 'Bisha Lixaad', 'Bisha Todobaad', 'Bisha Sideedaad', 'Bisha Sagaalaad', 'Bisha Tobnaad', 'Bisha Kow iyo Tobnaad', 'Bisha Laba iyo Tobnaad'],
    'months_short' => ['Kob', 'Lab', 'Sad', 'Afr', 'Sha', 'Lix', 'Tod', 'Sid', 'Sag', 'Tob', 'KIT', 'LIT'],
    'weekdays' => ['Axad', 'Isniin', 'Salaaso', 'Arbaco', 'Khamiis', 'Jimco', 'Sabti'],
    'weekdays_short' => ['Axd', 'Isn', 'Sal', 'Arb', 'Kha', 'Jim', 'Sab'],
    'weekdays_min' => ['Axd', 'Isn', 'Sal', 'Arb', 'Kha', 'Jim', 'Sab'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['subaxnimo', 'galabnimo'],
]);
