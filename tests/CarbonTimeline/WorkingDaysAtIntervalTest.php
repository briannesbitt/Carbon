<?php

/**
 * User: Denys Bushulyak <denys_bushulyak@icloud.com>
 * Date: 25.12.17
 * Time: 13:37
 */

namespace Tests\CarbonInterval;


use Carbon\Carbon;
use Carbon\CarbonRange;

/**
 * Class WorkingDaysAtIntervalTest
 * @package Tests\CarbonInterval
 */
class WorkingDaysAtIntervalTest extends \PHPUnit_Framework_TestCase
{
    public function getWorkingDaysTestRange()
    {
        return [
            [
                //Taking from 1 to 31 december of 2017. It has 5 Saturdays and 5 Sundays and 21 working days.
                Carbon::create(2017, 12, 1),
                Carbon::create(2017, 12, 31),
                21 //Expected working days
            ],
            [
                //Taking form 4 to 13 december of 2017. It has 1 Saturday and 1 Sunday and 8 working days.
                Carbon::create(2017, 12, 4),
                Carbon::create(2017, 12, 13),
                8 //Expected working days
            ]
        ];
    }

    public function getWeekendDaysTestRange()
    {
        return [
            [
                //Taking from 1 to 31 december of 2017. It has 5 Saturdays and 5 Sundays and 21 working days.
                Carbon::create(2017, 12, 1),
                Carbon::create(2017, 12, 31),
                10 //Expected working days
            ],
            [
                //Taking form 4 to 13 december of 2017. It has 1 Saturday and 1 Sunday and 8 working days.
                Carbon::create(2017, 12, 4),
                Carbon::create(2017, 12, 13),
                2 //Expected working days
            ],
            [
                Carbon::create(2017, 12, 18),
                Carbon::create(2017, 12, 31),
                4
            ]
        ];
    }

    /**
     * @dataProvider getWorkingDaysTestRange
     * @param Carbon $beginOfRange
     * @param Carbon $endOfRange
     * @param $expected
     * @throws \Exception
     */
    public function testWorkingDays(Carbon $beginOfRange, Carbon $endOfRange, $expected)
    {
        /** @var CarbonRange $range */
        $range = new CarbonRange($beginOfRange, $endOfRange);
        $this->assertEquals($expected, $range->getWorkingDays());
    }

    /**
     * @dataProvider getWeekendDaysTestRange
     * @param Carbon $beginOfRange
     * @param Carbon $endOfRange
     * @param $expected
     */
    public function testWeekendDays(Carbon $beginOfRange, Carbon $endOfRange, $expected)
    {
        /** @var CarbonRange $range */
        $range = new CarbonRange($beginOfRange, $endOfRange);
        $this->assertEquals($expected, $range->getWeekendDays());
    }

    public function getDataForTestWeekendDaysOnlySunday()
    {
        return [
            [
                Carbon::create(2017, 12, 6),
                Carbon::create(2017, 12, 10),
                1
            ],
            [
                Carbon::create(2017, 12, 11),
                Carbon::create(2017, 12, 15),
                0
            ],
            [
                Carbon::create(2017, 12, 3),
                Carbon::create(2017, 12, 30),
                4
            ],
        ];
    }

    /**
     * @dataProvider getDataForTestWeekendDaysOnlySunday
     * @param $begin
     * @param $end
     * @param $expected
     */
    public function testWeekendDaysOnlySunday($begin, $end, $expected)
    {
        $range = new CarbonRange($begin, $end);
        $this->assertEquals($expected, $range->getWeekendDays([Carbon::SUNDAY]));
        $this->assertEquals($expected, $range->getWeekendDays(Carbon::SUNDAY));
    }

    public function getDataForTestWeekendDaysOnlySaturday()
    {
        return [
            [
                Carbon::create(2017, 12, 6),
                Carbon::create(2017, 12, 10),
                1
            ],
            [
                Carbon::create(2017, 12, 11),
                Carbon::create(2017, 12, 15),
                0
            ],
            [
                Carbon::create(2017, 12, 3),
                Carbon::create(2017, 12, 30),
                4
            ],
            [
                Carbon::create(2017, 12, 18),
                Carbon::create(2017, 12, 31),
                2
            ],
        ];
    }

    /**
     * @dataProvider getDataForTestWeekendDaysOnlySaturday
     * @param $begin
     * @param $end
     * @param $expected
     */
    public function testWeekendDaysOnlySaturday($begin, $end, $expected)
    {
        $this->assertEquals($expected, (new CarbonRange($begin, $end))->getWeekendDays(Carbon::SATURDAY));
    }
}
