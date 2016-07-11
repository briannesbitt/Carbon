<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonExtensions\Fixtures;

use Carbon\Carbon;
use Carbon\HolidaySchedule;

/**
 * Class FederalHolidays
 *
 * @property-read int $year;
 * @property int $observedHolidays;
 * @property-read Carbon $newYearsDay;
 * @property-read Carbon $martinLutherKingsBirthday;
 * @property-read Carbon $washingtonsBirthday;
 * @property-read Carbon $memorialDay;
 * @property-read Carbon $independenceDay;
 * @property-read Carbon $laborDay;
 * @property-read Carbon $columbusDay;
 * @property-read Carbon $veteransDay;
 * @property-read Carbon $thanksgivingDay;
 * @property-read Carbon $christmasDay;
 */
class FederalHolidays implements HolidaySchedule
{
    const NEW_YEARS_DAY = 0x0001;
    const MARTIN_LUTHER_KINGS_BIRTHDAY = 0x0002;
    const WASHINGTONS_BIRTHDAY = 0x0004;
    const MEMORIAL_DAY = 0x0008;
    const INDEPENDENCE_DAY = 0x0010;
    const LABOR_DAY = 0x0020;
    const COLUMBUS_DAY = 0x0040;
    const VETERANS_DAY = 0x0080;
    const THANKSGIVING_DAY = 0x0100;
    const CHRISTMAS_DAY = 0x0200;
    const ALL_HOLIDAYS = 0x03ff;

    public $year;

    public $observedHolidays;

    public $newYearsDay;

    public $martinLutherKingsBirthday;

    public $washingtonsBirthday;

    public $memorialDay;

    public $independenceDay;

    public $laborDay;

    public $columbusDay;

    public $veteransDay;

    public $thanksgivingDay;

    public $christmasDay;

    /**
     * FederalHolidays constructor.
     *
     * @param int $year
     * @param int $observedHolidays
     */
    public function __construct($year, $observedHolidays = self::ALL_HOLIDAYS)
    {
        $this->year = $year;
        $this->observedHolidays = $observedHolidays;

        $this->newYearsDay = $this->getNewYearsDay();
        $this->martinLutherKingsBirthday = $this->getMartinLutherKingsBirthday();
        $this->washingtonsBirthday = $this->getWashingtonsBirthday();
        $this->memorialDay = $this->getMemorialDay();
        $this->independenceDay = $this->getIndependenceDay();
        $this->laborDay = $this->getLaborDay();
        $this->columbusDay = $this->getColumbusDay();
        $this->veteransDay = $this->getVeteransDay();
        $this->thanksgivingDay = $this->getThanksgivingDay();
        $this->christmasDay = $this->getChristmasDay();
    }

    /**
     * @param Carbon $date
     *
     * @returns bool
     */
    public function isHoliday(Carbon $date)
    {
        // created a copy of the datetime object to we can remove the time values without affecting
        // the passed in instance

        return ($this->newYearsDay->isSameDay($date) && $this->isObserved(self::NEW_YEARS_DAY))
            || ($this->martinLutherKingsBirthday->isSameDay($date) && $this->isObserved(self::MARTIN_LUTHER_KINGS_BIRTHDAY))
            || ($this->washingtonsBirthday->isSameDay($date) && $this->isObserved(self::WASHINGTONS_BIRTHDAY))
            || ($this->memorialDay->isSameDay($date) && $this->isObserved(self::MEMORIAL_DAY))
            || ($this->independenceDay->isSameDay($date) && $this->isObserved(self::INDEPENDENCE_DAY))
            || ($this->laborDay->isSameDay($date) && $this->isObserved(self::LABOR_DAY))
            || ($this->columbusDay->isSameDay($date) && $this->isObserved(self::COLUMBUS_DAY))
            || ($this->veteransDay->isSameDay($date) && $this->isObserved(self::VETERANS_DAY))
            || ($this->thanksgivingDay->isSameDay($date) && $this->isObserved(self::THANKSGIVING_DAY))
            || ($this->christmasDay->isSameDay($date) && $this->isObserved(self::CHRISTMAS_DAY))
            ;
    }

    /**
     * @param $holiday
     *
     * @return bool
     */
    public function isObserved($holiday)
    {
        return ($holiday & $this->observedHolidays) == $holiday;
    }

    /**
     * @return Carbon
     */
    protected function getNewYearsDay()
    {
        return Carbon::create($this->year, 1, 1, 0, 0, 0);
    }

    /**
     * @return Carbon
     */
    protected function getMartinLutherKingsBirthday()
    {
        return Carbon::create($this->year, 1, 1, 0, 0, 0)->nthOfMonth(3, Carbon::MONDAY);
    }

    /**
     * @return Carbon
     */
    protected function getWashingtonsBirthday()
    {
        return Carbon::create($this->year, 2, 1, 0, 0, 0)->nthOfMonth(3, Carbon::MONDAY);
    }

    /**
     * @return Carbon
     */
    protected function getMemorialDay()
    {
        return Carbon::create($this->year, 5, 1, 0, 0, 0) ->lastOfMonth(Carbon::MONDAY);
    }

    /**
     * @return Carbon
     */
    protected function getIndependenceDay()
    {
        return Carbon::create($this->year, 7, 4, 0, 0, 0);
    }

    /**
     * @return Carbon
     */
    protected function getLaborDay()
    {
        return Carbon::create($this->year, 9, 1, 0, 0, 0)->firstOfMonth(Carbon::MONDAY);
    }

    /**
     * @return Carbon
     */
    protected function getColumbusDay()
    {
        return Carbon::create($this->year, 10, 1, 0, 0, 0)->nthOfMonth(2, Carbon::MONDAY);
    }

    /**
     * @return Carbon
     */
    protected function getVeteransDay()
    {
        return Carbon::create($this->year, 11, 11, 0, 0, 0);
    }

    /**
     * @return Carbon
     */
    protected function getThanksgivingDay()
    {
        return Carbon::create($this->year, 11, 1, 0, 0, 0)->nthOfMonth(4, Carbon::THURSDAY);
    }

    /**
     * @return Carbon
     */
    protected function getChristmasDay()
    {
        return Carbon::create($this->year, 12, 25, 0, 0, 0);
    }
}
