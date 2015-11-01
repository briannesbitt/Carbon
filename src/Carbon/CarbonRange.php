<?php namespace Carbon;

/**
 * An object for interacting with a date range.
 *
 * @package Carbon
 * @author Marcus T <marcust261@icloud.com>
 */
class CarbonRange
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Carbon
     */
    protected $after;

    /**
     * @var Carbon
     */
    protected $before;

    /**
     * @var string A time period
     */
    const DAY = 'Day';

    /**
     * @var string A time period
     */
    const WEEK = 'Week';

    /**
     * @var string A time period
     */
    const MONTH = 'Month';

    /**
     * @var string A time period
     */
    const YEAR = 'Year';

    /**
     * @var array An array of accepted time periods
     */
    protected $accepted_timeperiods = [self::DAY => '', self::WEEK => '', self::MONTH => '', self::YEAR => ''];

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @var Carbon
     */
    protected $carbon_instance;

    /**
     * Constructor
     *
     * @param Carbon $after
     * @param Carbon $before
     * @param null $name
     * @param null $timezone
     * @throws \Exception
     */
    public function __construct(Carbon $after, Carbon $before, $name = null, $timezone = null)
    {
        $this->name = $name;

        if ($after->gte($before))
        {
            throw new \Exception('Invalid Date Range: $after must be less then $before');
        }

        $this->after = $after;

        $this->before = $before;

        $this->timezone = $timezone;
    }

    /**
     * Creates a date range between two dates, inclusive of the dates specified.
     *
     * @param Carbon $from
     * @param Carbon $to
     * @return static
     */
    public static function between(Carbon $from, Carbon $to)
    {
        return new static($from->subSecond(), $to->addSecond());
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Gets the name for a date range (if set).
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the after date of a date range.
     * @return Carbon
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * Gets the before date of a date range.
     * @return Carbon
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * Gets a human readable format for a date range.
     */
    public function forHumans()
    {
        // Check if time period is a DAY
        $day = $this->spans(self::DAY);
        if ( ! is_null($day))
        {
            if ($day->copy()->startOfDay()->eq(Carbon::now($this->timezone)->startOfDay()))
            {
                // If date is in current week
                return 'Today';
            }
            elseif ($day->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->startOfWeek()))
            {
                // If date is in current week
                return $day->format('l');
            }
            elseif ($day->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->subWeek()->startOfWeek()))
            {
                // If date is in the week previous
                return 'Last ' . $day->format('l');
            }
            elseif ($day->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->addWeek()->startOfWeek()))
            {
                // If date is in the next week
                return 'Next ' . $day->format('l');
            }
            elseif($day->copy()->startOfMonth()->eq(Carbon::now($this->timezone)->startOfMonth()))
            {
                // If date is in the current month
                return $day->format('l jS');
            }
            elseif($day->copy()->startOfYear()->eq(Carbon::now($this->timezone)->startOfYear()))
            {
                // If date is in the current year
                return $day->format('l jS \\of F');
            }
            else
            {
                return $day->format('l jS \\of F Y');
            }
        }

        // Check if time period is a WEEK
        $week = $this->spans(self::WEEK);
        if (!is_null($week))
        {
            if ($week->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->startOfWeek()))
            {
                // If date is in current week
                return 'This Week';
            }
            elseif ($week->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->subWeek()->startOfWeek()))
            {
                // If date is in the week previous
                return 'Last Week';
            }
            elseif ($week->copy()->startOfWeek()->eq(Carbon::now($this->timezone)->addWeek()->startOfWeek()))
            {
                // If date is in the next week
                return 'Next Week';
            }
            elseif($week->copy()->startOfYear()->eq(Carbon::now($this->timezone)->startOfYear()))
            {
                // If date is in the current year
                return 'Week Starting ' . $week->format('jS F');
            }
            else
            {
                return 'Week Starting ' . $week->format('jS F Y');
            }
        }

        // Check if time period is a single month
        $month = $this->spans(self::MONTH);
        if ( ! is_null($month))
        {
            if ($month->copy()->year == Carbon::now($this->timezone)->year)
            {
                // If date is in the current year
                return $month->format('F');
            }
            else
            {
                return $month->format('F Y');
            }
        }

        // Check if time period is a single year
        $year = $this->spans(self::YEAR);
        if (!is_null($year))
        {
            if ($year->copy()->year == Carbon::now($this->timezone)->year)
            {
                // If span is the current year
                return 'This Year';
            }
            else
            {
                return $year->format('Y');
            }
        }

        return $this->toString();
    }

    /**
     * Determines if a date range spans exactly one entire time period.
     *
     * For example, if a date range is after Monday at 23:59:59 and before Wednesday 00:00:00
     * then it will encompass an entire day and thus will have a time period of a single day. This
     * distinction is useful when attempting to simplify how a date is displayed in a human
     * readable format.
     *
     * Supported time periods include:
     *      - day
     *      - month
     *      - year
     *
     * @return Carbon|null The beginning of the time period, or null if the date range does not
     * match any supported time periods.
     */
    public function spans($time_period)
    {
        if (!array_key_exists($time_period, $this->accepted_timeperiods))
        {
            throw new \InvalidArgumentException('Time period must be one of the time periods listed in the class constants');
        }

        $start_of_period_func = 'startOf' . $time_period;
        $end_of_period_func = 'endOf' . $time_period;

        // After must be positioned at the end of the time period
        if (!$this->after->copy()->$end_of_period_func()->eq($this->after))
        {
            return null;
        }

        // Before must be positioned at the start of the time period
        if (!$this->before->copy()->$start_of_period_func()->eq($this->before))
        {
            return null;
        }

        // $after add a second should equal the beginning of the time period for $before sub one second.
        if ($this->before->copy()->subSecond()->$start_of_period_func()->eq($this->after->copy()->addSecond()))
        {
            return $this->after->copy()->addSecond();
        }
        else
        {
            return null;
        }
    }

    /**
     * Determines if a date range has an upper bound.
     * @return bool
     */
    public function isOpenEnded()
    {
        return is_null($this->before);
    }

    /**
     * Determines if a date range has a lower bound.
     * @return bool
     */
    public function isOpenStarted()
    {
        return is_null($this->after);
    }

    /**
     * Outputs a string format of a date range.
     * @return string
     */
    public function toString()
    {
        if ($this->isOpenEnded())
        {
            // Check if time period is open ended
            return 'After ' . $this->after->format('l jS \\of F Y');
        }
        elseif ($this->isOpenStarted())
        {
            // Check if time period is open started
            return 'Before ' . $this->before->format('l jS \\of F Y');
        }
        else
        {
            // Return full date range
            return $this->after->format('l jS \\of F Y') . ' to ' . $this->before->format('l jS \\of F Y');
        }
    }
}