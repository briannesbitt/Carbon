<?php
/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * PHP version 5
 * 
 * @category DateTime
 *
 * @author   Brian Nesbitt <brian@nesbot.com>
 * @license  https://github.com/briannesbitt/Carbon/blob/master/LICENSE LICENSE
 *
 * @link     https://github.com/briannesbitt/Carbon
 */
namespace Carbon;

use Closure;
use DateTime;
use DateTimeZone;
use DatePeriod;
use InvalidArgumentException;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;

/**
 * A simple API extension for DateTime
 *
 * @property      int $year
 * @property      int $yearIso
 * @property      int $month
 * @property      int $day
 * @property      int $hour
 * @property      int $minute
 * @property      int $second
 * @property      int $timestamp seconds since the Unix Epoch
 * @property      \DateTimeZone $timezone the current timezone
 * @property      \DateTimeZone $tz alias of timezone
 * @property-read int $micro
 * @property-read int $dayOfWeek 0 (for Sunday) through 6 (for Saturday)
 * @property-read int $dayOfYear 0 through 365
 * @property-read int $weekOfMonth 1 through 5
 * @property-read int $weekOfYear ISO-8601 week number of year, weeks starting on Monday
 * @property-read int $daysInMonth number of days in the given month
 * @property-read int $age does a diffInYears() with default parameters
 * @property-read int $quarter the quarter of this instance, 1 - 4
 * @property-read int $offset the timezone offset in seconds from UTC
 * @property-read int $offsetHours the timezone offset in hours from UTC
 * @property-read bool $dst daylight savings time indicator, true if DST, false otherwise
 * @property-read bool $local checks if the timezone is local, true if local, false otherwise
 * @property-read bool $utc checks if the timezone is UTC, true if UTC, false otherwise
 * @property-read string $timezoneName
 * @property-read string $tzName
 */
class Carbon extends DateTime
{
    /**
     * The day constants.
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    /**
     * Names of days of the week.
     *
     * @var array
     */
    protected static $days = array(
                              self::SUNDAY    => 'Sunday',
                              self::MONDAY    => 'Monday',
                              self::TUESDAY   => 'Tuesday',
                              self::WEDNESDAY => 'Wednesday',
                              self::THURSDAY  => 'Thursday',
                              self::FRIDAY    => 'Friday',
                              self::SATURDAY  => 'Saturday',
                             );

    /**
     * Terms used to detect if a time passed is a relative date.
     *
     * This is here for testing purposes.
     *
     * @var array
     */
    protected static $relativeKeywords = array(
                                          'this',
                                          'next',
                                          'last',
                                          'tomorrow',
                                          'yesterday',
                                          '+',
                                          '-',
                                          'first',
                                          'last',
                                          'ago',
                                         );

    /**
     * Number of X in Y.
     */
    const YEARS_PER_CENTURY = 100;
    const YEARS_PER_DECADE = 10;
    const MONTHS_PER_YEAR = 12;
    const WEEKS_PER_YEAR = 52;
    const DAYS_PER_WEEK = 7;
    const HOURS_PER_DAY = 24;
    const MINUTES_PER_HOUR = 60;
    const SECONDS_PER_MINUTE = 60;

    /**
     * Default format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    const DEFAULT_TO_STRING_FORMAT = 'Y-m-d H:i:s';

    /**
     * Format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    protected static $toStringFormat = self::DEFAULT_TO_STRING_FORMAT;

    /**
     * First day of week.
     *
     * @var int
     */
    protected static $weekStartsAt = self::MONDAY;

    /**
     * Last day of week.
     *
     * @var int
     */
    protected static $weekEndsAt = self::SUNDAY;

    /**
     * Days of weekend.
     *
     * @var array
     */
    protected static $weekendDays = array(
                                     self::SATURDAY,
                                     self::SUNDAY,
                                    );

    /**
     * midday/noon hour
     *
     * @var int
     */
    protected static $midDayAt = 12;

    /**
     * A test Carbon instance to be returned when now instances are created.
     *
     * @var \Carbon\Carbon
     */
    protected static $testNow;

    /**
     * A translator to ... er ... translate stuff.
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected static $translator;

    /**
     * Creates a DateTimeZone from a string, DateTimeZone or integer offset.
     * 
     * @param \DateTimeZone|string|int|null $object mixed timezone
     * 
     * @static
     * 
     * @throws InvalidArgumentException
     *
     * @return \DateTimeZone
     */
    protected static function safeCreateDateTimeZone($object)
    {
        if ($object === null) {
            // Don't return null... avoid Bug #52063 in PHP <5.3.6 .
            $dateTimeZone = new DateTimeZone(date_default_timezone_get());

            return $dateTimeZone;
        }

        if ($object instanceof DateTimeZone) {
            return $object;
        }

        if (is_numeric($object) === true) {
            $timezoneOffset = ($object * 3600);
            $tzName = timezone_name_from_abbr(null, $timezoneOffset, true);

            if ($tzName === false) {
                throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
            }

            $object = $tzName;
        }

        $tz = @timezone_open((string) $object);

        if ($tz === false) {
            throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
        }

        return $tz;
    }//end safeCreateDateTimeZone()

    /**
     * ******************************************************************************
     * ************************ CONSTRUCTORS ****************************************
     * ******************************************************************************
     */

    /**
     * Create a new Carbon instance.
     *
     * Please see the testing aids section (specifically static::setTestNow())
     * for more on the possibility of this constructor returning a test instance.
     * 
     * @param string|null               $time time
     * @param \DateTimeZone|string|null $tz   timezone
     */
    public function __construct($time=null, $tz=null)
    {
        // If the class has a test now set and we are trying to create a now().
        // instance then override as required.
        if (static::hasTestNow() === true && (empty($time) === true || $time === 'now' || static::hasRelativeKeywords($time)) === true) {
            $testInstance = clone static::getTestNow();
            if (static::hasRelativeKeywords($time) === true) {
                $testInstance->modify($time);
            }

            // Shift the time according to the given time zone.
            if ($tz !== null && $tz !== static::getTestNow()->tz) {
                $testInstance->setTimezone($tz);
            } else {
                $tz = $testInstance->tz;
            }

            $time = $testInstance->toDateTimeString();
        }

        parent::__construct($time, static::safeCreateDateTimeZone($tz));
    }//end __construct()

    /**
     * Create a Carbon instance from a DateTime one.
     * 
     * @param \DateTime $dt DateTime Object
     *                       
     * @static
     *
     * @return static
     */
    public static function instance(DateTime $dt)
    {
        if ($dt instanceof static) {
            return clone $dt;
        }

        $instance = new static($dt->format('Y-m-d H:i:s.u'), $dt->getTimeZone());

        return $instance;
    }//end instance()

    /**
     * Create a carbon instance from a string.
     *
     * This is an alias for the constructor that allows better fluent syntax
     * as it allows you to do Carbon::parse('Monday next week')->fn() rather
     * than (new Carbon('Monday next week'))->fn().
     *
     * @param string|null               $time time
     * @param \DateTimeZone|string|null $tz   timezone 
     * 
     * @static
     *
     * @return static
     */
    public static function parse($time=null, $tz=null)
    {
        $staticObject = new static($time, $tz);

        return $staticObject;
    }//end parse()

    /**
     * Get a Carbon instance for the current date and time.
     *
     * @param \DateTimeZone|string|null $tz timezone
     * 
     * @static
     *
     * @return static
     */
    public static function now($tz=null)
    {
        $staticObject = new static(null, $tz);

        return $staticObject;
    }//end now()

    /**
     * Create a Carbon instance for today.
     *
     * @param \DateTimeZone|string|null $tz timezone
     * 
     * @static
     *
     * @return static
     */
    public static function today($tz=null)
    {
        return static::now($tz)->startOfDay();
    }//end today()

    /**
     * Create a Carbon instance for tomorrow.
     *
     * @param \DateTimeZone|string|null $tz timezone
     * 
     * @static
     *
     * @return static
     */
    public static function tomorrow($tz=null)
    {
        return static::today($tz)->addDay();
    }//end tomorrow()

