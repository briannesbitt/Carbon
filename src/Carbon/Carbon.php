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

use DateTime;
use DateTimeZone;
use InvalidArgumentException;

/**
 * A simple API extension for DateTime
 *
 * @property      integer $year
 * @property      integer $month
 * @property      integer $day
 * @property      integer $hour
 * @property      integer $minute
 * @property      integer $second
 * @property      integer $timestamp seconds since the Unix Epoch
 * @property-read integer $dayOfWeek 0 (for Sunday) through 6 (for Saturday)
 * @property-read integer $dayOfYear 0 through 365
 * @property-read integer $weekOfYear ISO-8601 week number of year, weeks starting on Monday
 * @property-read integer $daysInMonth number of days in the given month
 * @property-read integer $age does a diffInYears() with default parameters
 * @property-read integer $quarter the quarter of this instance, 1 - 4
 * @property-read integer $offset the timezone offset in seconds from UTC
 * @property-read integer $offsetHours the timezone offset in hours from UTC
 * @property-read integer $dst daylight savings time indicator, 1 if DST, 0 otherwise
 * @property-read string  $timezoneName
 * @property-read string  $tzName
 *
 * @property-read  DateTimeZone        $timezone the current timezone
 * @property-read  DateTimeZone        $tz alias of timezone
 * @property-write DateTimeZone|string $timezone the current timezone
 * @property-write DateTimeZone|string $tz alias of timezone
 *
 */
class Carbon extends DateTime
{
   /**
    * The day constants
    */
   const SUNDAY    = 0;
   const MONDAY    = 1;
   const TUESDAY   = 2;
   const WEDNESDAY = 3;
   const THURSDAY  = 4;
   const FRIDAY    = 5;
   const SATURDAY  = 6;

   /**
   * Names of days of the week.
   *
   * @var array
   */
   private static $days = array(
      self::SUNDAY    => 'Sunday',
      self::MONDAY    => 'Monday',
      self::TUESDAY   => 'Tuesday',
      self::WEDNESDAY => 'Wednesday',
      self::THURSDAY  => 'Thursday',
      self::FRIDAY    => 'Friday',
      self::SATURDAY  => 'Saturday'
   );

   /**
    * Number of X in Y
    */
   const MONTHS_PER_YEAR    = 12;
   const HOURS_PER_DAY      = 24;
   const MINUTES_PER_HOUR   = 60;
   const SECONDS_PER_MINUTE = 60;

   /**
    * A test Carbon instance to be returned when now instances are created
    *
    * @var Carbon
    */
   protected static $testNow;

   /**
    * Creates a DateTimeZone from a string or a DateTimeZone
    *
    * @param  DateTimeZone|string $object
    *
    * @return DateTimeZone
    */
   protected static function safeCreateDateTimeZone($object)
   {
      if ($object instanceof DateTimeZone) {
         return $object;
      }

      $tz = @timezone_open((string) $object);

      if ($tz === false) {
         throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
      }

      return $tz;
   }

   ///////////////////////////////////////////////////////////////////
   //////////////////////////// CONSTRUCTORS /////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Create a new Carbon instance.
    *
    * Please see the testing aids section (specifically static::setTestNow())
    * for more on the possibility of this constructor returning a test instance.
    *
    * @param string              $time
    * @param DateTimeZone|string $tz
    */
   public function __construct($time = null, $tz = null)
   {
      // If the class has a test now set and we are trying to create a now()
      // instance then override as required
      if (static::hasTestNow() && (empty($time) || $time === 'now')) {
         $time = static::getTestNow()->toDateTimeString();
         $tz = static::getTestNow()->tz;
      }

      if ($tz !== null) {
         parent::__construct($time, self::safeCreateDateTimeZone($tz));
      } else {
         parent::__construct($time);
      }
   }

   /**
    * Create a Carbon instance from a DateTime one
    *
    * @param  DateTime $dt
    *
    * @return Carbon
    */
   public static function instance(DateTime $dt)
   {
      return new static($dt->format('Y-m-d H:i:s'), $dt->getTimeZone());
   }

