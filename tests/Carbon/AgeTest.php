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
	 * @var string $testDate dummy date for testing purposes
	 */
	private $testDate = '1984/03/09';
	
	/**
	 * @covers Carbon::getBirthYear
	 */
    public function testGetBirthYear()
    {
		$age = 32;
		$this->assertEquals(Carbon::now()->subYears($age)->year, Carbon::getBirthYear($age));
    }
    
    /*
     * @covers Carbon::getAge
     */
    public function testGetAge()
    {
    	$ageArray = Carbon::getAge($this->testDate);
    	$this->assertArrayHasKey('year',$ageArray);
    	$this->assertArrayHasKey('month',$ageArray);
    	$this->assertArrayHasKey('day',$ageArray);
    	$this->assertArrayHasKey('hour',$ageArray);
    	$this->assertArrayHasKey('minute',$ageArray);
    	$this->assertArrayHasKey('second',$ageArray);
    }
    
    /*
     * @covers Carbon::getAgeForHumans
     */
    public function testGetAgeForHumans()
    {
    	$this->assertStringMatchesFormat('%d year%S,%d month%S,%d day%S,%d hour%S,%d minute%S,%d second%S', Carbon::getAgeForHumans($this->testDate));
    }
    
    /*
     * @covers Carbon::getAgeInDays
     */
    public function testGetAgeInDays()
    {
		$date = Carbon::parse($this->testDate);
		$this->assertEquals(Carbon::now()->diffInDays($date), Carbon::getAgeInDays($this->testDate));
    }

    /*
     * @covers Carbon::getAgeInHours
     */
    public function testGetAgeInHours()
    {
		$date = Carbon::parse($this->testDate);
		$this->assertEquals(Carbon::now()->diffInHours($date), Carbon::getAgeInHours($this->testDate));
    }
 
    /**
     * @covers Carbon::getAgeInMinutes
     */
    public function testGetAgeInMinutes()
    {
		$date = Carbon::parse($this->testDate);
		$this->assertEquals(Carbon::now()->diffInMinutes($date), Carbon::getAgeInMinutes($this->testDate));
    }
    
}