    /**
     * Create a Carbon instance for yesterday.
     *
     * @param \DateTimeZone|string|null $tz timezone
     * 
     * @static
     *
     * @return static
     */
    public static function yesterday($tz=null)
    {
        return static::today($tz)->subDay();
    }//end yesterday()

    /**
     * Create a Carbon instance for the greatest supported date.
     *
     * @static
     *
     * @return static
     */
    public static function maxValue()
    {
        if (PHP_INT_SIZE === 4) {
            // Int 32 bit (and additionally Windows 64 bit).
            return static::createFromTimestamp(PHP_INT_MAX);
        }

        // Int 64 bit.
        return static::create(9999, 12, 31, 23, 59, 59);
    }//end maxValue()

    /**
     * Create a Carbon instance for the lowest supported date.
     *
     * @static
     * 
     * @return static
     */
    public static function minValue()
    {
        if (PHP_INT_SIZE === 4) {
            // Int 32 bit (and additionally Windows 64 bit).
            return static::createFromTimestamp(~PHP_INT_MAX);
        }

        // Int 64 bit.
        return static::create(1, 1, 1, 0, 0, 0);
    }//end minValue()

    /**
     * Create a new Carbon instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values will
     * be used.
     *
     * If $hour is null it will be set to its now() value and the default
     * values for $minute and $second will be their now() values.
     *
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * @param int|null                  $year   year
     * @param int|null                  $month  month
     * @param int|null                  $day    day
     * @param int|null                  $hour   hour
     * @param int|null                  $minute minute
     * @param int|null                  $second second
     * @param \DateTimeZone|string|null $tz     timezone
     * 
     * @static
     *
     * @return static
     */
    public static function create($year=null, $month=null, $day=null, $hour=null, $minute=null, $second=null, $tz=null)
    {
        $year = $year === null ? date('Y') : $year;
        $month = $month === null ? date('n') : $month;
        $day = $day === null ? date('j') : $day;

        if ($hour === null) {
            $hour = date('G');
            $minute = $minute === null ? date('i') : $minute;
            $second = $second === null ? date('s') : $second;
        } else {
            $minute = $minute === null ? 0 : $minute;
            $second = $second === null ? 0 : $second;
        }

        return static::createFromFormat('Y-n-j G:i:s', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);
    }//end create()

    /**
     * Create a Carbon instance from just a date. The time portion is set to now.
     *
     * @param int|null                  $year  year
     * @param int|null                  $month month
     * @param int|null                  $day   day
     * @param \DateTimeZone|string|null $tz    timezone
     * 
     * @static
     * 
     * @return static
     */
    public static function createFromDate($year=null, $month=null, $day=null, $tz=null)
    {
        return static::create($year, $month, $day, null, null, null, $tz);
    }//end createFromDate()

    /**
     * Create a Carbon instance from just a time. The date portion is set to today.
     * 
     * @param int|null                  $hour   hour
     * @param int|null                  $minute minute
     * @param int|null                  $second second
     * @param \DateTimeZone|string|null $tz     timezone
     * 
     * @static 
     * 
     * @return static
     */
    public static function createFromTime($hour=null, $minute=null, $second=null, $tz=null)
    {
        return static::create(null, null, null, $hour, $minute, $second, $tz);
    }//end createFromTime()

    /**
     * Create a Carbon instance from a specific format.
     * 
     * @param string                    $format Datetime format
     * @param string                    $time   time
     * @param \DateTimeZone|string|null $tz     timezone
     * 
     * @static
     * 
     * @throws InvalidArgumentException
     *
     * @return static
     */
    public static function createFromFormat($format, $time, $tz=null)
    {
        if ($tz !== null) {
            $dt = parent::createFromFormat($format, $time, static::safeCreateDateTimeZone($tz));
        } else {
            $dt = parent::createFromFormat($format, $time);
        }

        if ($dt instanceof DateTime) {
            return static::instance($dt);
        }

        $errors = static::getLastErrors();
        throw new InvalidArgumentException(implode(PHP_EOL, $errors['errors']));
    }//end createFromFormat()

    /**
     * Create a Carbon instance from a timestamp.
     * 
     * @param int                       $timestamp timestamp
     * @param \DateTimeZone|string|null $tz        timezone
     * 
     * @static 
     * 
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz=null)
    {
        return static::now($tz)->setTimestamp($timestamp);
    }//end createFromTimestamp()

    /**
     * Create a Carbon instance from an UTC timestamp.
     * 
     * @param int $timestamp timestamp
     * 
     * @static
     * 
     * @return static
     */
    public static function createFromTimestampUTC($timestamp)
    {
        $staticObject = new static('@'.$timestamp);

        return $staticObject;
    }//end createFromTimestampUTC()

    /**
     * Get a copy of the instance.
     * 
     * 
     * @return static
     */
    public function copy()
    {
        return static::instance($this);
    }//end copy()

    /**
     * ******************************************************************************
     * ************************ GETTERS AND SETTERS *********************************
     * ******************************************************************************
     */

    /**
     * Get a part of the Carbon object
     * 
     * @param string $name property name
     * 
     * @throws InvalidArgumentException
     *
     * @return string|int|\DateTimeZone
     */
    public function __get($name)
    {
        $formats = array(
                    'year'        => 'Y',
                    'yearIso'     => 'o',
                    'month'       => 'n',
                    'day'         => 'j',
                    'hour'        => 'G',
                    'minute'      => 'i',
                    'second'      => 's',
                    'micro'       => 'u',
                    'dayOfWeek'   => 'w',
                    'dayOfYear'   => 'z',
                    'weekOfYear'  => 'W',
                    'daysInMonth' => 't',
                    'timestamp'   => 'U',
                   );

        switch (true) {
            case array_key_exists($name, $formats):
                return (int) $this->format($formats[$name]);

            case $name === 'weekOfMonth':
                return (int) ceil($this->day / static::DAYS_PER_WEEK);

            case $name === 'age':
                return (int) $this->diffInYears();

            case $name === 'quarter':
                return (int) ceil($this->month / 3);

            case $name === 'offset':
                return $this->getOffset();

            case $name === 'offsetHours':
                return $this->getOffset() / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR;

            case $name === 'dst':
                return $this->format('I') === '1';

            case $name === 'local':
                return $this->offset === $this->copy()->setTimezone(date_default_timezone_get())->offset;

            case $name === 'utc':
                return $this->offset === 0;

            case $name === 'timezone' || $name === 'tz':
                return $this->getTimezone();

            case $name === 'timezoneName' || $name === 'tzName':
                return $this->getTimezone()->getName();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }//end switch
    }//end __get()