   /**
    * Create a carbon instance from a string.  This is an alias for the
    * constructor that allows better fluent syntax as it allows you to do
    * Carbon::parse('Monday next week')->fn() rather than
    * (new Carbon('Monday next week'))->fn()
    *
    * @param string              $time
    * @param DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function parse($time = null, $tz = null)
   {
      return new static($time, $tz);
   }

   /**
    * Get a Carbon instance for the current date and time
    *
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function now($tz = null)
   {
      return new static(null, $tz);
   }

   /**
    * Create a Carbon instance for today
    *
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function today($tz = null)
   {
      return static::now($tz)->startOfDay();
   }

   /**
    * Create a Carbon instance for tomorrow
    *
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function tomorrow($tz = null)
   {
      return static::today($tz)->addDay();
   }

   /**
    * Create a Carbon instance for yesterday
    *
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function yesterday($tz = null)
   {
      return static::today($tz)->subDay();
   }

   /**
    * Create a new Carbon instance from a specific date and time.
    *
    * If any of $year, $month or $day are set to null their now() values
    * will be used.
    *
    * If $hour is null it will be set to its now() value and the default values
    * for $minute and $second will be their now() values.
    * If $hour is not null then the default values for $minute and $second
    * will be 0.
    *
    * @param  integer             $year
    * @param  integer             $month
    * @param  integer             $day
    * @param  integer             $hour
    * @param  integer             $minute
    * @param  integer             $second
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
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

   /**
    * Create a Carbon instance from just a date. The time portion is set to now.
    *
    * @param  integer             $year
    * @param  integer             $month
    * @param  integer             $day
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function createFromDate($year = null, $month = null, $day = null, $tz = null)
   {
      return self::create($year, $month, $day, null, null, null, $tz);
   }

   /**
    * Create a Carbon instance from just a time. The date portion is set to today.
    *
    * @param  integer             $hour
    * @param  integer             $minute
    * @param  integer             $second
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function createFromTime($hour = null, $minute = null, $second = null, $tz = null)
   {
      return self::create(null, null, null, $hour, $minute, $second, $tz);
   }

   /**
    * Create a Carbon instance from a specific format
    *
    * @param  string              $format
    * @param  string              $time
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function createFromFormat($format, $time, $tz = null)
   {
      if ($tz !== null) {
         $dt = parent::createFromFormat($format, $time, self::safeCreateDateTimeZone($tz));
      } else {
         $dt = parent::createFromFormat($format, $time);
      }

      if ($dt instanceof DateTime) {
         return self::instance($dt);
      }

      $errors = DateTime::getLastErrors();
      throw new InvalidArgumentException(implode(PHP_EOL, $errors['errors']));
   }

   /**
    * Create a Carbon instance from a timestamp
    *
    * @param  integer             $timestamp
    * @param  DateTimeZone|string $tz
    *
    * @return Carbon
    */
   public static function createFromTimestamp($timestamp, $tz = null)
   {
      return self::now($tz)->setTimestamp($timestamp);
   }

   /**
    * Create a Carbon instance from an UTC timestamp
    *
    * @param  integer $timestamp
    *
    * @return Carbon
    */
   public static function createFromTimestampUTC($timestamp)
   {
      return new static('@'.$timestamp);
   }

   /**
    * Get a copy of the instance
    *
    * @return Carbon
    */
   public function copy()
   {
      return self::instance($this);
   }

