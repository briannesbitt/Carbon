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
    'year' => 'տարի|:count տարի',
    'y' => ':countտ',
    'month' => 'ամիս|:count ամիս',
    'm' => ':countամ',
    'week' => ':count շաբաթ',
    'w' => ':countշ',
    'day' => 'օր|:count օր',
    'd' => ':countօր',
    'hour' => 'ժամ|:count ժամ',
    'h' => ':countժ',
    'minute' => 'րոպե|:count րոպե',
    'min' => ':countր',
    'second' => 'մի քանի վայրկյան|:count վայրկյան',
    's' => ':countվրկ',
    'ago' => ':time առաջ',
    'from_now' => ':time հետո',
    'after' => ':time հետո',
    'before' => ':time առաջ',
    'diff_yesterday' => 'երեկ',
    'diff_tomorrow' => 'վաղը',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY թ.',
        'LLL' => 'D MMMM YYYY թ., HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY թ., HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[այսօր] LT',
        'nextDay' => '[վաղը] LT',
        'nextWeek' => 'dddd [օրը ժամը] LT',
        'lastDay' => '[երեկ] LT',
        'lastWeek' => '[անցած] dddd [օրը ժամը] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'DDD':
            case 'w':
            case 'W':
            case 'DDDo':
                return $number.($number === 1 ? '-ին' : '-րդ');
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'գիշերվա';
        }
        if ($hour < 12) {
            return 'առավոտվա';
        }
        if ($hour < 17) {
            return 'ցերեկվա';
        }

        return 'երեկոյան';
    },
    'months' => ['հունվարի', 'փետրվարի', 'մարտի', 'ապրիլի', 'մայիսի', 'հունիսի', 'հուլիսի', 'օգոստոսի', 'սեպտեմբերի', 'հոկտեմբերի', 'նոյեմբերի', 'դեկտեմբերի'],
    'months_standalone' => ['հունվար', 'փետրվար', 'մարտ', 'ապրիլ', 'մայիս', 'հունիս', 'հուլիս', 'օգոստոս', 'սեպտեմբեր', 'հոկտեմբեր', 'նոյեմբեր', 'դեկտեմբեր'],
    'months_short' => ['հնվ', 'փտր', 'մրտ', 'ապր', 'մյս', 'հնս', 'հլս', 'օգս', 'սպտ', 'հկտ', 'նմբ', 'դկտ'],
    'weekdays' => ['կիրակի', 'երկուշաբթի', 'երեքշաբթի', 'չորեքշաբթի', 'հինգշաբթի', 'ուրբաթ', 'շաբաթ'],
    'weekdays_short' => ['կրկ', 'երկ', 'երք', 'չրք', 'հնգ', 'ուրբ', 'շբթ'],
    'weekdays_min' => ['կրկ', 'երկ', 'երք', 'չրք', 'հնգ', 'ուրբ', 'շբթ'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