    /**
     * Check if an attribute exists on the object
     * 
     * @param string $name property name
     * 
     * @return bool
     */
    public function __isset($name)
    {
        try {
            $this->__get($name);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }//end __isset()

    /**
     * Set a part of the Carbon object
     * 
     * @param string                   $name  property name
     * @param string|int|\DateTimeZone $value property value
     * 
     * @throws InvalidArgumentException
     *
     * @return void
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case 'year':
                $this->setDate($value, $this->month, $this->day);
                break;

            case 'month':
                $this->setDate($this->year, $value, $this->day);
                break;

            case 'day':
                $this->setDate($this->year, $this->month, $value);
                break;

            case 'hour':
                $this->setTime($value, $this->minute, $this->second);
                break;

            case 'minute':
                $this->setTime($this->hour, $value, $this->second);
                break;

            case 'second':
                $this->setTime($this->hour, $this->minute, $value);
                break;

            case 'timestamp':
                parent::setTimestamp($value);
                break;

            case 'timezone':
            case 'tz':
                $this->setTimezone($value);
                break;

            default:
                throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }//end switch
    }//end __set()

    /**
     * Set the instance's year
     * 
     * @param int $value year
     * 
     * @return static
     */
    public function year($value)
    {
        $this->year = $value;

        return $this;
    }//end year()

    /**
     * Set the instance's month
     * 
     * @param int $value month
     * 
     * @return static
     */
    public function month($value)
    {
        $this->month = $value;

        return $this;
    }//end month()

    /**
     * Set the instance's day
     * 
     * @param int $value day
     * 
     * @return static
     */
    public function day($value)
    {
        $this->day = $value;

        return $this;
    }//end day()

    /**
     * Set the instance's hour
     * 
     * @param int $value hour
     * 
     * @return static
     */
    public function hour($value)
    {
        $this->hour = $value;

        return $this;
    }//end hour()

    /**
     * Set the instance's minute
     * 
     * @param int $value minute
     * 
     * @return static
     */
    public function minute($value)
    {
        $this->minute = $value;

        return $this;
    }//end minute()

    /**
     * Set the instance's second
     * 
     * @param int $value second
     * 
     * @return static
     */
    public function second($value)
    {
        $this->second = $value;

        return $this;
    }//end second()

    /**
     * Sets the current date of the DateTime object to a different date.
     * Calls modify as a workaround for a php bug
     * 
     * @param int $year  year
     * @param int $month month
     * @param int $day   day
     * 
     * @return Carbon
     *
     * @see https://github.com/briannesbitt/Carbon/issues/539
     * @see https://bugs.php.net/bug.php?id=63863
     */
    public function setDate($year, $month, $day)
    {
        $this->modify('+0 day');

        return parent::setDate($year, $month, $day);
    }//end setDate()

    /**
     * Set the date and time all together
     * 
     * @param int $year   year
     * @param int $month  month
     * @param int $day    day
     * @param int $hour   hour
     * @param int $minute minute
     * @param int $second second
     * 
     * @return static
     */
    public function setDateTime($year, $month, $day, $hour, $minute, $second=0)
    {
        return $this->setDate($year, $month, $day)->setTime($hour, $minute, $second);
    }//end setDateTime()

    /**
     * Set the time by time string
     * 
     * @param string $time time
     * 
     * @return static
     */
    public function setTimeFromTimeString($time)
    {
        $time = explode(':', $time);

        $hour = $time[0];
        $minute = isset($time[1]) ? $time[1] : 0;
        $second = isset($time[2]) ? $time[2] : 0;

        return $this->setTime($hour, $minute, $second);
    }//end setTimeFromTimeString()

    /**
     * Set the instance's timestamp
     * 
     * @param int $value timestamp
     * 
     * @return static
     */
    public function timestamp($value)
    {
        $this->timestamp = $value;

        return $this;
    }//end timestamp()

    /**
     * Alias for setTimezone()
     * 
     * @param \DateTimeZone|string $value timezone
     * 
     * @return static
     */
    public function timezone($value)
    {
        return $this->setTimezone($value);
    }//end timezone()

    /**
     * Alias for setTimezone()
     * 
     * @param \DateTimeZone|string $value timezone
     * 
     * @return static
     */
    public function tz($value)
    {
        return $this->setTimezone($value);
    }//end tz()

    /**
     * Set the instance's timezone from a string or object
     * 
     * @param \DateTimeZone|string $value timezone
     * 
     * @return static
     */
    public function setTimezone($value)
    {
        return parent::setTimezone(static::safeCreateDateTimeZone($value));
    }//end setTimezone()

    /**
     * ******************************************************************************
     * ************************ WEEK SPECIAL DAYS ***********************************
     * ******************************************************************************
     */

    /**
     * Get the first day of week
     * 
     * @static
     * 
     * @return int
     */
    public static function getWeekStartsAt()
    {
        return static::$weekStartsAt;
    }//end getWeekStartsAt()

    /**
     * Set the first day of week
     * 
     * @param int $day week start day
     * 
     * @static
     *
     * @return void
     */
    public static function setWeekStartsAt($day)
    {
        static::$weekStartsAt = $day;
    }//end setWeekStartsAt()

    /**
     * Get the last day of week
     * 
     * @static
     *
     * @return int
     */
    public static function getWeekEndsAt()
    {
        return static::$weekEndsAt;
    }//end getWeekEndsAt()

    /**
     * Set the first day of week
     * 
     * @param int $day week end day
     * 
     * @static
     *
     * @return void
     */
    public static function setWeekEndsAt($day)
    {
        static::$weekEndsAt = $day;
    }//end setWeekEndsAt()

    /**
     * Get weekend days
     * 
     * @static
     *
     * @return array
     */
    public static function getWeekendDays()
    {
        return static::$weekendDays;
    }//end getWeekendDays()

    /**
     * Set weekend days
     * 
     * @param array $days weekend days
     * 
     * @static
     *
     * @return void
     */
    public static function setWeekendDays($days)
    {
        static::$weekendDays = $days;
    }//end setWeekendDays()

    /**
     * get midday/noon hour
     * 
     * @return int
     */
    public static function getMidDayAt()
    {
        return static::$midDayAt;
    }//end getMidDayAt()

    /**
     * Set midday/noon hour
     * 
     * @param int $hour midday hour
     * 
     * @return void
     */
    public static function setMidDayAt(int $hour)
    {
        static::$midDayAt = $hour;
    }//end setMidDayAt()

    /**
     * ******************************************************************************
     * ************************ TESTING AIDS ****************************************
     * ******************************************************************************
     */

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
     * @param \Carbon\Carbon|null $testNow real or mock Carbon instance
     * 
     * @static
     *
     * @return void
     */
    public static function setTestNow(Carbon $testNow=null)
    {
        static::$testNow = $testNow;
    }//end setTestNow()

    /**
     * Get the Carbon instance (real or mock) to be returned when a "now"
     * instance is created.
     * 
     * @static
     *
     * @return static the current instance used for testing
     */
    public static function getTestNow()
    {
        return static::$testNow;
    }//end getTestNow()

    /**
     * Determine if there is a valid test instance set. A valid test instance
     * is anything that is not null.
     * 
     * @static
     * 
     * @return bool true if there is a test instance, otherwise false
     */
    public static function hasTestNow()
    {
        return static::getTestNow() !== null;
    }//end hasTestNow()

    /**
     * Determine if there is a relative keyword in the time string, this is to
     * create dates relative to now for test instances. e.g.: next tuesday
     * 
     * @param string $time time
     * 
     * @static
     *
     * @return bool true if there is a keyword, otherwise false
     */
    public static function hasRelativeKeywords($time)
    {
        // Skip common format with a '-' in it.
        if (preg_match('/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/', $time) !== 1) {
            foreach (static::$relativeKeywords as $keyword) {
                if (stripos($time, $keyword) !== false) {
                    return true;
                }
            }
        }

        return false;
    }//end hasRelativeKeywords()

    /**
     * ******************************************************************************
     * ************************ LOCALIZATION ****************************************
     * ******************************************************************************
     */

    /**
     * Intialize the translator instance if necessary.
     * 
     * @static
     * 
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected static function translator()
    {
        $arrayLoader = new ArrayLoader();
        if (static::$translator === null) {
            static::$translator = new Translator('en');
            static::$translator->addLoader('array', $arrayLoader);
            static::setLocale('en');
        }

        return static::$translator;
    }//end translator()

    /**
     * Get the translator instance in use
     * 
     * @static
     * 
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }//end getTranslator()

    /**
     * Set the translator instance to use
     * 
     * @param \Symfony\Component\Translation\TranslatorInterface $translator translator
     * 
     * @static
     *
     * @return void
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }//end setTranslator()

    /**
     * Get the current translator locale
     * 
     * @static
     * 
     * @return string
     */
    public static function getLocale()
    {
        return static::translator()->getLocale();
    }//end getLocale()

    /**
     * Set the current translator locale and indicate if the source locale file exists
     * 
     * @param string $locale locale ex. en
     * 
     * @static
     * 
     * @return bool
     */
    public static function setLocale($locale)
    {
        $matches = array();

        if (preg_match('/([a-z]{2})[-_]([a-z]{2})/i', $locale, $matches) === 1) {
            $locale = strtolower($matches[1]).'_'.strtoupper($matches[2]);
        } else {
            $locale = strtolower($locale);
        }

        if (file_exists(__DIR__.'/Lang/'.$locale.'.php') === false) {
            return false;
        }

        static::translator()->setLocale($locale);

        // Ensure the locale has been loaded.
        static::translator()->addResource('array', require __DIR__.'/Lang/'.$locale.'.php', $locale);

        return true;
    }//end setLocale()

    /**
     * ******************************************************************************
     * ************************ STRING FORMATTING ***********************************
     * ******************************************************************************
     */

    /**
     * Format the instance with the current locale.  You can set the current
     * locale using setlocale() http://php.net/setlocale.
     * 
     * @param string $format fprmat
     * 
     * @return string
     */
    public function formatLocalized($format)
    {
        // Check for Windows to find and replace the %e modifier correctly.
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
        }

        return strftime($format, strtotime($this));
    }//end formatLocalized()

