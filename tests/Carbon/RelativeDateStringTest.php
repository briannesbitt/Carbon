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

class RelativeDateStringTest extends AbstractTestCase
{
    public $scenarios = array(

        // ensure regular timestamps are flagged as relative
        '2018-01-02 03:04:05' => array('date' => '2018-01-02', 'is_relative' => false),
        '1500-01-02 12:00:00' => array('date' => '1500-01-02', 'is_relative' => false),
        '1985-12-10' => array('date' => '1985-12-10', 'is_relative' => false),
        'Dec 2017' => array('date' => '2017-12-01', 'is_relative' => false),
        '25-Dec-2017' => array('date' => '2017-12-25', 'is_relative' => false),
        '25 December 2017' => array('date' => '2017-12-25', 'is_relative' => false),
        '25 Dec 2017' => array('date' => '2017-12-25', 'is_relative' => false),
        'Dec 25 2017' => array('date' => '2017-12-25', 'is_relative' => false),

        // dates not relative now
        'first day of January 2008' => array('date' => '2008-01-01', 'is_relative' => false),
        'first day of January 1999' => array('date' => '1999-01-01', 'is_relative' => false),
        'last day of January 1999' => array('date' => '1999-01-31', 'is_relative' => false),
        'last monday of January 1999' => array('date' => '1999-01-25', 'is_relative' => false),
        'first day of January 0001' => array('date' => '0001-01-01', 'is_relative' => false),
        'monday december 1750' => array('date' => '1750-12-07', 'is_relative' => false),
        'december 1750' => array('date' => '1750-12-01', 'is_relative' => false),
        'last sunday of January 2005' => array('date' => '2005-01-30', 'is_relative' => false),
        'January 2008' => array('date' => '2008-01-01', 'is_relative' => false),

        // dates relative to now
        'first day of next month' => array('date' => '2017-02-01', 'is_relative' => true),
        'sunday noon' => array('date' => '2017-01-01', 'is_relative' => true),
        'sunday midnight' => array('date' => '2017-01-01', 'is_relative' => true),
        'monday december' => array('date' => '2017-12-04', 'is_relative' => true),
        'next saturday' => array('date' => '2017-01-07', 'is_relative' => true),
        'april' => array('date' => '2017-04-01', 'is_relative' => true),
    );

    public function test_keyword_matching()
    {
        foreach ($this->scenarios as $string => $expected) {
            $actual = Carbon::hasRelativeKeywords($string);

            $this->assertSame(
                $expected['is_relative'],
                $actual,
                "Failed relative keyword matching for scenario: {$string} (expected: {$expected['is_relative']})"
            );
        }
    }

    public function test_relative_input_strings()
    {
        Carbon::setTestNow('2017-01-01 12:00:00');

        foreach ($this->scenarios as $string => $expected) {
            $actual = Carbon::parse($string)->format('Y-m-d');

            $this->assertSame(
                $expected['date'],
                $actual,
                "Failed relative date scenario: {$string}"
            );
        }
    }
}
