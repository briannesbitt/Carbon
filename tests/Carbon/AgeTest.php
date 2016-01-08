<?php

/*
 * This file is part of the Carbon package.
 *
 * @author Amr Samy <me@amrsamy.com>
 * 
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class AgeTest extends AbstractTestCase
{
    /**
     * @var string dummy date for testing purposes
     */
    private $testDate = '1984/03/09';

    public function testGetBirthYear()
    {
        $age = 32;
        $this->assertEquals(Carbon::now()->subYears($age)->year, Carbon::birthYear($age));
    }

    public function testGetAge()
    {
        $ageArray = Carbon::age($this->testDate);
        $this->assertArrayHasKey('year', $ageArray);
        $this->assertArrayHasKey('month', $ageArray);
        $this->assertArrayHasKey('day', $ageArray);
        $this->assertArrayHasKey('hour', $ageArray);
        $this->assertArrayHasKey('minute', $ageArray);
        $this->assertArrayHasKey('second', $ageArray);
    }

    public function testGetAgeForHumans()
    {
        $this->assertStringMatchesFormat('%d year%S,%d month%S,%d day%S,%d hour%S,%d minute%S,%d second%S', Carbon::ageForHumans($this->testDate));
    }

    public function testGetAgeInDays()
    {
        $date = Carbon::parse($this->testDate);
        $this->assertEquals(Carbon::now()->diffInDays($date), Carbon::ageInDays($this->testDate));
    }

    public function testGetAgeInHours()
    {
        $date = Carbon::parse($this->testDate);
        $this->assertEquals(Carbon::now()->diffInHours($date), Carbon::ageInHours($this->testDate));
    }

    public function testGetAgeInMinutes()
    {
        $date = Carbon::parse($this->testDate);
        $this->assertEquals(Carbon::now()->diffInMinutes($date), Carbon::ageInMinutes($this->testDate));
    }
}