    /**
     * Reset the format used to the default when type juggling a Carbon instance to a string
     * 
     * @static
     *
     * @return void
     */
    public static function resetToStringFormat()
    {
        static::setToStringFormat(static::DEFAULT_TO_STRING_FORMAT);
    }//end resetToStringFormat()

    /**
     * Set the default format used when type juggling a Carbon instance to a string
     * 
     * @param string $format format
     * 
     * @static
     *
     * @return void
     */
    public static function setToStringFormat($format)
    {
        static::$toStringFormat = $format;
    }//end setToStringFormat()

    /**
     * Format the instance as a string using the set format
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->format(static::$toStringFormat);
    }//end __toString()

    /**
     * Format the instance as date
     * 
     * @return string
     */
    public function toDateString()
    {
        return $this->format('Y-m-d');
    }//end toDateString()

    /**
     * Format the instance as a readable date
     * 
     * @return string
     */
    public function toFormattedDateString()
    {
        return $this->format('M j, Y');
    }//end toFormattedDateString()

    /**
     * Format the instance as time
     * 
     * 
     * @return string
     */
    public function toTimeString()
    {
        return $this->format('H:i:s');
    }//end toTimeString()

    /**
     * Format the instance as date and time
     * 
     * @return string
     */
    public function toDateTimeString()
    {
        return $this->format('Y-m-d H:i:s');
    }//end toDateTimeString()

    /**
     * Format the instance with day, date and time
     * 
     * @return string
     */
    public function toDayDateTimeString()
    {
        return $this->format('D, M j, Y g:i A');
    }//end toDayDateTimeString()

    /**
     * Format the instance as ATOM
     * 
     * @return string
     */
    public function toAtomString()
    {
        return $this->format(static::ATOM);
    }//end toAtomString()

    /**
     * Format the instance as COOKIE
     * 
     * @return string
     */
    public function toCookieString()
    {
        return $this->format(static::COOKIE);
    }//end toCookieString()

    /**
     * Format the instance as ISO8601
     * 
     * @return string
     */
    public function toIso8601String()
    {
        return $this->toAtomString();
    }//end toIso8601String()

    /**
     * Format the instance as RFC822
     * 
     * @return string
     */
    public function toRfc822String()
    {
        return $this->format(static::RFC822);
    }//end toRfc822String()

    /**
     * Format the instance as RFC850
     * 
     * @return string
     */
    public function toRfc850String()
    {
        return $this->format(static::RFC850);
    }//end toRfc850String()

    /**
     * Format the instance as RFC1036
     * 
     * @return string
     */
    public function toRfc1036String()
    {
        return $this->format(static::RFC1036);
    }//end toRfc1036String()

    /**
     * Format the instance as RFC1123
     * 
     * @return string
     */
    public function toRfc1123String()
    {
        return $this->format(static::RFC1123);
    }//end toRfc1123String()

    /**
     * Format the instance as RFC2822
     * 
     * @return string
     */
    public function toRfc2822String()
    {
        return $this->format(static::RFC2822);
    }//end toRfc2822String()

    /**
     * Format the instance as RFC3339
     * 
     * 
     * @return string
     */
    public function toRfc3339String()
    {
        return $this->format(static::RFC3339);
    }//end toRfc3339String()

    /**
     * Format the instance as RSS
     * 
     * @return string
     */
    public function toRssString()
    {
        return $this->format(static::RSS);
    }//end toRssString()

    /**
     * Format the instance as W3C
     * 
     * @return string
     */
    public function toW3cString()
    {
        return $this->format(static::W3C);
    }//end toW3cString()

    /**
     * Get default array representation
     * 
     * @return array
     */
    public function toArray()
    {
        return array(
                'year'      => $this->year,
                'month'     => $this->month,
                'day'       => $this->day,
                'dayOfWeek' => $this->dayOfWeek,
                'dayOfYear' => $this->dayOfYear,
                'hour'      => $this->hour,
                'minute'    => $this->minute,
                'second'    => $this->second,
                'timestamp' => $this->timestamp,
                'formatted' => $this->format(self::DEFAULT_TO_STRING_FORMAT),
                'timezone'  => $this->timezone,
               );
    }//end toArray()

    /**
     * ******************************************************************************
     * ************************ COMPARISONS ****************************************
     * ******************************************************************************
     */

    /**
     * Determines if the instance is equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function eq(Carbon $dt)
    {
        return $this == $dt;
    }//end eq()

    /**
     * Determines if the instance is equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @see eq()
     *
     * @return bool
     */
    public function equalTo(Carbon $dt)
    {
        return $this->eq($dt);
    }//end equalTo()

    /**
     * Determines if the instance is not equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function ne(Carbon $dt)
    {
        return !$this->eq($dt);
    }//end ne()

    /**
     * Determines if the instance is not equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @see ne()
     *
     * @return bool
     */
    public function notEqualTo(Carbon $dt)
    {
        return $this->ne($dt);
    }//end notEqualTo()

    /**
     * Determines if the instance is greater (after) than another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function gt(Carbon $dt)
    {
        return $this > $dt;
    }//end gt()

    /**
     * Determines if the instance is greater (after) than another
     * 
     * @param Carbon $dt datetime
     * 
     * @see gt()
     *
     * @return bool
     */
    public function greaterThan(Carbon $dt)
    {
        return $this->gt($dt);
    }//end greaterThan()

    /**
     * Determines if the instance is greater (after) than or equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function gte(Carbon $dt)
    {
        return $this >= $dt;
    }//end gte()

    /**
     * Determines if the instance is greater (after) than or equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @see gte()
     *
     * @return bool
     */
    public function greaterThanOrEqualTo(Carbon $dt)
    {
        return $this->gte($dt);
    }//end greaterThanOrEqualTo()

    /**
     * Determines if the instance is less (before) than another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function lt(Carbon $dt)
    {
        return $this < $dt;
    }//end lt()

    /**
     * Determines if the instance is less (before) than another
     * 
     * @param Carbon $dt datetime
     * 
     * @see lt()
     *
     * @return bool
     */
    public function lessThan(Carbon $dt)
    {
        return $this->lt($dt);
    }//end lessThan()

    /**
     * Determines if the instance is less (before) or equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @return bool
     */
    public function lte(Carbon $dt)
    {
        return $this <= $dt;
    }//end lte()

    /**
     * Determines if the instance is less (before) or equal to another
     * 
     * @param Carbon $dt datetime
     * 
     * @see lte()
     *
     * @return bool
     */
    public function lessThanOrEqualTo(Carbon $dt)
    {
        return $this->lte($dt);
    }//end lessThanOrEqualTo()

    /**
     * Determines if the instance is between two others
     * 
     * @param Carbon $dt1   datetime
     * @param Carbon $dt2   datetome
     * @param bool   $equal Indicates if a > and < comparison should be used or <= or >=
     * 
     * @return bool
     */
    public function between(Carbon $dt1, Carbon $dt2, $equal=true)
    {
        if ($dt1->gt($dt2) === true) {
            $temp = $dt1;
            $dt1 = $dt2;
            $dt2 = $temp;
        }

        if ($equal === true) {
            return $this->gte($dt1) && $this->lte($dt2);
        }

        return $this->gt($dt1) && $this->lt($dt2);
    }//end between()

