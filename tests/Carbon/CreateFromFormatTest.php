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
use DateTime;
use DateTimeZone;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

class CreateFromFormatTest extends AbstractTestCase
{
    /**
     * @var array
     */
    protected $lastErrors;

    /**
     * @var array
     */
    protected $noErrors;

    public function setUp()
    {
        parent::setUp();

        $this->noErrors = array(
            'warning_count' => 0,
            'warnings' => array(),
            'error_count' => 0,
            'errors' => array(),
        );

        $this->lastErrors = array(
            'warning_count' => 1,
            'warnings' => array('10' => 'The parsed date was invalid'),
            'error_count' => 0,
            'errors' => array(),
        );
    }

    public function testCreateFromFormatReturnsCarbon()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11');
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11);
        $this->assertInstanceOfCarbon($d);
    }

    public function testCreateFromFormatWithTimezoneString()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11', 'Europe/London');
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromFormatWithTimezone()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11', new DateTimeZone('Europe/London'));
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromFormatWithMillis()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s.u', '1975-05-21 22:32:11.254687');
        $this->assertSame(254687, $d->micro);
    }

    public function testCreateLastErrorsCanBeAccessedByExtendingClass()
    {
        $this->assertSame(array(
            'warning_count' => 0,
            'warnings' => array(),
            'error_count' => 0,
            'errors' => array(),
        ), MyCarbon::getLastErrors());
    }

    public function testCreateFromFormatHandlesLastErrors()
    {
        $carbon = Carbon::createFromFormat('d/m/Y', '41/02/1900');
        $datetime = DateTime::createFromFormat('d/m/Y', '41/02/1900');

        $this->assertSame($this->lastErrors, $carbon->getLastErrors());
        $this->assertSame($carbon->getLastErrors(), $datetime->getLastErrors());
    }

    public function testCreateFromFormatResetLastErrors()
    {
        $carbon = Carbon::createFromFormat('d/m/Y', '41/02/1900');
        $this->assertSame($this->lastErrors, $carbon->getLastErrors());

        $carbon = Carbon::createFromFormat('d/m/Y', '11/03/2016');
        $this->assertSame($this->noErrors, $carbon->getLastErrors());
    }
}
