<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => 'ఒక సంవత్సరం|:count సంవత్సరాలు',
    'month' => 'ఒక నెల|:count నెలలు',
    'week' => 'ఒక వారం|:count వారాలు',
    'day' => 'ఒక రోజు|:count రోజులు',
    'hour' => 'ఒక గంట|:count గంటలు',
    'minute' => 'ఒక నిమిషం|:count నిమిషాలు',
    'second' => 'కొన్ని క్షణాలు|:count సెకన్లు',
    'ago' => ':time క్రితం',
    'from_now' => ':time లో',
    'diff_yesterday' => 'నిన్న',
    'diff_tomorrow' => 'రేపు',
    'formats' => [
        'LT' => 'A h:mm',
        'LTS' => 'A h:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY, A h:mm',
        'LLLL' => 'dddd, D MMMM YYYY, A h:mm',
    ],
    'calendar' => [
        'sameDay' => '[నేడు] LT',
        'nextDay' => '[రేపు] LT',
        'nextWeek' => 'dddd, LT',
        'lastDay' => '[నిన్న] LT',
        'lastWeek' => '[గత] dddd, LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberవ',
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'రాత్రి';
        }
        if ($hour < 10) {
            return 'ఉదయం';
        }
        if ($hour < 17) {
            return 'మధ్యాహ్నం';
        }
        if ($hour < 20) {
            return 'సాయంత్రం';
        }

        return ' రాత్రి';
    },
    'months' => ['జనవరి', 'ఫిబ్రవరి', 'మార్చి', 'ఏప్రిల్', 'మే', 'జూన్', 'జూలై', 'ఆగస్టు', 'సెప్టెంబర్', 'అక్టోబర్', 'నవంబర్', 'డిసెంబర్'],
    'months_short' => ['జన.', 'ఫిబ్ర.', 'మార్చి', 'ఏప్రి.', 'మే', 'జూన్', 'జూలై', 'ఆగ.', 'సెప్.', 'అక్టో.', 'నవ.', 'డిసె.'],
    'weekdays' => ['ఆదివారం', 'సోమవారం', 'మంగళవారం', 'బుధవారం', 'గురువారం', 'శుక్రవారం', 'శనివారం'],
    'weekdays_short' => ['ఆది', 'సోమ', 'మంగళ', 'బుధ', 'గురు', 'శుక్ర', 'శని'],
    'weekdays_min' => ['ఆ', 'సో', 'మం', 'బు', 'గు', 'శు', 'శ'],
    'list' => ', ',
];
