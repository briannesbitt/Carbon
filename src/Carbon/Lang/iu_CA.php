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
 * - Pablo Saratxaga pablo@mandriva.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'MM/DD/YY',
    ],
    'months' => ['ᔮᓄᐊᓕ', 'ᕕᕗᐊᓕ', 'ᒪᔅᓯ', 'ᐃᐳᓗ', 'ᒪᐃ', 'ᔪᓂ', 'ᔪᓚᐃ', 'ᐊᒋᓯ', 'ᓯᑎᕙ', 'ᐊᑦᑐᕙ', 'ᓄᕕᕙ', 'ᑎᓯᕝᕙ'],
    'months_short' => ['ᔮᓄ', 'ᕕᕗ', 'ᒪᔅ', 'ᐃᐳ', 'ᒪᐃ', 'ᔪᓂ', 'ᔪᓚ', 'ᐊᒋ', 'ᓯᑎ', 'ᐊᑦ', 'ᓄᕕ', 'ᑎᓯ'],
    'weekdays' => ['ᓈᑦᑎᖑᔭᕐᕕᒃ', 'ᓇᒡᒐᔾᔭᐅ', 'ᓇᒡᒐᔾᔭᐅᓕᖅᑭᑦ', 'ᐱᖓᓲᓕᖅᓯᐅᑦ', 'ᕿᑎᖅᑰᑦ', 'ᐅᓪᓗᕈᓘᑐᐃᓇᖅ', 'ᓯᕙᑖᕕᒃ'],
    'weekdays_short' => ['ᓈ', 'ᓇ', 'ᓕ', 'ᐱ', 'ᕿ', 'ᐅ', 'ᓯ'],
    'weekdays_min' => ['ᓈ', 'ᓇ', 'ᓕ', 'ᐱ', 'ᕿ', 'ᐅ', 'ᓯ'],
    'day_of_first_week_of_year' => 1,
]);