   ///////////////////////////////////////////////////////////////////
   ///////////////////////// GETTERS AND SETTERS /////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Get a part of the Carbon object
    *
    * @param  string $name
    *
    * @return string|integer|DateTimeZone
    */
   public function __get($name)
   {
      switch ($name) {
         case 'year':
            return intval($this->format('Y'));

         case 'month':
            return intval($this->format('n'));

         case 'day':
            return intval($this->format('j'));

         case 'hour':
            return intval($this->format('G'));

         case 'minute':
            return intval($this->format('i'));

         case 'second':
            return intval($this->format('s'));

         case 'dayOfWeek':
            return intval($this->format('w'));

         case 'dayOfYear':
            return intval($this->format('z'));

         case 'weekOfYear':
            return intval($this->format('W'));

         case 'daysInMonth':
            return intval($this->format('t'));

         case 'timestamp':
            return intval($this->format('U'));

         case 'age':
            return intval($this->diffInYears());

         case 'quarter':
            return intval(($this->month - 1) / 3) + 1;

         case 'offset':
            return $this->getOffset();

         case 'offsetHours':
            return $this->getOffset() / self::SECONDS_PER_MINUTE / self::MINUTES_PER_HOUR;

         case 'dst':
            return $this->format('I') == '1';

         case 'timezone':
            return $this->getTimezone();

         case 'timezoneName':
            return $this->getTimezone()->getName();

         case 'tz':
            return $this->timezone;

         case 'tzName':
            return $this->timezoneName;

         default:
            throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
      }
   }

   /**
    * Check if an attribute exists on the object
    *
    * @param  string  $name
    *
    * @return boolean
    */
   public function __isset($name)
   {
      try {
         $this->__get($name);
      } catch (InvalidArgumentException $e) {
         return false;
      }

      return true;
   }

