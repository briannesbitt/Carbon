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
    'month' => 'ամիս|:count ամիս',
    'day' => 'օր|:count օր',
    'hour' => 'ժամ|:count ժամ',
    'minute' => 'րոպե|:count րոպե',
    'second' => 'մի քանի վայրկյան|:count վայրկյան',
    'ago' => ':time առաջ',
    'from_now' => ':time հետո',
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
        'nextWeek' => '',
        'lastDay' => '[երեկ] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'DDD':
            case 'w':
            case 'W':
            case 'DDDo':
                if ($number === 1) {
                    return $number + '-ին';
                }
                return $number + '-րդ';
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
];
