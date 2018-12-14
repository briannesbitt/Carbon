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
    'year' => '{1}ལོ་གཅིག|]1,Inf[:count ལོ',
    'month' => '{1}ཟླ་བ་གཅིག|]1,Inf[:count ཟླ་བ',
    'week' => ':count བདུན་ཕྲག',
    'day' => '{1}ཉིན་གཅིག|]1,Inf[:count ཉིན་',
    'hour' => '{1}ཆུ་ཚོད་གཅིག|]1,Inf[:count ཆུ་ཚོད',
    'minute' => '{1}སྐར་མ་གཅིག|]1,Inf[:count སྐར་མ',
    'second' => '{1}ལམ་སང|]1,Inf[:count སྐར་ཆ།',
    'ago' => ':time སྔན་ལ',
    'from_now' => ':time ལ་',
    'diff_yesterday' => 'ཁ་སང',
    'diff_tomorrow' => 'སང་ཉིན',
    'formats' => [
        'LT' => 'A h:mm',
        'LTS' => 'A h:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY, A h:mm',
        'LLLL' => 'dddd, D MMMM YYYY, A h:mm',
    ],
    'calendar' => [
        'sameDay' => '[དི་རིང] LT',
        'nextDay' => '[སང་ཉིན] LT',
        'nextWeek' => '[བདུན་ཕྲག་རྗེས་མ], LT',
        'lastDay' => '[ཁ་སང] LT',
        'lastWeek' => '[བདུན་ཕྲག་མཐའ་མ] dddd, LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'མཚན་མོ';
        }
        if ($hour < 10) {
            return 'ཞོགས་ཀས';
        }
        if ($hour < 17) {
            return 'ཉིན་གུང';
        }
        if ($hour < 20) {
            return 'དགོང་དག';
        }

        return 'མཚན་མོ';
    },
    'months' => ['ཟླ་བ་དང་པོ', 'ཟླ་བ་གཉིས་པ', 'ཟླ་བ་གསུམ་པ', 'ཟླ་བ་བཞི་པ', 'ཟླ་བ་ལྔ་པ', 'ཟླ་བ་དྲུག་པ', 'ཟླ་བ་བདུན་པ', 'ཟླ་བ་བརྒྱད་པ', 'ཟླ་བ་དགུ་པ', 'ཟླ་བ་བཅུ་པ', 'ཟླ་བ་བཅུ་གཅིག་པ', 'ཟླ་བ་བཅུ་གཉིས་པ'],
    'months_short' => ['ཟླ་བ་དང་པོ', 'ཟླ་བ་གཉིས་པ', 'ཟླ་བ་གསུམ་པ', 'ཟླ་བ་བཞི་པ', 'ཟླ་བ་ལྔ་པ', 'ཟླ་བ་དྲུག་པ', 'ཟླ་བ་བདུན་པ', 'ཟླ་བ་བརྒྱད་པ', 'ཟླ་བ་དགུ་པ', 'ཟླ་བ་བཅུ་པ', 'ཟླ་བ་བཅུ་གཅིག་པ', 'ཟླ་བ་བཅུ་གཉིས་པ'],
    'weekdays' => ['གཟའ་ཉི་མ་', 'གཟའ་ཟླ་བ་', 'གཟའ་མིག་དམར་', 'གཟའ་ལྷག་པ་', 'གཟའ་ཕུར་བུ', 'གཟའ་པ་སངས་', 'གཟའ་སྤེན་པ་'],
    'weekdays_short' => ['ཉི་མ་', 'ཟླ་བ་', 'མིག་དམར་', 'ལྷག་པ་', 'ཕུར་བུ', 'པ་སངས་', 'སྤེན་པ་'],
    'weekdays_min' => ['ཉི་མ་', 'ཟླ་བ་', 'མིག་དམར་', 'ལྷག་པ་', 'ཕུར་བུ', 'པ་སངས་', 'སྤེན་པ་'],
];
