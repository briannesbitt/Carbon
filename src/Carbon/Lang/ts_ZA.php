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
 * - Zuza Software Foundation (Translate.org.za) Dwayne Bailey dwayne@translate.org.za
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Sunguti', 'Nyenyenyani', 'Nyenyankulu', 'Dzivamisoko', 'Mudyaxihi', 'Khotavuxika', 'Mawuwani', 'Mhawuri', 'Ndzhati', 'Nhlangula', 'Hukuri', 'N\'wendzamhala'],
    'months_short' => ['Sun', 'Yan', 'Kul', 'Dzi', 'Mud', 'Kho', 'Maw', 'Mha', 'Ndz', 'Nhl', 'Huk', 'N\'w'],
    'weekdays' => ['Sonto', 'Musumbhunuku', 'Ravumbirhi', 'Ravunharhu', 'Ravumune', 'Ravuntlhanu', 'Mugqivela'],
    'weekdays_short' => ['Son', 'Mus', 'Bir', 'Har', 'Ne', 'Tlh', 'Mug'],
    'weekdays_min' => ['Son', 'Mus', 'Bir', 'Har', 'Ne', 'Tlh', 'Mug'],
    'day_of_first_week_of_year' => 1,

    'week' => ':count vuntlhanu', // less reliable
    'w' => ':count vuntlhanu', // less reliable
    'a_week' => ':count vuntlhanu', // less reliable

    'day' => ':count dumelang', // less reliable
    'd' => ':count dumelang', // less reliable
    'a_day' => ':count dumelang', // less reliable

    'hour' => ':count wachi', // less reliable
    'h' => ':count wachi', // less reliable
    'a_hour' => ':count wachi', // less reliable

    'minute' => ':count wachi', // less reliable
    'min' => ':count wachi', // less reliable
    'a_minute' => ':count wachi', // less reliable

    'second' => ':count sumbunuku', // less reliable
    's' => ':count sumbunuku', // less reliable
    'a_second' => ':count sumbunuku', // less reliable
]);
