<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

class Carbon extends \DateTime
{
   const SUNDAY = 0;
   const MONDAY = 1;
   const TUESDAY = 2;
   const WEDNESDAY = 3;
   const THURSDAY = 4;
   const FRIDAY = 5;
   const SATURDAY = 6;

   const MONTHS_PER_YEAR = 12;
   const HOURS_PER_DAY = 24;
   const MINUTES_PER_HOUR = 60;
   const SECONDS_PER_MINUTE = 60;

   protected static function safeCreateDateTimeZone($object)
   {
      if ($object instanceof \DateTimeZone) {
         return $object;
      }

      $tz = @timezone_open((string) $object);

      if ($tz === false) {
         throw new \InvalidArgumentException('Unknown or bad timezone ('.$object.')');
      }

      return $tz;
   }

   public function __construct($time = null, $tz = null)
   {
      if ($tz !== null) {
         parent::__construct($time, self::safeCreateDateTimeZone($tz));
      } else {
         parent::__construct($time);
      }
   }

   public static function instance(\DateTime $dt)
   {
      return new self($dt->format('Y-m-d H:i:s'), $dt->getTimeZone());
   }

   public static function now($tz = null)
   {
      return new self(null, $tz);
   }
   public static function today($tz = null)
   {
      return Carbon::now($tz)->startOfDay();
   }
   public static function tomorrow($tz = null)
   {
      return Carbon::today($tz)->addDay();
   }
   public static function yesterday($tz = null)
   {
      return Carbon::today($tz)->subDay();
   }
   public static function create($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
   {
      $year = ($year === null) ? date('Y') : $year;
      $month = ($month === null) ? date('n') : $month;
      $day = ($day === null) ? date('j') : $day;

      if ($hour === null) {
         $hour = date('G');
         $minute = ($minute === null) ? date('i') : $minute;
         $second = ($second === null) ? date('s') : $second;
      } else {
         $minute = ($minute === null) ? 0 : $minute;
         $second = ($second === null) ? 0 : $second;
      }

      return self::createFromFormat('Y-n-j G:i:s', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);
   }
   public static function createFromDate($year = null, $month = null, $day = null, $tz = null)
   {
      return self::create($year, $month, $day, null, null, null, $tz);
   }
   public static function createFromTime($hour = null, $minute = null, $second = null, $tz = null)
   {
      return self::create(null, null, null, $hour, $minute, $second, $tz);
   }
   public static function createFromFormat($format, $time, $object = null)
   {
      if ($object !== null) {
         $dt = parent::createFromFormat($format, $time, self::safeCreateDateTimeZone($object));
      } else {
         $dt = parent::createFromFormat($format, $time);
      }

      if ($dt instanceof \DateTime) {
         return self::instance($dt);
      }

      $errors = \DateTime::getLastErrors();
      throw new \InvalidArgumentException(implode(PHP_EOL, $errors['errors']));
   }
   public static function createFromTimestamp($timestamp, $tz = null)
   {
      return self::now($tz)->setTimestamp($timestamp);
   }
   public static function createFromTimestampUTC($timestamp)
   {
      return new self('@'.$timestamp);
   }

   public function copy()
   {
      return self::instance($this);
   }

   public function __get($name)
   {
      if ($name == 'year') return intval($this->format('Y'));
      if ($name == 'month') return intval($this->format('n'));
      if ($name == 'day') return intval($this->format('j'));
      if ($name == 'hour') return intval($this->format('G'));
      if ($name == 'minute') return intval($this->format('i'));
      if ($name == 'second') return intval($this->format('s'));
      if ($name == 'dayOfWeek') return intval($this->format('w'));
      if ($name == 'dayOfYear') return intval($this->format('z'));
      if ($name == 'weekOfYear') return intval($this->format('W'));
      if ($name == 'daysInMonth') return intval($this->format('t'));
      if ($name == 'timestamp') return intval($this->format('U'));
      if ($name == 'age') return intval($this->diffInYears());
      if ($name == 'quarter') return intval(($this->month - 1) / 3) + 1;
      if ($name == 'offset') return $this->getOffset();
      if ($name == 'offsetHours') return $this->getOffset() / self::SECONDS_PER_MINUTE / self::MINUTES_PER_HOUR;
      if ($name == 'dst') return $this->format('I') == '1';
      if ($name == 'timezone') return $this->getTimezone();
      if ($name == 'timezoneName') return $this->getTimezone()->getName();
      if ($name == 'tz') return $this->timezone;
      if ($name == 'tzName') return $this->timezoneName;
      throw new \InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
   }
   public function __isset($name)
   {
      try {
         $this->__get($name);
      } catch (\InvalidArgumentException $e) {
         return false;
      }
      return true;
   }
   public function __set($name, $value)
   {
      switch ($name) {
         case 'year':
            parent::setDate($value, $this->month, $this->day);
            break;
         case 'month':
            parent::setDate($this->year, $value, $this->day);
            break;
         case 'day':
            parent::setDate($this->year, $this->month, $value);
            break;
         case 'hour':
            parent::setTime($value, $this->minute, $this->second);
            break;
         case 'minute':
            parent::setTime($this->hour, $value, $this->second);
            break;
         case 'second':
            parent::setTime($this->hour, $this->minute, $value);
            break;
         case 'timestamp':
            parent::setTimestamp($value);
            break;
         case 'timezone':
            $this->setTimezone($value);
            break;
         case 'tz':
            $this->setTimezone($value);
            break;
         default:
            throw new \InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
      }
   }
   public function year($value)
   {
      $this->year = $value;

      return $this;
   }
   public function month($value)
   {
      $this->month = $value;

      return $this;
   }
   public function day($value)
   {
      $this->day = $value;

      return $this;
   }
   public function setDate($year, $month, $day)
   {
      return $this->year($year)->month($month)->day($day);
   }
   public function hour($value)
   {
      $this->hour = $value;

      return $this;
   }
   public function minute($value)
   {
      $this->minute = $value;

      return $this;
   }
   public function second($value)
   {
      $this->second = $value;

      return $this;
   }
   public function setTime($hour, $minute, $second = 0)
   {
      return $this->hour($hour)->minute($minute)->second($second);
   }
   public function setDateTime($year, $month, $day, $hour, $minute, $second)
   {
      return $this->setDate($year, $month, $day)->setTime($hour, $minute, $second);
   }
   public function timestamp($value)
   {
      $this->timestamp = $value;

      return $this;
   }
   public function timezone($value)
   {
      return $this->setTimezone($value);
   }
   public function tz($value)
   {
      return $this->setTimezone($value);
   }
   public function setTimezone($value)
   {
      parent::setTimezone(self::safeCreateDateTimeZone($value));

      return $this;
   }

   public function __toString()
   {
      return $this->toDateTimeString();
   }
   public function toDateString()
   {
      return $this->format('Y-m-d');
   }
   public function toFormattedDateString()
   {
      return $this->format('M j, Y');
   }
   public function toTimeString()
   {
      return $this->format('H:i:s');
   }
   public function toDateTimeString()
   {
      return $this->format('Y-m-d H:i:s');
   }
   public function toDayDateTimeString()
   {
      return $this->format('D, M j, Y g:i A');
   }
   public function toATOMString()
   {
      return $this->format(\DateTime::ATOM);
   }
   public function toCOOKIEString()
   {
      return $this->format(\DateTime::COOKIE);
   }
   public function toISO8601String()
   {
      return $this->format(\DateTime::ISO8601);
   }
   public function toRFC822String()
   {
      return $this->format(\DateTime::RFC822);
   }
   public function toRFC850String()
   {
      return $this->format(\DateTime::RFC850);
   }
   public function toRFC1036String()
   {
      return $this->format(\DateTime::RFC1036);
   }
   public function toRFC1123String()
   {
      return $this->format(\DateTime::RFC1123);
   }
   public function toRFC2822String()
   {
      return $this->format(\DateTime::RFC2822);
   }
   public function toRFC3339String()
   {
      return $this->format(\DateTime::RFC3339);
   }
   public function toRSSString()
   {
      return $this->format(\DateTime::RSS);
   }
   public function toW3CString()
   {
      return $this->format(\DateTime::W3C);
   }

   public function eq(Carbon $dt)
   {
      return $this == $dt;
   }
   public function ne(Carbon $dt)
   {
      return !$this->eq($dt);
   }
   public function gt(Carbon $dt)
   {
      return $this > $dt;
   }
   public function gte(Carbon $dt)
   {
      return $this >= $dt;
   }
   public function lt(Carbon $dt)
   {
      return $this < $dt;
   }
   public function lte(Carbon $dt)
   {
      return $this <= $dt;
   }
   public function isWeekday()
   {
      return ($this->dayOfWeek != self::SUNDAY && $this->dayOfWeek != self::SATURDAY);
   }
   public function isWeekend()
   {
      return !$this->isWeekDay();
   }
   public function isYesterday()
   {
      return $this->toDateString() === self::now($this->tz)->subDay()->toDateString();
   }
   public function isToday()
   {
      return $this->toDateString() === self::now($this->tz)->toDateString();
   }
   public function isTomorrow()
   {
      return $this->toDateString() === self::now($this->tz)->addDay()->toDateString();
   }
   public function isFuture()
   {
      return $this->gt(self::now($this->tz));
   }
   public function isPast()
   {
      return !$this->isFuture();
   }
   public function isLeapYear()
   {
      return $this->format('L') == '1';
   }

   public function addYears($value)
   {
      $interval = new \DateInterval(sprintf("P%dY", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addYear()
   {
      return $this->addYears(1);
   }
   public function subYear()
   {
      return $this->addYears(-1);
   }
   public function subYears($value)
   {
      return $this->addYears(-1 * $value);
   }
   public function addMonths($value)
   {
      $interval = new \DateInterval(sprintf("P%dM", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addMonth()
   {
      return $this->addMonths(1);
   }
   public function subMonth()
   {
      return $this->addMonths(-1);
   }
   public function subMonths($value)
   {
      return $this->addMonths(-1 * $value);
   }
   public function addDays($value)
   {
      $interval = new \DateInterval(sprintf("P%dD", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addDay()
   {
      return $this->addDays(1);
   }
   public function subDay()
   {
      return $this->addDays(-1);
   }
   public function subDays($value)
   {
      return $this->addDays(-1 * $value);
   }
   public function addWeekdays($value)
   {
      $absValue = abs($value);
      $direction = $value < 0 ? -1 : 1;

      while ($absValue > 0) {
         $this->addDays($direction);

         while ($this->isWeekend()) {
            $this->addDays($direction);
         }

         $absValue--;
      }

      return $this;
   }
   public function addWeekday()
   {
      return $this->addWeekdays(1);
   }
   public function subWeekday()
   {
      return $this->addWeekdays(-1);
   }
   public function subWeekdays($value)
   {
      return $this->addWeekdays(-1 * $value);
   }
   public function addWeeks($value)
   {
      $interval = new \DateInterval(sprintf("P%dW", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addWeek()
   {
      return $this->addWeeks(1);
   }
   public function subWeek()
   {
      return $this->addWeeks(-1);
   }
   public function subWeeks($value)
   {
      return $this->addWeeks(-1 * $value);
   }
   public function addHours($value)
   {
      $interval = new \DateInterval(sprintf("PT%dH", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addHour()
   {
      return $this->addHours(1);
   }
   public function subHour()
   {
      return $this->addHours(-1);
   }
   public function subHours($value)
   {
      return $this->addHours(-1 * $value);
   }
   public function addMinutes($value)
   {
      $interval = new \DateInterval(sprintf("PT%dM", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addMinute()
   {
      return $this->addMinutes(1);
   }
   public function subMinute()
   {
      return $this->addMinutes(-1);
   }
   public function subMinutes($value)
   {
      return $this->addMinutes(-1 * $value);
   }
   public function addSeconds($value)
   {
      $interval = new \DateInterval(sprintf("PT%dS", abs($value)));
      if ($value >= 0) {
         $this->add($interval);
      } else {
         $this->sub($interval);
      }

      return $this;
   }
   public function addSecond()
   {
      return $this->addSeconds(1);
   }
   public function subSecond()
   {
      return $this->addSeconds(-1);
   }
   public function subSeconds($value)
   {
      return $this->addSeconds(-1 * $value);
   }

   public function startOfDay()
   {
      return $this->hour(0)->minute(0)->second(0);
   }
   public function endOfDay()
   {
      return $this->hour(23)->minute(59)->second(59);
   }
   public function startOfMonth()
   {
      return $this->startOfDay()->day(1);
   }
   public function endOfMonth()
   {
      return $this->day($this->daysInMonth)->endOfDay();
   }

   public function diffInYears(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
      $sign = ($abs) ? '' : '%r';

      return intval($this->diff($dt)->format($sign.'%y'));
   }
   public function diffInMonths(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
      list($sign, $years, $months) = explode(':', $this->diff($dt)->format('%r:%y:%m'));
      $value = ($years * self::MONTHS_PER_YEAR) + $months;

      if ($sign === '-' && !$abs) {
         $value = $value * -1;
      }

      return $value;
   }
   public function diffInDays(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
      $sign = ($abs) ? '' : '%r';

      return intval($this->diff($dt)->format($sign.'%a'));
   }
   public function diffInHours(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;

      return intval($this->diffInMinutes($dt, $abs) / self::MINUTES_PER_HOUR);
   }
   public function diffInMinutes(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;

      return intval($this->diffInSeconds($dt, $abs) / self::SECONDS_PER_MINUTE);
   }
   public function diffInSeconds(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
      list($sign, $days, $hours, $minutes, $seconds) = explode(':', $this->diff($dt)->format('%r:%a:%h:%i:%s'));
      $value = ($days * self::HOURS_PER_DAY * self::MINUTES_PER_HOUR * self::SECONDS_PER_MINUTE) +
               ($hours * self::MINUTES_PER_HOUR * self::SECONDS_PER_MINUTE) +
               ($minutes * self::SECONDS_PER_MINUTE) +
               $seconds;

      if ($sign === '-' && !$abs) {
         $value = $value * -1;
      }

      return intval($value);
   }

   /**
    * When comparing a value in the past to default now:
    * 1 hour ago
    * 5 months ago
    *
    * When comparing a value in the future to default now:
    * 1 hour from now
    * 5 months from now
    *
    * When comparing a value in the past to another value:
    * 1 hour before
    * 5 months before
    *
    * When comparing a value in the future to another value:
    * 1 hour after
    * 5 months after
    */
   public function diffForHumans(Carbon $other = null)
   {
      $txt = '';

      $isNow = $other === null;

      if ($isNow) {
         $other = self::now();
      }

      $isFuture = $this->gt($other);

      $delta = abs($other->diffInSeconds($this));

      // 30 days per month, 365 days per year... good enough!!
      $divs = array(
         'second' => self::SECONDS_PER_MINUTE,
         'minute' => self::MINUTES_PER_HOUR,
         'hour' => self::HOURS_PER_DAY,
         'day' => 30,
         'month' => 12
      );

      $unit = 'year';

      foreach ($divs as $divUnit => $divValue) {
         if ($delta < $divValue) {
            $unit = $divUnit;
            break;
         }

         $delta = floor($delta / $divValue);
      }

      if ($delta == 0) {
         $delta = 1;
      }

      $txt = $delta . ' ' . $unit;
      $txt .= $delta == 1 ? '' : 's';

      if ($isNow) {
         if ($isFuture) {
            return $txt . ' from now';
         }

         return $txt . ' ago';
      }

      if ($isFuture) {
         return $txt . ' after';
      }

      return $txt . ' before';
   }
}
