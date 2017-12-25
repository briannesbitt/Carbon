<?php
/**
 * User: denys
 * Date: 25.12.17
 * Time: 14:23
 */

namespace Carbon;


use Carbon\Exceptions\UnknownIntervalException;

class CarbonRange
{
    private $begin;
    private $end;

    public function __construct(Carbon $begin, Carbon $end)
    {
        $this->begin = $begin;
        $this->end = $end;
    }

    /**
     * @return Carbon
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param Carbon $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return Carbon
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * @param Carbon $begin
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    }

    /**
     * Return count of working days at interval.
     * @param array $weekendDays Weekend days.
     * @return int Count of working days.
     * @throws \Exception
     */
    public function getWorkingDays($weekendDays = array(Carbon::SATURDAY, Carbon::SUNDAY))
    {
        $interval = $this->getIntervalAtDays();

        $begin = clone $this->getBegin();

        $count = 0;
        for ($i = 0; $i < $interval; $i++) {

            if (!in_array($begin->dayOfWeek, $weekendDays)) {
                $count++;
            }

            $begin->addDay();
        }

        return $count;
    }

    public function getWeekendDays($weekendDays = [Carbon::SUNDAY, Carbon::SATURDAY])
    {
        $weekendDays = is_array($weekendDays) ? $weekendDays : array($weekendDays);

        $intervalAtDays = $this->getIntervalAtDays();
        return $intervalAtDays - $this->getWorkingDays($weekendDays);
    }

    /**
     * Return days count between start and end date.
     * @return mixed
     */
    private function getIntervalAtDays()
    {
        //Adding 1 days forward to include end date to calculation otherwise only begin date will be included.
        //Must be cloned because stored at class start and end date aren't immutable.
        $end = clone $this->getEnd();
        return $end->addDay()->diff($this->getBegin())->days;
    }
}
