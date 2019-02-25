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
 * - Tornike Razmadze
 * - François B
 * - Lasha Dolidze
 * - Tim Fish
 * - JD Isaacks
 * - Tornike Razmadze
 * - François B
 * - Lasha Dolidze
 * - JD Isaacks
 * - LONGMAN
 */
return [
    'year' => '{1}წელი|]1,Inf[:count წელი',
    'y' => ':count წლის',
    'month' => '{1}თვე|]1,Inf[:count თვე',
    'm' => ':count თვის',
    'week' => ':count კვირის',
    'w' => ':count კვირის',
    'day' => '{1}დღე|]1,Inf[:count დღე',
    'd' => ':count დღის',
    'hour' => '{1}საათი|]1,Inf[:count საათი',
    'h' => ':count საათის',
    'minute' => '{1}წუთი|]1,Inf[:count წუთი',
    'min' => ':count წუთის',
    'second' => '{1}რამდენიმე წამი|]1,Inf[:count წამი',
    's' => ':count წამის',
    'ago' => function ($time) {
        return (preg_match('/(წამი|წუთი|საათი|წელი)/', $time) ?
                preg_replace('/ი$/', 'ში', $time) :
                $time
            ).'ში';
    },
    'from_now' => function ($time) {
        if (preg_match('/(წამი|წუთი|საათი|დღე|თვე)/', $time)) {
            return preg_replace('/(ი|ე)$/', 'ის წინ', $time);
        }
        if (preg_match('/წელი/', $time)) {
            return preg_replace('/წელი$/', 'წლის წინ', $time);
        }

        return preg_replace('/კვირის/', 'კვირაა', $time);
    },
    'after' => ':time შემდეგ',
    'before' => ':time უკან',
    'diff_yesterday' => 'გუშინ',
    'diff_tomorrow' => 'ხვალ',
    'formats' => [
        'LT' => 'h:mm A',
        'LTS' => 'h:mm:ss A',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY h:mm A',
        'LLLL' => 'dddd, D MMMM YYYY h:mm A',
    ],
    'calendar' => [
        'sameDay' => '[დღეს] LT[-ზე]',
        'nextDay' => '[ხვალ] LT[-ზე]',
        'nextWeek' => '[შემდეგ] dddd LT[-ზე]',
        'lastDay' => '[გუშინ] LT[-ზე]',
        'lastWeek' => '[წინა] dddd LT-ზე',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        if ($number === 0) {
            return $number;
        }
        if ($number === 1) {
            return $number.'-ლი';
        }
        if (($number < 20) || ($number <= 100 && ($number % 20 === 0)) || ($number % 100 === 0)) {
            return 'მე-'.$number;
        }

        return $number.'-ე';
    },
    'months' => ['იანვარს', 'თებერვალს', 'მარტს', 'აპრილის', 'მაისს', 'ივნისს', 'ივლისს', 'აგვისტს', 'სექტემბერს', 'ოქტომბერს', 'ნოემბერს', 'დეკემბერს'],
    'months_standalone' => ['იანვარი', 'თებერვალი', 'მარტი', 'აპრილი', 'მაისი', 'ივნისი', 'ივლისი', 'აგვისტო', 'სექტემბერი', 'ოქტომბერი', 'ნოემბერი', 'დეკემბერი'],
    'months_short' => ['იან', 'თებ', 'მარ', 'აპრ', 'მაი', 'ივნ', 'ივლ', 'აგვ', 'სექ', 'ოქტ', 'ნოე', 'დეკ'],
    'months_regexp' => '/D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/',
    'weekdays' => ['კვირას', 'ორშაბათს', 'სამშაბათს', 'ოთხშაბათს', 'ხუთშაბათს', 'პარასკევს', 'შაბათს'],
    'weekdays_standalone' => ['კვირა', 'ორშაბათი', 'სამშაბათი', 'ოთხშაბათი', 'ხუთშაბათი', 'პარასკევი', 'შაბათი'],
    'weekdays_short' => ['კვი', 'ორშ', 'სამ', 'ოთხ', 'ხუთ', 'პარ', 'შაბ'],
    'weekdays_min' => ['კვ', 'ორ', 'სა', 'ოთ', 'ხუ', 'პა', 'შა'],
    'weekdays_regexp' => '/(წინა|შემდეგ)/',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' და '],
    'meridiem' => ['დილის', 'საღამოს'],
];
