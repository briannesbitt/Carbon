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
    'year' => '{0}سنة|{1}سنة|{2}سنتين|[3,10]:count سنوات|[11,Inf]:count سنة',
    'y' => '{0}سنة|{1}سنة|{2}سنتين|[3,10]:count سنوات|[11,Inf]:count سنة',
    'month' => '{0}شهر|{1} شهر|{2}شهرين|[3,10]:count أشهر|[11,Inf]:count شهر',
    'm' => '{0}شهر|{1} شهر|{2}شهرين|[3,10]:count أشهر|[11,Inf]:count شهر',
    'week' => '{0}أسبوع|{1}أسبوع|{2}أسبوعين|[3,10]:count أسابيع|[11,Inf]:count أسبوع',
    'w' => '{0}أسبوع|{1}أسبوع|{2}أسبوعين|[3,10]:count أسابيع|[11,Inf]:count أسبوع',
    'day' => '{0}يوم|{1}يوم|{2}يومين|[3,10]:count أيام|[11,Inf] يوم',
    'd' => '{0}يوم|{1}يوم|{2}يومين|[3,10]:count أيام|[11,Inf] يوم',
    'hour' => '{0}ساعة|{1}ساعة|{2}ساعتين|[3,10]:count ساعات|[11,Inf]:count ساعة',
    'h' => '{0}ساعة|{1}ساعة|{2}ساعتين|[3,10]:count ساعات|[11,Inf]:count ساعة',
    'minute' => '{0}دقيقة|{1}دقيقة|{2}دقيقتين|[3,10]:count دقائق|[11,Inf]:count دقيقة',
    'min' => '{0}دقيقة|{1}دقيقة|{2}دقيقتين|[3,10]:count دقائق|[11,Inf]:count دقيقة',
    'second' => '{0}ثانية|{1}ثانية|{2}ثانيتين|[3,10]:count ثوان|[11,Inf]:count ثانية',
    's' => '{0}ثانية|{1}ثانية|{2}ثانيتين|[3,10]:count ثوان|[11,Inf]:count ثانية',
    'ago' => 'منذ :time',
    'from_now' => 'في :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[اليوم على الساعة] LT',
        'nextDay' => '[غدا على الساعة] LT',
        'nextWeek' => 'dddd [على الساعة] LT',
        'lastDay' => '[أمس على الساعة] LT',
        'lastWeek' => 'dddd [على الساعة] LT',
        'sameElse' => 'L',
    ],
    'months' => ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
    'months_short' => ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
    'weekdays' => ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    'weekdays_short' => ['احد', 'اثنين', 'ثلاثاء', 'اربعاء', 'خميس', 'جمعة', 'سبت'],
    'weekdays_min' => ['أح', 'إث', 'ثلا', 'أر', 'خم', 'جم', 'سب'],
];