   /**
    * Set a part of the Carbon object
    *
    * @param string                      $name
    * @param string|integer|DateTimeZone $value
    */
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
            throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
      }
   }

   /**
    * Set the instance's year
    *
    * @param  integer $value
    *
    * @return self
    */
   public function year($value)
   {
      $this->year = $value;

      return $this;
   }

   /**
    * Set the instance's month
    *
    * @param  integer $value
    *
    * @return self
    */
   public function month($value)
   {
      $this->month = $value;

      return $this;
   }

   /**
    * Set the instance's day
    *
    * @param  integer $value
    *
    * @return self
    */
   public function day($value)
   {
      $this->day = $value;

      return $this;
   }

   /**
    * Set the date all together
    *
    * @param  integer $year
    * @param  integer $month
    * @param  integer $day
    *
    * @return self
    */
   public function setDate($year, $month, $day)
   {
      return $this->year($year)->month($month)->day($day);
   }

   /**
    * Set the instance's hour
    *
    * @param  integer $value
    *
    * @return self
    */
   public function hour($value)
   {
      $this->hour = $value;

      return $this;
   }

   /**
    * Set the instance's minute
    *
    * @param  integer $value
    *
    * @return self
    */
   public function minute($value)
   {
      $this->minute = $value;

      return $this;
   }

   /**
    * Set the instance's second
    *
    * @param  integer $value
    *
    * @return self
    */
   public function second($value)
   {
      $this->second = $value;

      return $this;
   }

   /**
    * Set the time all together
    *
    * @param  integer  $hour
    * @param  integer  $minute
    * @param  integer  $second
    *
    * @return self
    */
   public function setTime($hour, $minute, $second = 0)
   {
      return $this->hour($hour)->minute($minute)->second($second);
   }

   /**
    * Set the date and time all together
    *
    * @param  integer $year
    * @param  integer $month
    * @param  integer $day
    * @param  integer $hour
    * @param  integer $minute
    * @param  integer $second
    *
    * @return self
    */
   public function setDateTime($year, $month, $day, $hour, $minute, $second)
   {
      return $this->setDate($year, $month, $day)->setTime($hour, $minute, $second);
   }

   /**
    * Set the instance's timestamp
    *
    * @param  integer $value
    *
    * @return self
    */
   public function timestamp($value)
   {
      $this->timestamp = $value;

      return $this;
   }

   /**
    * Alias for setTimezone()
    *
    * @param  DateTimeZone|string $value
    *
    * @return self
    */
   public function timezone($value)
   {
      return $this->setTimezone($value);
   }

   /**
    * Alias for setTimezone()
    *
    * @param  DateTimeZone|string $value
    *
    * @return self
    */
   public function tz($value)
   {
      return $this->setTimezone($value);
   }

   /**
    * Set the instance's timezone from a string or object
    *
    * @param DateTimeZone|string $value
    *
    * @return self
    */
   public function setTimezone($value)
   {
      parent::setTimezone(self::safeCreateDateTimeZone($value));

      return $this;
   }

   ///////////////////////////////////////////////////////////////////
   ///////////////////////// TESTING AIDS ////////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Set a Carbon instance (real or mock) to be returned when a "now"
    * instance is created.  The provided instance will be returned
    * specifically under the following conditions:
    *   - A call to the static now() method, ex. Carbon::now()
    *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
    *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
    *
    * Note the timezone parameter was left out of the examples above and
    * has no affect as the mock value will be returned regardless of its value.
    *
    * To clear the test instance call this method using the default
    * parameter of null.
    *
    * @param Carbon $testNow
    */
   public static function setTestNow(Carbon $testNow = null)
   {
      static::$testNow = $testNow;
   }

   /**
    * Get the Carbon instance (real or mock) to be returned when a "now"
    * instance is created.
    *
    * @return Carbon the current instance used for testing
    */
   public static function getTestNow()
   {
      return static::$testNow;
   }

   /**
    * Determine if there is a valid test instance set. A valid test instance
    * is anything that is not null.
    *
    * @return boolean true if there is a test instance, otherwise false
    */
   public static function hasTestNow()
   {
      return static::getTestNow() !== null;
   }

   ///////////////////////////////////////////////////////////////////
   /////////////////////// STRING FORMATTING /////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Format the instance with the current locale.  You can set the current
    * locale using setlocale() http://php.net/setlocale.
    *
    * @param  string $format
    *
    * @return string
    */
   public function formatLocalized($format)
   {
      // Check for Windows to find and replace the %e 
      // modifier correctly
      if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
          $format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
      }
      
      return strftime($format, $this->timestamp);
   }

   /**
    * Format the instance with date and time
    *
    * @return string
    */
   public function __toString()
   {
      return $this->toDateTimeString();
   }

   /**
    * Format the instance as date
    *
    * @return string
    */
   public function toDateString()
   {
      return $this->format('Y-m-d');
   }

   /**
    * Format the instance as a readable date
    *
    * @return string
    */
   public function toFormattedDateString()
   {
      return $this->format('M j, Y');
   }

   /**
    * Format the instance as time
    *
    * @return string
    */
   public function toTimeString()
   {
      return $this->format('H:i:s');
   }

   /**
    * Format the instance as date and time
    *
    * @return string
    */
   public function toDateTimeString()
   {
      return $this->format('Y-m-d H:i:s');
   }

   /**
    * Format the instance with day, date and time
    *
    * @return string
    */
   public function toDayDateTimeString()
   {
      return $this->format('D, M j, Y g:i A');
   }

   /**
    * Format the instance as ATOM
    *
    * @return string
    */
   public function toATOMString()
   {
      return $this->format(DateTime::ATOM);
   }

   /**
    * Format the instance as COOKIE
    *
    * @return string
    */
   public function toCOOKIEString()
   {
      return $this->format(DateTime::COOKIE);
   }

   /**
    * Format the instance as ISO8601
    *
    * @return string
    */
   public function toISO8601String()
   {
      return $this->format(DateTime::ISO8601);
   }

   /**
    * Format the instance as RFC822
    *
    * @return string
    */
   public function toRFC822String()
   {
      return $this->format(DateTime::RFC822);
   }

   /**
    * Format the instance as RFC850
    *
    * @return string
    */
   public function toRFC850String()
   {
      return $this->format(DateTime::RFC850);
   }

   /**
    * Format the instance as RFC1036
    *
    * @return string
    */
   public function toRFC1036String()
   {
      return $this->format(DateTime::RFC1036);
   }

   /**
    * Format the instance as RFC1123
    *
    * @return string
    */
   public function toRFC1123String()
   {
      return $this->format(DateTime::RFC1123);
   }

   /**
    * Format the instance as RFC2822
    *
    * @return string
    */
   public function toRFC2822String()
   {
      return $this->format(DateTime::RFC2822);
   }

   /**
    * Format the instance as RFC3339
    *
    * @return string
    */
   public function toRFC3339String()
   {
      return $this->format(DateTime::RFC3339);
   }

   /**
    * Format the instance as RSS
    *
    * @return string
    */
   public function toRSSString()
   {
      return $this->format(DateTime::RSS);
   }

   /**
    * Format the instance as W3C
    *
    * @return string
    */
   public function toW3CString()
   {
      return $this->format(DateTime::W3C);
   }

   ///////////////////////////////////////////////////////////////////
   ////////////////////////// COMPARISONS ////////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Determines if the instance is equal to another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function eq(Carbon $dt)
   {
      return $this == $dt;
   }

   /**
    * Determines if the instance is not equal to another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function ne(Carbon $dt)
   {
      return !$this->eq($dt);
   }

   /**
    * Determines if the instance is greater (after) than another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function gt(Carbon $dt)
   {
      return $this > $dt;
   }

   /**
    * Determines if the instance is greater (after) than or equal to another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function gte(Carbon $dt)
   {
      return $this >= $dt;
   }

   /**
    * Determines if the instance is less (before) than another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function lt(Carbon $dt)
   {
      return $this < $dt;
   }

   /**
    * Determines if the instance is less (before) or equal to another
    *
    * @param  Carbon $dt
    *
    * @return boolean
    */
   public function lte(Carbon $dt)
   {
      return $this <= $dt;
   }

  /**
   * Determines if the instance is between two others
   *
   * @param  Carbon  $dt1
   * @param  Carbon  $dt2
   * @param  boolean $equal  Indicates if a > and < comparison should be used or <= or >=
   *
   * @return boolean
   */
   public function between(Carbon $dt1, Carbon $dt2, $equal = true)
   {
      if ($dt1->gt($dt2)) {
         $temp = $dt1;
         $dt1 = $dt2;
         $dt2 = $temp;
      }

      if ($equal) {
         return $this->gte($dt1) && $this->lte($dt2);
      } else {
         return $this->gt($dt1) && $this->lt($dt2);
      }
   }

   /**
    * Determines if the instance is a weekday
    *
    * @return boolean
    */
   public function isWeekday()
   {
      return ($this->dayOfWeek != self::SUNDAY && $this->dayOfWeek != self::SATURDAY);
   }

   /**
    * Determines if the instance is a weekend day
    *
    * @return boolean
    */
   public function isWeekend()
   {
      return !$this->isWeekDay();
   }

   /**
    * Determines if the instance is yesterday
    *
    * @return boolean
    */
   public function isYesterday()
   {
      return $this->toDateString() === self::now($this->tz)->subDay()->toDateString();
   }

   /**
    * Determines if the instance is today
    *
    * @return boolean
    */
   public function isToday()
   {
      return $this->toDateString() === self::now($this->tz)->toDateString();
   }

   /**
    * Determines if the instance is tomorrow
    *
    * @return boolean
    */
   public function isTomorrow()
   {
      return $this->toDateString() === self::now($this->tz)->addDay()->toDateString();
   }

   /**
    * Determines if the instance is in the future, ie. greater (after) than now
    *
    * @return boolean
    */
   public function isFuture()
   {
      return $this->gt(self::now($this->tz));
   }

   /**
    * Determines if the instance is in the past, ie. less (before) than now
    *
    * @return boolean
    */
   public function isPast()
   {
      return !$this->isFuture();
   }

   /**
    * Determines if the instance is a leap year
    *
    * @return boolean
    */
   public function isLeapYear()
   {
      return $this->format('L') == '1';
   }

   ///////////////////////////////////////////////////////////////////
   /////////////////// ADDITIONS AND SUBSTRACTIONS ///////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Add years to the instance. Positive $value travel forward while
    * negative $value travel into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addYears($value)
   {
      return $this->modify(intval($value) . ' year');
   }

   /**
    * Add a year to the instance
    *
    * @return self
    */
   public function addYear()
   {
      return $this->addYears(1);
   }

   /**
    * Remove a year from the instance
    *
    * @return self
    */
   public function subYear()
   {
      return $this->addYears(-1);
   }

   /**
    * Remove years from the instance.
    *
    * @param integer $value
    *
    * @return self
    */
   public function subYears($value)
   {
      return $this->addYears(-1 * $value);
   }

   /**
    * Add months to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addMonths($value)
   {
      return $this->modify(intval($value) . ' month');
   }

   /**
    * Add a month to the instance
    *
    * @return self
    */
   public function addMonth()
   {
      return $this->addMonths(1);
   }

   /**
    * Remove a month from the instance
    *
    * @return self
    */
   public function subMonth()
   {
      return $this->addMonths(-1);
   }

   /**
    * Remove months from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subMonths($value)
   {
      return $this->addMonths(-1 * $value);
   }

   /**
    * Add days to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addDays($value)
   {
      return $this->modify(intval($value) . ' day');
   }

   /**
    * Add a day to the instance
    *
    * @return self
    */
   public function addDay()
   {
      return $this->addDays(1);
   }

   /**
    * Remove a day from the instance
    *
    * @return self
    */
   public function subDay()
   {
      return $this->addDays(-1);
   }

   /**
    * Remove days from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subDays($value)
   {
      return $this->addDays(-1 * $value);
   }

   /**
    * Add weekdays to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addWeekdays($value)
   {
      return $this->modify(intval($value) . ' weekday');
   }

   /**
    * Add a weekday to the instance
    *
    * @return self
    */
   public function addWeekday()
   {
      return $this->addWeekdays(1);
   }

   /**
    * Remove a weekday from the instance
    *
    * @return self
    */
   public function subWeekday()
   {
      return $this->addWeekdays(-1);
   }

   /**
    * Remove weekdays from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subWeekdays($value)
   {
      return $this->addWeekdays(-1 * $value);
   }

   /**
    * Add weeks to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addWeeks($value)
   {
      return $this->modify(intval($value) . ' week');
   }

   /**
    * Add a week to the instance
    *
    * @return self
    */
   public function addWeek()
   {
      return $this->addWeeks(1);
   }

   /**
    * Remove a week from the instance
    *
    * @return self
    */
   public function subWeek()
   {
      return $this->addWeeks(-1);
   }

   /**
    * Remove weeks to the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subWeeks($value)
   {
      return $this->addWeeks(-1 * $value);
   }

   /**
    * Add hours to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addHours($value)
   {
      return $this->modify(intval($value) . ' hour');
   }

   /**
    * Add an hour to the instance
    *
    * @return self
    */
   public function addHour()
   {
      return $this->addHours(1);
   }

   /**
    * Remove an hour from the instance
    *
    * @return self
    */
   public function subHour()
   {
      return $this->addHours(-1);
   }

   /**
    * Remove hours from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subHours($value)
   {
      return $this->addHours(-1 * $value);
   }

   /**
    * Add minutes to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addMinutes($value)
   {
      return $this->modify(intval($value) . ' minute');
   }

   /**
    * Add a minute to the instance
    *
    * @return self
    */
   public function addMinute()
   {
      return $this->addMinutes(1);
   }

   /**
    * Remove a minute from the instance
    *
    * @return self
    */
   public function subMinute()
   {
      return $this->addMinutes(-1);
   }

   /**
    * Remove minutes from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subMinutes($value)
   {
      return $this->addMinutes(-1 * $value);
   }

   /**
    * Add seconds to the instance. Positive $value travels forward while
    * negative $value travels into the past.
    *
    * @param integer $value
    *
    * @return self
    */
   public function addSeconds($value)
   {
      return $this->modify(intval($value) . ' second');
   }

   /**
    * Add a second to the instance
    *
    * @return self
    */
   public function addSecond()
   {
      return $this->addSeconds(1);
   }

   /**
    * Remove a second from the instance
    *
    * @return self
    */
   public function subSecond()
   {
      return $this->addSeconds(-1);
   }

   /**
    * Remove seconds from the instance
    *
    * @param integer $value
    *
    * @return self
    */
   public function subSeconds($value)
   {
      return $this->addSeconds(-1 * $value);
   }

   ///////////////////////////////////////////////////////////////////
   /////////////////////////// DIFFERENCES ///////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Get the difference in years
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInYears(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;
      $sign = ($abs) ? '' : '%r';

      return intval($this->diff($dt)->format($sign.'%y'));
   }

   /**
    * Get the difference in months
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInMonths(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;
      list($sign, $years, $months) = explode(':', $this->diff($dt)->format('%r:%y:%m'));
      $value = ($years * self::MONTHS_PER_YEAR) + $months;

      if ($sign === '-' && !$abs) {
         $value = $value * -1;
      }

      return $value;
   }

   /**
    * Get the difference in days
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInDays(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;
      $sign = ($abs) ? '' : '%r';

      return intval($this->diff($dt)->format($sign.'%a'));
   }

   /**
    * Get the difference in hours
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInHours(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;

      return intval($this->diffInMinutes($dt, $abs) / self::MINUTES_PER_HOUR);
   }

   /**
    * Get the difference in minutes
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInMinutes(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;

      return intval($this->diffInSeconds($dt, $abs) / self::SECONDS_PER_MINUTE);
   }

   /**
    * Get the difference in seconds
    *
    * @param  Carbon  $dt
    * @param  boolean $abs Get the absolute of the difference
    *
    * @return integer
    */
   public function diffInSeconds(Carbon $dt = null, $abs = true)
   {
      $dt = ($dt === null) ? static::now($this->tz) : $dt;
      $value = $dt->getTimestamp() - $this->getTimestamp();

      return $abs ? abs($value) : $value;
   }

   /**
    * Get the difference in a human readable format.
    *
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
    *
    * @param  Carbon  $other
    *
    * @return string
    */
   public function diffForHumans(Carbon $other = null)
   {
      $txt = '';

      $isNow = $other === null;

      if ($isNow) {
         $other = self::now();
      }

      $isFuture = $this->gt($other);

      $delta = $other->diffInSeconds($this);

      // 30 days per month, 365 days per year... good enough!!
      $divs = array(
         'second' => self::SECONDS_PER_MINUTE,
         'minute' => self::MINUTES_PER_HOUR,
         'hour'   => self::HOURS_PER_DAY,
         'day'    => 30,
         'month'  => self::MONTHS_PER_YEAR
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

   ///////////////////////////////////////////////////////////////////
   //////////////////////////// MODIFIERS ////////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * Resets the time to 00:00:00
    *
    * @return self
    */
   public function startOfDay()
   {
      return $this->hour(0)->minute(0)->second(0);
   }

   /**
    * Resets the time to 23:59:59
    *
    * @return self
    */
   public function endOfDay()
   {
      return $this->hour(23)->minute(59)->second(59);
   }

   /**
    * Resets the date to the first day of the month and the time to 00:00:00
    *
    * @return self
    */
   public function startOfMonth()
   {
      return $this->startOfDay()->day(1);
   }

   /**
    * Resets the date to end of the month and time to 23:59:59
    *
    * @return self
    */
   public function endOfMonth()
   {
      return $this->day($this->daysInMonth)->endOfDay();
   }

   /**
    * Resets the date to the first day of the ISO-8601 week (Monday) and the time to 00:00:00
    *
    * @return self
    */
    public function startOfWeek()
    {
        return $this->setISODate($this->year, $this->weekOfYear, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the ISO-8601 week (Sunday) and time to 23:59:59
     *
     * @return self
     */
    public function endOfWeek()
    {
        return $this->setISODate($this->year, $this->weekOfYear, 7)->endOfDay();
    }

   /**
   * Modify to the next occurance of a given day of the week.
   * If no dayOfWeek is provided, modify to the next occurance
   * of the current day of the week.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function next($dayOfWeek = null)
   {
      $this->startOfDay();
      if ($dayOfWeek === null) {
         $dayOfWeek = $this->dayOfWeek;
      }

      return $this->modify('next ' . self::$days[$dayOfWeek]);
   }

   /**
   * Modify to the previous occurance of a given day of the week.
   * If no dayOfWeek is provided, modify to the previous occurance
   * of the current day of the week.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function previous($dayOfWeek = null)
   {
      $this->startOfDay();
      if ($dayOfWeek === null) {
         $dayOfWeek = $this->dayOfWeek;
      }

      return $this->modify('last ' . self::$days[$dayOfWeek]);
   }

   /**
   * Modify to the first occurance of a given day of the week
   * in the current month. If no dayOfWeek is provided, modify to the
   * first day of the current month.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function firstOfMonth($dayOfWeek = null)
   {
      $this->startOfDay();
      if ($dayOfWeek === null) {
         return $this->day(1);
      }

      return $this->modify('first ' . self::$days[$dayOfWeek] . ' of ' . $this->format('F') . ' ' . $this->year);
   }

   /**
   * Modify to the last occurance of a given day of the week
   * in the current month. If no dayOfWeek is provided, modify to the
   * last day of the current month.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function lastOfMonth($dayOfWeek = null)
   {
      $this->startOfDay();
      if ($dayOfWeek === null) {
         return $this->day($this->daysInMonth);
      }

      return $this->modify('last ' . self::$days[$dayOfWeek] . ' of ' . $this->format('F') . ' ' . $this->year);
   }

   /**
   * Modify to the given occurance of a given day of the week
   * in the current month. If the calculated occurance is outside the scope
   * of the current month, then return false and no modifications are made.
   * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $nth
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function nthOfMonth($nth, $dayOfWeek)
   {
      $dt = $this->copy();
      $dt->firstOfMonth();
      $month = $dt->month;
      $year = $dt->year;
      $dt->modify('+' . $nth . ' ' . self::$days[$dayOfWeek]);
      if ($month !== $dt->month || $year !== $dt->year) return false;
      return $this->modify($dt);
   }

   /**
   * Modify to the first occurance of a given day of the week
   * in the current quarter. If no dayOfWeek is provided, modify to the
   * first day of the current quarter.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function firstOfQuarter($dayOfWeek = null)
   {
      $this->month(($this->quarter * 3) - 2);

      return $this->firstOfMonth($dayOfWeek);
   }

   /**
   * Modify to the last occurance of a given day of the week
   * in the current quarter. If no dayOfWeek is provided, modify to the
   * last day of the current quarter.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function lastOfQuarter($dayOfWeek = null)
   {
      $this->month(($this->quarter * 3));

      return $this->lastOfMonth($dayOfWeek);
   }

   /**
   * Modify to the given occurance of a given day of the week
   * in the current quarter. If the calculated occurance is outside the scope
   * of the current quarter, then return false and no modifications are made.
   * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $nth
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function nthOfQuarter($nth, $dayOfWeek)
   {
      $dt = $this->copy();
      $dt->month(($this->quarter * 3));
      $last_month = $dt->month;
      $year = $dt->year;
      $dt->firstOfQuarter();
      $dt->modify('+' . $nth . ' ' . self::$days[$dayOfWeek]);
      if ($last_month < $dt->month || $year !== $dt->year) return false;
      return $this->modify($dt);
   }

   /**
   * Modify to the first occurance of a given day of the week
   * in the current year. If no dayOfWeek is provided, modify to the
   * first day of the current year.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function firstOfYear($dayOfWeek = null)
   {
      $this->month(1);

      return $this->firstOfMonth($dayOfWeek);
   }

   /**
   * Modify to the last occurance of a given day of the week
   * in the current year. If no dayOfWeek is provided, modify to the
   * last day of the current year.  Use the supplied consts
   * to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function lastOfYear($dayOfWeek = null)
   {
      $this->month(12);

      return $this->lastOfMonth($dayOfWeek);
   }

   /**
   * Modify to the given occurance of a given day of the week
   * in the current year. If the calculated occurance is outside the scope
   * of the current year, then return false and no modifications are made.
   * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
   *
   * @param  int  $nth
   * @param  int  $dayOfWeek
   *
   * @return mixed
   */
   public function nthOfYear($nth, $dayOfWeek)
   {
      $dt = $this->copy();
      $year = $dt->year;
      $dt->firstOfYear();
      $dt->modify('+' . $nth . ' ' . self::$days[$dayOfWeek]);
      if ($year !== $dt->year) return false;
      return $this->modify($dt);
   }
}
