<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

/**
 * 
 *
 * @link https://bugs.php.net/bug.php?id=74274 This bug on bugs.php.net
 */
class PhpBug74274Test extends AbstractTestCase
{
    protected $dateFormat = 'c';
    protected $timezoneString = 'America/New_York';
    
    // When local daylight time was about to reach
    // 2010-11-07T02:00:00-04:00 clocks were turned backward 1 hour to
    // 2010-11-07T01:00:00-05:00 local standard time instead
    protected $backwardTransitionTimestamp = 1289109600;
    
    // When standard time was about to reach
    // 2010-03-14T02:00:00-05:00 clocks were turned forward 1 hour to
    // 2010-03-14T03:00:00-04:00 local daylight time instead
    protected $forwardTransitionTimestamp = 1268550000;

    protected function setUp()
    {
        parent::setUp();

        date_default_timezone_set($this->timezoneString);
    }

    /**
     * @dataProvider getCreateFromTimestampTests
     */
    public function testTimestampNotChanged($timestamp) {
        $date = Carbon::createFromTimestamp($timestamp);

        $this->assertEquals($timestamp, $date->getTimestamp());
    }

    /**
     * @dataProvider getCreateFromTimestampTests
     */
    public function testCreateFromTimestamp($timestamp, $expectedDateString) {
        $date = Carbon::createFromTimestamp($timestamp);

        $this->assertEquals($expectedDateString, $date->format($this->dateFormat));
    }

    public function getCreateFromTimestampTests() {
        
        $btTimestamp = $this->backwardTransitionTimestamp;
        
        
        $ftTimestamp = $this->forwardTransitionTimestamp;
        
        // I am testing the hour of transition and hours around it.
        $tests = [
            [$btTimestamp - 7200, '2010-11-07T00:00:00-04:00'],
            [$btTimestamp - 3600, '2010-11-07T01:00:00-04:00'],
            [$btTimestamp, '2010-11-07T01:00:00-05:00'],
            [$btTimestamp + 3600, '2010-11-07T02:00:00-05:00'],
            [$ftTimestamp - 3600, '2010-03-14T01:00:00-05:00'],
            [$ftTimestamp, '2010-03-14T03:00:00-04:00'],
            [$ftTimestamp + 3600, '2010-03-14T04:00:00-04:00'],
        ];

        return $tests;
    }

    /**
     * @dataProvider getModifyTests
     */
    public function testAddHours($dateStr, $hours, $expectedDateStr) {
        $date = Carbon::parse($dateStr);
        $date->addHours($hours);

        $this->assertEquals($expectedDateStr, $date->format($this->dateFormat));
    }

    /**
     * @dataProvider getModifyTests
     */
    public function testAddHoursReversable($dateStr, $hours) {
        $date = Carbon::parse($dateStr);
        $dateExpected = $date->copy();
        $date->addHours($hours);
        $date->subHours($hours);

        $this->assertEquals($dateExpected, $date);
    }

    public function getModifyTests() {
        $tests = [
            // ======= Forward transition test cases =======
            
            // Into skipped hour
            // '2010-03-14T03:00:01-05:00' == '2010-03-14T02:00:01-05:00'
            // '2010-03-14T02:00:01-05:00' - 1 hour == '2010-03-14T01:00:01-05:00'
            ['2010-03-14T03:00:01', -1, '2010-03-14T01:00:01-05:00'],
            ['2010-03-14T01:00:01', +1, '2010-03-14T03:00:01-04:00'],
            
            // Over skipped hour php should adjust timestamp
            ['2010-03-14T03:00:01', -2, '2010-03-14T01:00:01-05:00'],
            ['2010-03-14T01:00:01', +2, '2010-03-14T03:00:01-04:00'],

            // ======= Backward transition test cases =======
            
            // Note: You can't create the date from a string into repeated hour in Daylight Time because php have not
            // needful statments for this.

            // Into repeated hour in Daylight Time
            // '2010-11-07T00:00:01-04:00' + 1 hour == '2010-11-07T01:00:01-04:00'
            ['2010-11-07T00:00:01', +1, '2010-11-07T01:00:01-04:00'],
            // '2010-11-07T02:00:01-05:00' - 2 hour == '2010-11-07T00:00:01-05:00'
            // '2010-11-07T00:00:01-05:00' == '2010-11-07T01:00:01-04:00'
            ['2010-11-07T02:00:01', -2, '2010-11-07T01:00:01-04:00'],
            
            // Into repeated hour in Standard Time
            // '2010-11-07T00:00:01-04:00' + 2 hour == '2010-11-07T02:00:01-04:00'
            // '2010-11-07T02:00:01-04:00' == '2010-11-07T02:00:01-05:00'
            ['2010-11-07T00:00:01', +2, '2010-11-07T01:00:01-05:00'],
            // '2010-11-07T02:00:01-05:00' - 1 hour == '2010-11-07T01:00:01-05:00'
            ['2010-11-07T02:00:01', -1, '2010-11-07T01:00:01-05:00'],
            
            // Over repeated hour php should adjust timestamp
            ['2010-11-07T00:00:01', +3, '2010-11-07T03:00:01-05:00'],
            ['2010-11-07T02:00:01', -3, '2010-11-06T23:00:01-04:00'],
        ];

        return $tests;
    }
}