    /**
     * Get the closest date from the instance.
     * 
     * @param Carbon $dt1 datetime
     * @param Carbon $dt2 datetime
     * 
     * @return static
     */
    public function closest(Carbon $dt1, Carbon $dt2)
    {
        return $this->diffInSeconds($dt1) < $this->diffInSeconds($dt2) ? $dt1 : $dt2;
    }//end closest()

    /**
     * Get the farthest date from the instance.
     * 
     * @param Carbon $dt1 datetime
     * @param Carbon $dt2 datetime
     * 
     * @return static
     */
    public function farthest(Carbon $dt1, Carbon $dt2)
    {
        return $this->diffInSeconds($dt1) > $this->diffInSeconds($dt2) ? $dt1 : $dt2;
    }//end farthest()

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     * 
     * @param \Carbon\Carbon|null $dt datetime default null
     *
     * @return static
     */
    public function min(Carbon $dt=null)
    {
        $dt = $dt ?: static::now($this->tz);

        return $this->lt($dt) ? $this : $dt;
    }//end min()

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     * 
     * @param \Carbon\Carbon|null $dt datetime default null
     * 
     * @see min()
     *
     * @return static
     */
    public function minimum(Carbon $dt=null)
    {
        return $this->min($dt);
    }//end minimum()

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     * 
     * @param \Carbon\Carbon|null $dt datetime default null
     * 
     * @return static
     */
    public function max(Carbon $dt=null)
    {
        $dt = $dt ?: static::now($this->tz);

        return $this->gt($dt) ? $this : $dt;
    }//end max()

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     * 
     * @param \Carbon\Carbon|null $dt datetime default null
     * 
     * @see max()
     *
     * @return static
     */
    public function maximum(Carbon $dt=null)
    {
        return $this->max($dt);
    }//end maximum()

    /**
     * Determines if the instance is a weekday
     * 
     * @return bool
     */
    public function isWeekday()
    {
        return !$this->isWeekend();
    }//end isWeekday()

    /**
     * Determines if the instance is a weekend day
     * 
     * @return bool
     */
    public function isWeekend()
    {
        return in_array($this->dayOfWeek, self::$weekendDays);
    }//end isWeekend()

    /**
     * Determines if the instance is yesterday
     * 
     * @return bool
     */
    public function isYesterday()
    {
        return $this->toDateString() === static::yesterday($this->tz)->toDateString();
    }//end isYesterday()

    /**
     * Determines if the instance is today
     * 
     * @return bool
     */
    public function isToday()
    {
        return $this->toDateString() == static::now($this->tz)->toDateString();
    }//end isToday()

    /**
     * Determines if the instance is tomorrow
     * 
     * @return bool
     */
    public function isTomorrow()
    {
        return $this->toDateString() === static::tomorrow($this->tz)->toDateString();
    }//end isTomorrow()

    /**
     * Determines if the instance is in the future, ie. greater (after) than now
     * 
     * @return bool
     */
    public function isFuture()
    {
        return $this->gt(static::now($this->tz));
    }//end isFuture()

    /**
     * Determines if the instance is in the past, ie. less (before) than now
     * 
     * @return bool
     */
    public function isPast()
    {
        return $this->lt(static::now($this->tz));
    }//end isPast()

    /**
     * Determines if the instance is a leap year
     * 
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->format('L') === '1';
    }//end isLeapYear()

    /**
     * Checks if the passed in date is the same day as the instance current day.
     * 
     * @param \Carbon\Carbon $dt datetime
     * 
     * @return bool
     */
    public function isSameDay(Carbon $dt)
    {
        return $this->toDateString() === $dt->toDateString();
    }//end isSameDay()

    /**
     * Checks if this day is a Sunday.
     * 
     * @return bool
     */
    public function isSunday()
    {
        return $this->dayOfWeek === static::SUNDAY;
    }//end isSunday()

    /**
     * Checks if this day is a Monday.
     * 
     * @return bool
     */
    public function isMonday()
    {
        return $this->dayOfWeek === static::MONDAY;
    }//end isMonday()

    /**
     * Checks if this day is a Tuesday.
     * 
     * @return bool
     */
    public function isTuesday()
    {
        return $this->dayOfWeek === static::TUESDAY;
    }//end isTuesday()

    /**
     * Checks if this day is a Wednesday.
     * 
     * @return bool
     */
    public function isWednesday()
    {
        return $this->dayOfWeek === static::WEDNESDAY;
    }//end isWednesday()

    /**
     * Checks if this day is a Thursday.
     * 
     * @return bool
     */
    public function isThursday()
    {
        return $this->dayOfWeek === static::THURSDAY;
    }//end isThursday()

    /**
     * Checks if this day is a Friday.
     * 
     * @return bool
     */
    public function isFriday()
    {
        return $this->dayOfWeek === static::FRIDAY;
    }//end isFriday()

    /**
     * Checks if this day is a Saturday.
     * 
     * @return bool
     */
    public function isSaturday()
    {
        return $this->dayOfWeek === static::SATURDAY;
    }//end isSaturday()

    /**
     * ******************************************************************************
     * ************************ ADDITIONS AND SUBTRACTIONS  *************************
     * ******************************************************************************
     */

    /**
     * Add years to the instance. Positive $value travel forward while
     * negative $value travel into the past.
     * 
     * @param int $value years to be added
     * 
     * @return static
     */
    public function addYears($value)
    {
        return $this->modify((int) $value.' year');
    }//end addYears()

    /**
     * Add a year to the instance
     * 
     * @param int $value years to be added default 1
     * 
     * @return static
     */
    public function addYear($value=1)
    {
        return $this->addYears($value);
    }//end addYear()

    /**
     * Remove a year from the instance
     * 
     * @param int $value years to be subtracted default 1
     * 
     * @return static
     */
    public function subYear($value=1)
    {
        return $this->subYears($value);
    }//end subYear()

    /**
     * Remove years from the instance.
     * 
     * @param int $value years to be subtracted
     * 
     * @return static
     */
    public function subYears($value)
    {
        return $this->addYears((-1 * $value));
    }//end subYears()

    /**
     * Add months to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value months to be added
     * 
     * @return static
     */
    public function addMonths($value)
    {
        return $this->modify((int) $value.' month');
    }//end addMonths()

    /**
     * Add a month to the instance
     * 
     * @param int $value months to be added default 1
     * 
     * @return static
     */
    public function addMonth($value=1)
    {
        return $this->addMonths($value);
    }//end addMonth()

    /**
     * Remove a month from the instance
     * 
     * @param int $value months to be subtracted default 1
     * 
     * @return static
     */
    public function subMonth($value=1)
    {
        return $this->subMonths($value);
    }//end subMonth()

    /**
     * Remove months from the instance
     * 
     * @param int $value months to be subtracted
     * 
     * @return static
     */
    public function subMonths($value)
    {
        return $this->addMonths((-1 * $value));
    }//end subMonths()

    /**
     * Add months without overflowing to the instance. Positive $value
     * travels forward while negative $value travels into the past.
     * 
     * @param int $value months to be added no overflow
     * 
     * @return static
     */
    public function addMonthsNoOverflow($value)
    {
        $date = $this->copy()->addMonths($value);

        if ($date->day !== $this->day) {
            $date->day(1)->subMonth()->day($date->daysInMonth);
        }

        return $date;
    }//end addMonthsNoOverflow()

    /**
     * Add a month with no overflow to the instance
     * 
     * @param int $value months to be added no overflow default 1
     * 
     * @return static
     */
    public function addMonthNoOverflow($value=1)
    {
        return $this->addMonthsNoOverflow($value);
    }//end addMonthNoOverflow()

    /**
     * Remove a month with no overflow from the instance
     * 
     * @param int $value months to be subtracted default 1
     * 
     * @return static
     */
    public function subMonthNoOverflow($value=1)
    {
        return $this->subMonthsNoOverflow($value);
    }//end subMonthNoOverflow()

    /**
     * Remove months with no overflow from the instance
     * 
     * @param int $value months to be subtracted 
     * 
     * @return static
     */
    public function subMonthsNoOverflow($value)
    {
        return $this->addMonthsNoOverflow((-1 * $value));
    }//end subMonthsNoOverflow()

