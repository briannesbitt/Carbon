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

/**
 * @author Brian Nesbitt <brian@nesbot.com>
 * @author Ignace Knops <developer.ignace@gmail.com>
 *
 * @property int $year
 * @property int $month
 * @property int $day
 * @property int $hour
 * @property int $minute
 * @property int $second
 * @property int $dayOfWeek
 * @property int $dayOfYear
 * @property int $weekOfYear
 * @property int $daysInMonth
 * @property int $timestamp
 * @property int $age
 * @property int $quarter
 * @property int $offset
 * @property float $offsetHours
 * @property bool $dst
 * @property string $timezone
 * @property string $timezoneName
 * @property string $tz
 * @property string $tzName
 */
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

    /**
     * @param string|\DateTimeZone $object
     * @return \DateTimeZone
     * @throws \InvalidArgumentException
     */
    protected static function safeCreateDateTimeZone($object)
    {
        if ($object instanceof \DateTimeZone) {
            return $object;
        }

        $tz = @timezone_open((string)$object);

        if ($tz === false) {
            throw new \InvalidArgumentException('Unknown or bad timezone (' . $object . ')');
        }

        return $tz;
    }

    /**
     * @param string|null $time
     * @param string|null $tz
     */
    public function __construct($time = null, $tz = null)
    {
        if ($tz !== null) {
            parent::__construct($time, self::safeCreateDateTimeZone($tz));
        } else {
            parent::__construct($time);
        }
    }

    /**
     * @param \DateTime $dt
     * @return Carbon
     */
    public static function instance(\DateTime $dt)
    {
        return new self($dt->format('Y-m-d H:i:s'), $dt->getTimeZone());
    }

    /**
     * @param string|null $tz
     * @return Carbon
     */
    public static function now($tz = null)
    {
        return new self(null, $tz);
    }

    /**
     * @param string|null $tz
     * @return Carbon
     */
    public static function today($tz = null)
    {
        return Carbon::now($tz)->startOfDay();
    }

    /**
     * @param string|null $tz
     * @return Carbon
     */
    public static function tomorrow($tz = null)
    {
        return Carbon::today($tz)->addDay();
    }

    /**
     * @param string|null $tz
     * @return Carbon
     */
    public static function yesterday($tz = null)
    {
        return Carbon::today($tz)->subDay();
    }

    /**
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param string|null $tz
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
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @param int|null $tz
     * @return Carbon
     */
    public static function createFromDate($year = null, $month = null, $day = null, $tz = null)
    {
        return self::create($year, $month, $day, null, null, null, $tz);
    }

    /**
     * @param int|null $hour
     * @param int|null $minute
     * @param int|null $second
     * @param int|null $tz
     * @return Carbon
     */
    public static function createFromTime($hour = null, $minute = null, $second = null, $tz = null)
    {
        return self::create(null, null, null, $hour, $minute, $second, $tz);
    }

    /**
     * @param string $format
     * @param string $time
     * @param string|\DateTimeZone|null $object
     * @return Carbon
     * @throws \InvalidArgumentException
     */
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

    /**
     * @param int $timestamp
     * @param string|null $tz
     * @return Carbon
     */
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        return self::now($tz)->setTimestamp($timestamp);
    }

    /**
     * @param $timestamp
     * @return Carbon
     */
    public static function createFromTimestampUTC($timestamp)
    {
        return new self('@' . $timestamp);
    }

    /**
     * @return Carbon
     */
    public function copy()
    {
        return self::instance($this);
    }

    /**
     * @param string $name
     * @return bool|\DateTimeZone|float|int|string
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if ($name == 'year') {
            return intval($this->format('Y'));
        }
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

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        try {
            $this->__get($name);
        } catch (\InvalidArgumentException $e) {
            return false;
        }
        return true;
    }

    /**
     * @param string $name
     * @param int|string $value
     * @throws \InvalidArgumentException
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
                throw new \InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function year($value)
    {
        $this->year = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function month($value)
    {
        $this->month = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function day($value)
    {
        $this->day = $value;

        return $this;
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @return Carbon
     */
    public function setDate($year, $month, $day)
    {
        return $this->year($year)->month($month)->day($day);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function hour($value)
    {
        $this->hour = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function minute($value)
    {
        $this->minute = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function second($value)
    {
        $this->second = $value;

        return $this;
    }

    /**
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @return Carbon
     */
    public function setTime($hour, $minute, $second = 0)
    {
        return $this->hour($hour)->minute($minute)->second($second);
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @return Carbon
     */
    public function setDateTime($year, $month, $day, $hour, $minute, $second)
    {
        return $this->setDate($year, $month, $day)->setTime($hour, $minute, $second);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function timestamp($value)
    {
        $this->timestamp = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return Carbon
     */
    public function timezone($value)
    {
        return $this->setTimezone($value);
    }

    /**
     * @param string $value
     * @return Carbon
     */
    public function tz($value)
    {
        return $this->setTimezone($value);
    }

    /**
     * @param string|\DateTimeZone $value
     * @return Carbon
     */
    public function setTimezone($value)
    {
        parent::setTimezone(self::safeCreateDateTimeZone($value));

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toDateTimeString();
    }

    /**
     * @return string
     */
    public function toDateString()
    {
        return $this->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function toFormattedDateString()
    {
        return $this->format('M j, Y');
    }

    /**
     * @return string
     */
    public function toTimeString()
    {
        return $this->format('H:i:s');
    }

    /**
     * @return string
     */
    public function toDateTimeString()
    {
        return $this->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function toDayDateTimeString()
    {
        return $this->format('D, M j, Y g:i A');
    }

    /**
     * @return string
     */
    public function toATOMString()
    {
        return $this->format(\DateTime::ATOM);
    }

    /**
     * @return string
     */
    public function toCOOKIEString()
    {
        return $this->format(\DateTime::COOKIE);
    }

    /**
     * @return string
     */
    public function toISO8601String()
    {
        return $this->format(\DateTime::ISO8601);
    }

    /**
     * @return string
     */
    public function toRFC822String()
    {
        return $this->format(\DateTime::RFC822);
    }

    /**
     * @return string
     */
    public function toRFC850String()
    {
        return $this->format(\DateTime::RFC850);
    }

    /**
     * @return string
     */
    public function toRFC1036String()
    {
        return $this->format(\DateTime::RFC1036);
    }

    /**
     * @return string
     */
    public function toRFC1123String()
    {
        return $this->format(\DateTime::RFC1123);
    }

    /**
     * @return string
     */
    public function toRFC2822String()
    {
        return $this->format(\DateTime::RFC2822);
    }

    /**
     * @return string
     */
    public function toRFC3339String()
    {
        return $this->format(\DateTime::RFC3339);
    }

    /**
     * @return string
     */
    public function toRSSString()
    {
        return $this->format(\DateTime::RSS);
    }

    /**
     * @return string
     */
    public function toW3CString()
    {
        return $this->format(\DateTime::W3C);
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function eq(Carbon $dt)
    {
        return $this == $dt;
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function ne(Carbon $dt)
    {
        return !$this->eq($dt);
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function gt(Carbon $dt)
    {
        return $this > $dt;
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function gte(Carbon $dt)
    {
        return $this >= $dt;
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function lt(Carbon $dt)
    {
        return $this < $dt;
    }

    /**
     * @param Carbon $dt
     * @return bool
     */
    public function lte(Carbon $dt)
    {
        return $this <= $dt;
    }

    /**
     * @return bool
     */
    public function isWeekday()
    {
        return ($this->dayOfWeek != self::SUNDAY && $this->dayOfWeek != self::SATURDAY);
    }

    /**
     * @return bool
     */
    public function isWeekend()
    {
        return !$this->isWeekDay();
    }

    /**
     * @return bool
     */
    public function isYesterday()
    {
        return $this->toDateString() === self::now($this->tz)->subDay()->toDateString();
    }

    /**
     * @return bool
     */
    public function isToday()
    {
        return $this->toDateString() === self::now($this->tz)->toDateString();
    }

    /**
     * @return bool
     */
    public function isTomorrow()
    {
        return $this->toDateString() === self::now($this->tz)->addDay()->toDateString();
    }

    /**
     * @return bool
     */
    public function isFuture()
    {
        return $this->gt(self::now($this->tz));
    }

    /**
     * @return bool
     */
    public function isPast()
    {
        return !$this->isFuture();
    }

    /**
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->format('L') == '1';
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addYear()
    {
        return $this->addYears(1);
    }

    /**
     * @return Carbon
     */
    public function subYear()
    {
        return $this->addYears(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subYears($value)
    {
        return $this->addYears(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addMonth()
    {
        return $this->addMonths(1);
    }

    /**
     * @return Carbon
     */
    public function subMonth()
    {
        return $this->addMonths(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subMonths($value)
    {
        return $this->addMonths(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addDay()
    {
        return $this->addDays(1);
    }

    /**
     * @return Carbon
     */
    public function subDay()
    {
        return $this->addDays(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subDays($value)
    {
        return $this->addDays(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addWeekday()
    {
        return $this->addWeekdays(1);
    }

    /**
     * @return Carbon
     */
    public function subWeekday()
    {
        return $this->addWeekdays(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subWeekdays($value)
    {
        return $this->addWeekdays(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addWeek()
    {
        return $this->addWeeks(1);
    }

    /**
     * @return Carbon
     */
    public function subWeek()
    {
        return $this->addWeeks(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subWeeks($value)
    {
        return $this->addWeeks(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addHour()
    {
        return $this->addHours(1);
    }

    /**
     * @return Carbon
     */
    public function subHour()
    {
        return $this->addHours(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subHours($value)
    {
        return $this->addHours(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addMinute()
    {
        return $this->addMinutes(1);
    }

    /**
     * @return Carbon
     */
    public function subMinute()
    {
        return $this->addMinutes(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subMinutes($value)
    {
        return $this->addMinutes(-1 * $value);
    }

    /**
     * @param int $value
     * @return Carbon
     */
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

    /**
     * @return Carbon
     */
    public function addSecond()
    {
        return $this->addSeconds(1);
    }

    /**
     * @return Carbon
     */
    public function subSecond()
    {
        return $this->addSeconds(-1);
    }

    /**
     * @param int $value
     * @return Carbon
     */
    public function subSeconds($value)
    {
        return $this->addSeconds(-1 * $value);
    }

    /**
     * @return Carbon
     */
    public function startOfDay()
    {
        return $this->hour(0)->minute(0)->second(0);
    }

    /**
     * @return Carbon
     */
    public function endOfDay()
    {
        return $this->hour(23)->minute(59)->second(59);
    }

    /**
     * @return Carbon
     */
    public function startOfMonth()
    {
        return $this->startOfDay()->day(1);
    }

    /**
     * @return Carbon
     */
    public function endOfMonth()
    {
        return $this->day($this->daysInMonth)->endOfDay();
    }

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return int
     */
    public function diffInYears(Carbon $dt = null, $abs = true)
    {
        $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
        $sign = ($abs) ? '' : '%r';

        return intval($this->diff($dt)->format($sign . '%y'));
    }

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return mixed
     */
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

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return int
     */
    public function diffInDays(Carbon $dt = null, $abs = true)
    {
        $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;
        $sign = ($abs) ? '' : '%r';

        return intval($this->diff($dt)->format($sign . '%a'));
    }

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return int
     */
    public function diffInHours(Carbon $dt = null, $abs = true)
    {
        $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;

        return intval($this->diffInMinutes($dt, $abs) / self::MINUTES_PER_HOUR);
    }

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return int
     */
    public function diffInMinutes(Carbon $dt = null, $abs = true)
    {
        $dt = ($dt === null) ? Carbon::now($this->tz) : $dt;

        return intval($this->diffInSeconds($dt, $abs) / self::SECONDS_PER_MINUTE);
    }

    /**
     * @param Carbon $dt
     * @param bool $abs
     * @return int
     */
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
