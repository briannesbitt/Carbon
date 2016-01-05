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
    	$ageArray = Carbon::getAge('1984/03/09');
    	$this->assertArrayHasKey('years',$ageArray);
    	$this->assertArrayHasKey('months',$ageArray);
    	$this->assertArrayHasKey('days',$ageArray);
    	$this->assertArrayHasKey('hours',$ageArray);
    	$this->assertArrayHasKey('minutes',$ageArray);
    	$this->assertArrayHasKey('seconds',$ageArray);
    }
    
    /*
     * @covers Carbon::getAgeForHumans
     */
    public function testGetAgeForHumans()
    {
    	$this->assertStringMatchesFormat('%d year%S,%d month%S,%d day%S,%d hour%S,%d minute%S,%d second%S', Carbon::getAgeForHumans('1984/03/09'));
    }
    
    /*
     * @covers Carbon::getAgeInDays
     */
    public function testGetAgeInDays()
    {
		$date = Carbon::parse('1984/03/09');
		$this->assertEquals(Carbon::now()->diffInDays($date), Carbon::getAgeInDays('1984/03/09'));
    }

    /*
     * @covers Carbon::getAgeInHours
     */
    public function testGetAgeInHours()
    {
		$date = Carbon::parse('1984/03/09');
		$this->assertEquals(Carbon::now()->diffInHours($date), Carbon::getAgeInHours('1984/03/09'));
    }
 
    /**
     * @covers Carbon::getAgeInMinutes
     */
    public function testGetAgeInMinutes()
    {
		$date = Carbon::parse('1984/03/09');
		$this->assertEquals(Carbon::now()->diffInMinutes($date), Carbon::getAgeInMinutes('1984/03/09'));
    }
    
}