    /**
     * Add days to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value days to be added
     * 
     * @return static
     */
    public function addDays($value)
    {
        return $this->modify((int) $value.' day');
    }//end addDays()

    /**
     * Add a day to the instance
     * 
     * @param int $value days to be added default 1
     * 
     * @return static
     */
    public function addDay($value=1)
    {
        return $this->addDays($value);
    }//end addDay()

    /**
     * Remove a day from the instance
     * 
     * @param int $value days to be subtracted default 1
     * 
     * @return static
     */
    public function subDay($value=1)
    {
        return $this->subDays($value);
    }//end subDay()

    /**
     * Remove days from the instance
     * 
     * @param int $value days to be subtracted
     * 
     * @return static
     */
    public function subDays($value)
    {
        return $this->addDays(-1 * $value);
    }//end subDays()

    /**
     * Add weekdays to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value weekdays to be added
     * 
     * @return static
     */
    public function addWeekdays($value)
    {
        // Fix for weekday bug https://bugs.php.net/bug.php?id=54909 .
        $t = $this->toTimeString();
        $this->modify((int) $value.' weekday');

        return $this->setTimeFromTimeString($t);
    }//end addWeekdays()

    /**
     * Add a weekday to the instance
     * 
     * @param int $value weekdays to be added default 1
     * 
     * @return static
     */
    public function addWeekday($value=1)
    {
        return $this->addWeekdays($value);
    }//end addWeekday()

    /**
     * Remove a weekday from the instance
     * 
     * @param int $value weekdays to be subtracted default 1 
     * 
     * @return static
     */
    public function subWeekday($value=1)
    {
        return $this->subWeekdays($value);
    }//end subWeekday()

    /**
     * Remove weekdays from the instance
     *
     * @param int $value weekdays to be subtracted
     *
     * @return static
     */
    public function subWeekdays($value)
    {
        return $this->addWeekdays((-1 * $value));
    }//end subWeekdays()

    /**
     * Add weeks to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value weeks to be added
     * 
     * @return static
     */
    public function addWeeks($value)
    {
        return $this->modify((int) $value.' week');
    }//end addWeeks()

    /**
     * Add a week to the instance
     * 
     * @param int $value weeks to be added default 1
     * 
     * @return static
     */
    public function addWeek($value=1)
    {
        return $this->addWeeks($value);
    }//end addWeek()

    /**
     * Remove a week from the instance
     * 
     * @param int $value weeks to be subtracted default 1
     * 
     * @return static
     */
    public function subWeek($value=1)
    {
        return $this->subWeeks($value);
    }//end subWeek()

    /**
     * Remove weeks to the instance
     * 
     * @param int $value weeks to be subtracted
     * 
     * @return static
     */
    public function subWeeks($value)
    {
        return $this->addWeeks((-1 * $value));
    }//end subWeeks()

    /**
     * Add hours to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value hours to be added
     * 
     * @return static
     */
    public function addHours($value)
    {
        return $this->modify((int) $value.' hour');
    }//end addHours()

    /**
     * Add an hour to the instance
     * 
     * @param int $value hours to be added default 1
     * 
     * @return static
     */
    public function addHour($value=1)
    {
        return $this->addHours($value);
    }//end addHour()

    /**
     * Remove an hour from the instance
     * 
     * @param int $value hours to be subtracted default 1
     * 
     * @return static
     */
    public function subHour($value=1)
    {
        return $this->subHours($value);
    }//end subHour()

    /**
     * Remove hours from the instance
     * 
     * @param int $value hours to be subtracted
     * 
     * @return static
     */
    public function subHours($value)
    {
        return $this->addHours((-1 * $value));
    }//end subHours()

    /**
     * Add minutes to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value minutes to be added
     * 
     * @return static
     */
    public function addMinutes($value)
    {
        return $this->modify((int) $value.' minute');
    }//end addMinutes()

    /**
     * Add a minute to the instance
     * 
     * @param int $value minutes to be added default 1
     * 
     * @return static
     */
    public function addMinute($value=1)
    {
        return $this->addMinutes($value);
    }//end addMinute()

    /**
     * Remove a minute from the instance
     * 
     * @param int $value minutes to be subtracted default 1
     * 
     * @return static
     */
    public function subMinute($value=1)
    {
        return $this->subMinutes($value);
    }//end subMinute()

    /**
     * Remove minutes from the instance
     * 
     * @param int $value minutes to be subtracted
     * 
     * @return static
     */
    public function subMinutes($value)
    {
        return $this->addMinutes((-1 * $value));
    }//end subMinutes()

    /**
     * Add seconds to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     * 
     * @param int $value seconds to be added
     * 
     * @return static
     */
    public function addSeconds($value)
    {
        return $this->modify((int) $value.' second');
    }//end addSeconds()

    /**
     * Add a second to the instance
     * 
     * @param int $value seconds to be added default 1
     * 
     * @return static
     */
    public function addSecond($value=1)
    {
        return $this->addSeconds($value);
    }//end addSecond()

    /**
     * Remove a second from the instance
     * 
     * @param int $value seconds to be subtracted default 1
     * 
     * @return static
     */
    public function subSecond($value=1)
    {
        return $this->subSeconds($value);
    }//end subSecond()

    /**
     * Remove seconds from the instance
     * 
     * @param int $value seconds to be subtracted
     * 
     * @return static
     */
    public function subSeconds($value)
    {
        return $this->addSeconds((-1 * $value));
    }//end subSeconds()

    /**
     * ******************************************************************************
     * ************************ DIFFERENCES *****************************************
     * ******************************************************************************
     */

    /**
     * Get the difference in years
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInYears(Carbon $dt=null, $abs=true)
    {
        $dt = $dt ?: static::now($this->tz);

        return (int) $this->diff($dt, $abs)->format('%r%y');
    }//end diffInYears()

    /**
     * Get the difference in months
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInMonths(Carbon $dt=null, $abs=true)
    {
        $dt = $dt ?: static::now($this->tz);

        return (($this->diffInYears($dt, $abs) * static::MONTHS_PER_YEAR) + (int) $this->diff($dt, $abs)->format('%r%m'));
    }//end diffInMonths()

    /**
     * Get the difference in weeks
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInWeeks(Carbon $dt=null, $abs=true)
    {
        return (int) ($this->diffInDays($dt, $abs) / static::DAYS_PER_WEEK);
    }//end diffInWeeks()

    /**
     * Get the difference in days
     *  
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     *
     * @return int
     */
    public function diffInDays(Carbon $dt=null, $abs=true)
    {
        $dt = $dt ?: static::now($this->tz);

        return (int) $this->diff($dt, $abs)->format('%r%a');
    }//end diffInDays()

    /**
     * Get the difference in days using a filter closure
     * 
     * @param Closure             $callback closure with filter
     * @param \Carbon\Carbon|null $dt       datetime default null
     * @param bool                $abs      Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInDaysFiltered(Closure $callback, Carbon $dt=null, $abs=true)
    {
        return $this->diffFiltered(CarbonInterval::day(), $callback, $dt, $abs);
    }//end diffInDaysFiltered()

    /**
     * Get the difference in hours using a filter closure
     * 
     * @param Closure             $callback closure with filter
     * @param \Carbon\Carbon|null $dt       datetime default null 
     * @param bool                $abs      Get the absolute of the difference default true
     *
     * @return int
     */
    public function diffInHoursFiltered(Closure $callback, Carbon $dt=null, $abs=true)
    {
        return $this->diffFiltered(CarbonInterval::hour(), $callback, $dt, $abs);
    }//end diffInHoursFiltered()

