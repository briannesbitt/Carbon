<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Ben Glassman <bglassman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use DateInterval;

class CarbonInterval extends DateInterval
{
   const PERIOD_PREFIX      = 'P';
   const PERIOD_YEARS       = 'Y';
   const PERIOD_MONTHS      = 'M';
   const PERIOD_DAYS        = 'D';
   const PERIOD_HOURS       = 'H';
   const PERIOD_MINUTES     = 'M';
   const PERIOD_SECONDS     = 'S';
   const PERIOD_TIME_PREFIX = 'T';

   ///////////////////////////////////////////////////////////////////
   //////////////////////////// CONSTRUCTORS /////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Create a new CarbonInterval instance from specific interval components (days, months, years, etc.)
    *
    * @param  integer             $years
    * @param  integer             $months
    * @param  integer             $weeks
    * @param  integer             $days
    * @param  integer             $hours
    * @param  integer             $minutes
    * @param  integer             $seconds
    *
    * @return CarbonInterval
    */
   public static function create($years = null, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
   {
       return new static(static::buildIntervalSpec($years, $months, $weeks, $days, $hours, $minutes, $seconds));
   }

   public static function buildIntervalSpec($years = null, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
   {
       $datePeriods = array_filter(array(
           static::PERIOD_YEARS => $years,
           static::PERIOD_MONTHS => $months,
           static::PERIOD_DAYS => $weeks ? (int) $days + ($weeks * 7) : $days,
       ));

       $timePeriods = array_filter(array(
           static::PERIOD_HOURS => $hours,
           static::PERIOD_MINUTES => $minutes,
           static::PERIOD_SECONDS => $seconds
       ));

       if (empty($datePeriods) && empty($timePeriods)) {
           throw new \InvalidArgumentException('Cannot create a CarbonInterval without specify any date or time arguments.');
       }

       $parts = array(static::PERIOD_PREFIX);

       foreach ($datePeriods as $period => $value) {
           array_push($parts, $value, $period);
       }

       if ($timePeriods) {
           $parts[] = static::PERIOD_TIME_PREFIX;
       }

       foreach ($timePeriods as $period => $value) {
           array_push($parts, $value, $period);
       }

       return implode('', $parts);
   }

}
