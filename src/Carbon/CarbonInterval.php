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
    * Create a new CarbonInterval instance from periods (days, months, years, etc.)
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

   /**
    * Build an interval spec string from periods (days, months, years, etc.)
    * @link http://www.php.net/manual/en/dateinterval.construct.php DateInterval interval_spec documentation
    *
    * @param  integer             $years
    * @param  integer             $months
    * @param  integer             $weeks
    * @param  integer             $days
    * @param  integer             $hours
    * @param  integer             $minutes
    * @param  integer             $seconds
    *
    * @return string The interval spec
    */
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

   public function years()
   {
       return (int) $this->format('%y');
   }

   public function months()
   {
       return (int) $this->format('%m');
   }

   public function days($excludeWeeks = false)
   {
       $days = (int) $this->format('%d');
       if ( ! $excludeWeeks) {
          return $days;
       }

       return $days % Carbon::DAYS_PER_WEEK;
   }

   public function weeks()
   {
       return $this->days() >= Carbon::DAYS_PER_WEEK ? floor($this->days() / Carbon::DAYS_PER_WEEK) : 0;
   }

   public function totalDays()
   {
       return ($this->years() * 365) + ($this->months() * 4 * Carbon::DAYS_PER_WEEK) + $this->days();
   }

   public function hours()
   {
       return (int) $this->format('%h');
   }

   public function minutes()
   {
       return (int) $this->format('%i');
   }

   public function seconds()
   {
       return (int) $this->format('%s');
   }

   public function totalSeconds()
   {
       $daysInSeconds = $this->totalDays() * Carbon::HOURS_PER_DAY * Carbon::MINUTES_PER_HOUR * Carbon::SECONDS_PER_MINUTE;
       $hoursInSeconds = $this->hours() * Carbon::MINUTES_PER_HOUR * Carbon::SECONDS_PER_MINUTE;

       return $this->seconds() + $daysInSeconds + $hoursInSeconds;
   }

   public function intervalForHumans()
   {
       $periods = array_filter(array(
          'year' => $this->years(),
          'month' => $this->months(),
          'week' => $this->weeks() ?: null,
          'day' => $this->weeks() ? $this->days(true) : $this->days(),
          'hour' => $this->hours(),
          'minute' => $this->minutes(),
          'second' => $this->seconds(),
       ));

       $parts = array();
       foreach ($periods as $label => $value) {
           array_push($parts, $value, $value > 1 ? $label.'s' : $label);
       }

       return implode(' ', $parts);
    }
}