    /**
     * Get the difference by the given interval using a filter closure
     * 
     * @param CarbonInterval $ci       An interval to traverse by
     * @param Closure        $callback $callback closure with filter
     * @param Carbon|null    $dt       datetime default null
     * @param bool           $abs      Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffFiltered(CarbonInterval $ci, Closure $callback, Carbon $dt=null, $abs=true)
    {
        $start = $this;
        $end = $dt ?: static::now($this->tz);
        $inverse = false;

        if ($end < $start) {
            $start = $end;
            $end = $this;
            $inverse = true;
        }

        $period = new DatePeriod($start, $ci, $end);
        $vals = array_filter(iterator_to_array($period), function (DateTime $date) use ($callback) {
            return call_user_func($callback, Carbon::instance($date));
        });

        $diff = count($vals);

        return $inverse && $abs === false ? -$diff : $diff;
    }//end diffFiltered()

    /**
     * Get the difference in weekdays
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInWeekdays(Carbon $dt=null, $abs=true)
    {
        return $this->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        }, $dt, $abs);
    }//end diffInWeekdays()

    /**
     * Get the difference in weekend days using a filter
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInWeekendDays(Carbon $dt=null, $abs=true)
    {
        return $this->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekend();
        }, $dt, $abs);
    }//end diffInWeekendDays()

    /**
     * Get the difference in hours
     * 
     * @param \Carbon\Carbon|null $dt  default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInHours(Carbon $dt=null, $abs=true)
    {
        return (int) ($this->diffInSeconds($dt, $abs) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }//end diffInHours()

    /**
     * Get the difference in minutes
     * 
     * @param \Carbon\Carbon|null $dt  default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInMinutes(Carbon $dt=null, $abs=true)
    {
        return (int) ($this->diffInSeconds($dt, $abs) / static::SECONDS_PER_MINUTE);
    }//end diffInMinutes()

    /**
     * Get the difference in seconds
     * 
     * @param \Carbon\Carbon|null $dt  datetime default null
     * @param bool                $abs Get the absolute of the difference default true
     * 
     * @return int
     */
    public function diffInSeconds(Carbon $dt=null, $abs=true)
    {
        $dt = $dt ?: static::now($this->tz);
        $value = $dt->getTimestamp() - $this->getTimestamp();

        return $abs ? abs($value) : $value;
    }//end diffInSeconds()

    /**
     * The number of seconds since midnight.
     * 
     * @return int
     */
    public function secondsSinceMidnight()
    {
        return $this->diffInSeconds($this->copy()->startOfDay());
    }//end secondsSinceMidnight()

    /**
     * The number of seconds until 23:23:59.
     * 
     * @return int
     */
    public function secondsUntilEndOfDay()
    {
        return $this->diffInSeconds($this->copy()->endOfDay());
    }//end secondsUntilEndOfDay()

    /**
     * Get the difference in a human readable format in the current locale.
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
     * @param Carbon|null $other    datetime defaul null
     * @param bool        $absolute removes time difference modifiers ago, after, etc default false
     * 
     * @return string
     */
    public function diffForHumans(Carbon $other=null, $absolute=false)
    {
        $isNow = $other === null;

        if ($isNow != null) {
            $other = static::now($this->tz);
        }

        $diffInterval = $this->diff($other);

        switch (true) {
            case ($diffInterval->y > 0):
                $unit = 'year';
                $count = $diffInterval->y;
                break;

            case ($diffInterval->m > 0):
                $unit = 'month';
                $count = $diffInterval->m;
                break;

            case ($diffInterval->d > 0):
                $unit = 'day';
                $count = $diffInterval->d;
                if ($count >= self::DAYS_PER_WEEK) {
                    $unit = 'week';
                    $count = (int) ($count / self::DAYS_PER_WEEK);
                }
                break;

            case ($diffInterval->h > 0):
                $unit = 'hour';
                $count = $diffInterval->h;
                break;

            case ($diffInterval->i > 0):
                $unit = 'minute';
                $count = $diffInterval->i;
                break;

            default:
                $count = $diffInterval->s;
                $unit = 'second';
                break;
        }//end switch

        if ($count === 0) {
            $count = 1;
        }

        $time = static::translator()->transChoice($unit, $count, array(':count' => $count));

        if ($absolute !== false) {
            return $time;
        }

        $isFuture = $diffInterval->invert === 1;

        $transId = $isNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        // Some langs have special pluralization for past and future tense.
        $tryKeyExists = $unit.'_'.$transId;
        if ($tryKeyExists !== static::translator()->transChoice($tryKeyExists, $count)) {
            $time = static::translator()->transChoice($tryKeyExists, $count, array(':count' => $count));
        }

        return static::translator()->trans($transId, array(':time' => $time));
    }//end diffForHumans()

    /**
     * ******************************************************************************
     * *************************** MODIFIERS ****************************************
     * ******************************************************************************
     */

    /**
     * Resets the time to 00:00:00 start of day
     * 
     * @return static
     */
    public function startOfDay()
    {
        return $this->setTime(0, 0, 0);
    }//end startOfDay()

    /**
     * Resets the time to 23:59:59 end of day
     * 
     * @return static
     */
    public function endOfDay()
    {
        return $this->setTime(23, 59, 59);
    }//end endOfDay()

    /**
     * Resets the date to the first day of the month and the time to 00:00:00
     * 
     * @return static
     */
    public function startOfMonth()
    {
        return $this->setDateTime($this->year, $this->month, 1, 0, 0, 0);
    }//end startOfMonth()

    /**
     * Resets the date to end of the month and time to 23:59:59
     * 
     * 
     * @return static
     */
    public function endOfMonth()
    {
        return $this->setDateTime($this->year, $this->month, $this->daysInMonth, 23, 59, 59);
    }//end endOfMonth()

    /**
     * Resets the date to the first day of the year and the time to 00:00:00
     * 
     * 
     * @return static
     */
    public function startOfYear()
    {
        return $this->setDateTime($this->year, 1, 1, 0, 0, 0);
    }//end startOfYear()

    /**
     * Resets the date to end of the year and time to 23:59:59
     * 
     * @return static
     */
    public function endOfYear()
    {
        return $this->setDateTime($this->year, 12, 31, 23, 59, 59);
    }//end endOfYear()

    /**
     * Resets the date to the first day of the decade and the time to 00:00:00
     * 
     * @return static
     */
    public function startOfDecade()
    {
        $year = ($this->year - $this->year % static::YEARS_PER_DECADE);

        return $this->setDateTime($year, 1, 1, 0, 0, 0);
    }//end startOfDecade()

    /**
     * Resets the date to end of the decade and time to 23:59:59
     * 
     * @return static
     */
    public function endOfDecade()
    {
        $year = ($this->year - $this->year % static::YEARS_PER_DECADE + static::YEARS_PER_DECADE - 1);

        return $this->setDateTime($year, 12, 31, 23, 59, 59);
    }//end endOfDecade()

    /**
     * Resets the date to the first day of the century and the time to 00:00:00
     * 
     * @return static
     */
    public function startOfCentury()
    {
        $year = ($this->year - 1 - ($this->year - 1) % static::YEARS_PER_CENTURY + 1);

        return $this->setDateTime($year, 1, 1, 0, 0, 0);
    }//end startOfCentury()

    /**
     * Resets the date to end of the century and time to 23:59:59
     * 
     * 
     * @return static
     */
    public function endOfCentury()
    {
        $year = ($this->year - 1 - ($this->year - 1) % static::YEARS_PER_CENTURY + static::YEARS_PER_CENTURY);

        return $this->setDateTime($year, 12, 31, 23, 59, 59);
    }//end endOfCentury()

    /**
     * Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00
     * 
     * @return static
     */
    public function startOfWeek()
    {
        if ($this->dayOfWeek !== static::$weekStartsAt) {
            $this->previous(static::$weekStartsAt);
        }

        return $this->startOfDay();
    }//end startOfWeek()

    /**
     * Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59
     * 
     * 
     * @return static
     */
    public function endOfWeek()
    {
        if ($this->dayOfWeek !== static::$weekEndsAt) {
            $this->next(static::$weekEndsAt);
        }

        return $this->endOfDay();
    }//end endOfWeek()

    /**
     * Modify to start of current hour, minutes and seconds become 0
     * 
     * @return Carbon
     */
    public function startOfHour()
    {
        return $this->setTime($this->hour, 0, 0);
    }//end startOfHour()

    /**
     * Modify to end of current hour, minutes and seconds become 59
     * 
     * @return Carbon
     */
    public function endOfHour()
    {
        return $this->setTime($this->hour, 59, 59);
    }//end endOfHour()

