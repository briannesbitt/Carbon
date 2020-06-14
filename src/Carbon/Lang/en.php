<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Milos Sakovic
 * - Paul
 * - Pete Scopes (pdscopes)
 */
return [
    /*
     * {1}, {0} and ]1,Inf[ are not needed as it's the default for English pluralization.
     * But as some languages are using en.php as a fallback, it's better to specify it
     * explicitly so those languages also fallback to English pluralization when a unit
     * is missing.
     */
    'year' => '{1}:count year|{0}:count years|]1,Inf[:count years',
    'a_year' => '{1}a year|{0}:count years|]1,Inf[:count years',
    'y' => '{1}:countyr|{0}:countyrs|]1,Inf[:countyrs',
    'month' => '{1}:count month|{0}:count months|]1,Inf[:count months',
    'a_month' => '{1}a month|{0}:count months|]1,Inf[:count months',
    'm' => '{1}:countmo|{0}:countmos|]1,Inf[:countmos',
    'week' => '{1}:count week|{0}:count weeks|]1,Inf[:count weeks',
    'a_week' => '{1}a week|{0}:count weeks|]1,Inf[:count weeks',
    'w' => ':countw',
    'day' => '{1}:count day|{0}:count days|]1,Inf[:count days',
    'a_day' => '{1}a day|{0}:count days|]1,Inf[:count days',
    'd' => ':countd',
    'hour' => '{1}:count hour|{0}:count hours|]1,Inf[:count hours',
    'a_hour' => '{1}an hour|{0}:count hours|]1,Inf[:count hours',
    'h' => ':counth',
    'minute' => '{1}:count minute|{0}:count minutes|]1,Inf[:count minutes',
    'a_minute' => '{1}a minute|{0}:count minutes|]1,Inf[:count minutes',
    'min' => ':countm',
    'second' => '{1}:count second|{0}:count seconds|]1,Inf[:count seconds',
    'a_second' => '{1}a few seconds|{0}:count seconds|]1,Inf[:count seconds',
    's' => ':counts',
    'millisecond' => '{1}:count millisecond|{0}:count milliseconds|]1,Inf[:count milliseconds',
    'a_millisecond' => '{1}a millisecond|{0}:count milliseconds|]1,Inf[:count milliseconds',
    'ms' => ':countms',
    'microsecond' => '{1}:count microsecond|{0}:count microseconds|]1,Inf[:count microseconds',
    'a_microsecond' => '{1}a microsecond|{0}:count microseconds|]1,Inf[:count microseconds',
    'µs' => ':countµs',
    'ago' => ':time ago',
    'from_now' => ':time from now',
    'after' => ':time after',
    'before' => ':time before',
    'diff_now' => 'just now',
    'diff_today' => 'today',
    'diff_yesterday' => 'yesterday',
    'diff_tomorrow' => 'tomorrow',
    'diff_before_yesterday' => 'before yesterday',
    'diff_after_tomorrow' => 'after tomorrow',
    'period_recurrences' => '{1}once|{0}:count times|]1,Inf[:count times',
    'period_interval' => 'every :interval',
    'period_start_date' => 'from :date',
    'period_end_date' => 'to :date',
    'months' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    'weekdays' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    'weekdays_short' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    'weekdays_min' => ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    'ordinal' => function ($number) {
        $lastDigit = $number % 10;

        return $number.(
            (~~($number % 100 / 10) === 1) ? 'th' : (
                ($lastDigit === 1) ? 'st' : (
                    ($lastDigit === 2) ? 'nd' : (
                        ($lastDigit === 3) ? 'rd' : 'th'
                    )
                )
            )
        );
    },
    'list' => [', ', ' and '],
    'first_day_of_week' => 0,
    'day_of_first_week_of_year' => 1,
];