    /**
     * Modify to start of current minute, seconds become 0
     * 
     * @return Carbon
     */
    public function startOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, 0);
    }//end startOfMinute()

    /**
     * Modify to end of current minute, seconds become 59
     * 
     * @return Carbon
     */
    public function endOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, 59);
    }//end endOfMinute()

    /**
     * Modify to midday, default to self::$midDayAt
     * 
     * @return Carbon
     */
    public function midDay()
    {
        return $this->setTime(self::$midDayAt, 0, 0);
    }//end midDay()

    /**
     * Modify to the next occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the next occurrence
     * of the current day of the week.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of week defaul null
     * 
     * @return static
     */
    public function next($dayOfWeek=null)
    {
        if ($dayOfWeek === null) {
            $dayOfWeek = $this->dayOfWeek;
        }

        return $this->startOfDay()->modify('next '.static::$days[$dayOfWeek]);
    }//end next()

    /**
     * Modify to the previous occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the previous occurrence
     * of the current day of the week.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of week default null
     * 
     * @return static
     */
    public function previous($dayOfWeek=null)
    {
        if ($dayOfWeek === null) {
            $dayOfWeek = $this->dayOfWeek;
        }

        return $this->startOfDay()->modify('last '.static::$days[$dayOfWeek]);
    }//end previous()

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * first day of the current month.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of week default null
     * 
     * @return static
     */
    public function firstOfMonth($dayOfWeek=null)
    {
        $this->startOfDay();

        if ($dayOfWeek === null) {
            return $this->day(1);
        }

        return $this->modify('first '.static::$days[$dayOfWeek].' of '.$this->format('F').' '.$this->year);
    }//end firstOfMonth()

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * last day of the current month.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of week default null
     * 
     * @return static
     */
    public function lastOfMonth($dayOfWeek=null)
    {
        $this->startOfDay();

        if ($dayOfWeek === null) {
            return $this->day($this->daysInMonth);
        }

        return $this->modify('last '.static::$days[$dayOfWeek].' of '.$this->format('F').' '.$this->year);
    }//end lastOfMonth()

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current month. If the calculated occurrence is outside the scope
     * of the current month, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int $nth       occurrence of a day
     * @param int $dayOfWeek day of the week
     * 
     * @return mixed
     */
    public function nthOfMonth($nth, $dayOfWeek)
    {
        $dt = $this->copy()->firstOfMonth();
        $check = $dt->format('Y-m');
        $dt->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return $dt->format('Y-m') === $check ? $this->modify($dt) : false;
    }//end nthOfMonth()

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * first day of the current quarter.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of the week default null
     * 
     * @return static
     */
    public function firstOfQuarter($dayOfWeek=null)
    {
        return $this->setDate($this->year, $this->quarter * 3 - 2, 1)->firstOfMonth($dayOfWeek);
    }//end firstOfQuarter()

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * last day of the current quarter.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of the week default null
     * 
     * @return static
     */
    public function lastOfQuarter($dayOfWeek=null)
    {
        return $this->setDate($this->year, ($this->quarter * 3), 1)->lastOfMonth($dayOfWeek);
    }//end lastOfQuarter()

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current quarter. If the calculated occurrence is outside the scope
     * of the current quarter, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int $nth       occurrence of a given day of the week
     * @param int $dayOfWeek day of the week
     * 
     * @return mixed
     */
    public function nthOfQuarter($nth, $dayOfWeek)
    {
        $dt = $this->copy()->day(1)->month($this->quarter * 3);
        $lastMonth = $dt->month;
        $year = $dt->year;
        $dt->firstOfQuarter()->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return ($lastMonth < $dt->month || $year !== $dt->year) ? false : $this->modify($dt);
    }//end nthOfQuarter()

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * first day of the current year.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of the week default null
     * 
     * @return static
     */
    public function firstOfYear($dayOfWeek=null)
    {
        return $this->month(1)->firstOfMonth($dayOfWeek);
    }//end firstOfYear()

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * last day of the current year.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int|null $dayOfWeek day of the week default null
     * 
     * @return static
     */
    public function lastOfYear($dayOfWeek=null)
    {
        return $this->month(static::MONTHS_PER_YEAR)->lastOfMonth($dayOfWeek);
    }//end lastOfYear()

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current year. If the calculated occurrence is outside the scope
     * of the current year, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     * 
     * @param int $nth       occurrence of a given day of the week
     * @param int $dayOfWeek day of the week
     * 
     * @return mixed
     */
    public function nthOfYear($nth, $dayOfWeek)
    {
        $dt = $this->copy()->firstOfYear()->modify('+'.$nth.' '.static::$days[$dayOfWeek]);

        return $this->year === $dt->year ? $this->modify($dt) : false;
    }//end nthOfYear()

    /**
     * Modify the current instance to the average of a given instance (default now) and the current instance.
     * 
     * @param \Carbon\Carbon|null $dt datetime default null
     * 
     * @return static
     */
    public function average(Carbon $dt=null)
    {
        $dt = $dt ?: static::now($this->tz);

        return $this->addSeconds((int) ($this->diffInSeconds($dt, false) / 2));
    }//end average()

    /**
     * Check if its the birthday. Compares the date/month values of the two dates.
     * 
     * @param \Carbon\Carbon|null $dt The instance to compare with or null to use current day.
     * 
     * @return bool
     */
    public function isBirthday(Carbon $dt=null)
    {
        $dt = $dt ? : static::now($this->tz);

        return $this->format('md') === $dt->format('md');
    }//end isBirthday()

    /**
     * ******************************************************************************
     * ********************************* AGE ****************************************
     * ******************************************************************************
     */

    /**
     * Get year of birth for certian age. Subtract age from years 
     * 
     * @param int $age age in years
     * 
     * @static
     *
     * @return int year of birth
     */
    public static function getBirthYear($age)
    {
        return self::now()->subYears((int) $age)->year;
    }//end getBirthYear()

    /**
     * Get age in years,months,days,hours,minutes and seconds
     * 
     * @param string $dateOfBirth date of birth
     * 
     * @static
     *
     * @return array $ageArray
     */
    public static function getAge($dateOfBirth)
    {
        $ageArray = array();
        $age = self::now()->diff(self::parse($dateOfBirth));
        $ageArray['year'] = $age->y;
        $ageArray['month'] = $age->m;
        $ageArray['day'] = $age->d;
        $ageArray['hour'] = $age->h;
        $ageArray['minute'] = $age->i;
        $ageArray['second'] = $age->s;

        return $ageArray;
    }//end getAge()

    /**
     * Get age in years,months,days,hours,minutes and seconds human readable
     * 
     * @param string $dateOfBirth date of birth
     * 
     * @static
     *
     * @return string $ageString
     */
    public static function getAgeForHumans($dateOfBirth)
    {
        $ageItems = self::getAge($dateOfBirth);
        $ageString = '';
        foreach ($ageItems as $key => $ageItem) {
            $ageString .= static::translator()->transChoice($key, $ageItem, array(':count' => $ageItem)).',';
        }

        $ageString = trim($ageString, ',');

        return $ageString;
    }//end getAgeForHumans()

    /**
     * Get age in days 
     * 
     * @param string $dateOfBirth date of birth
     * 
     * @static
     *
     * @return int age in days
     */
    public static function getAgeInDays($dateOfBirth)
    {
        return self::now()->diffInDays(self::parse($dateOfBirth));
    }//end getAgeInDays()

    /**
     * Get age in hours 
     * 
     * @param string $dateOfBirth date of birth
     * 
     * @static
     *
     * @return int age in hours
     */
    public static function getAgeInHours($dateOfBirth)
    {
        return self::now()->diffInHours(self::parse($dateOfBirth));
    }//end getAgeInHours()

    /**
     * Get age in minutes
     * 
     * @param string $dateOfBirth date of birth
     * 
     * @static
     *
     * @return int age in minutes
     */
    public static function getAgeInMinutes($dateOfBirth)
    {
        return self::now()->diffInMinutes(self::parse($dateOfBirth));
    }//end getAgeInMinutes()
}//end class;
