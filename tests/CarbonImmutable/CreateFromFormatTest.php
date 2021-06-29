<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->noErrors = [
            'warning_count' => 0,
            'warnings' => [],
            'error_count' => 0,
            'errors' => [],
        ];

        $this->lastErrors = [
            'warning_count' => 1,
            'warnings' => ['10' => 'The parsed date was invalid'],
            'error_count' => 0,
            'errors' => [],
        ];
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

    public function testCreateFromFormatWithTestNow()
    {
        Carbon::setTestNow();
        $nativeDate = Carbon::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11');
        Carbon::setTestNow(Carbon::now());
        $mockedDate = Carbon::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11');

        $this->assertSame($mockedDate->micro === 0, $nativeDate->micro === 0);
    }

    public function testCreateLastErrorsCanBeAccessedByExtendingClass()
    {
        $this->assertSame([
            'warning_count' => 0,
            'warnings' => [],
            'error_count' => 0,
            'errors' => [],
        ], MyCarbon::getLastErrors());
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

    public function testCreateFromFormatWithDollar()
    {
        $d = Carbon::createFromFormat('$c', '$1975-05-21T22:32:11+01:00');
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11);
        $this->assertInstanceOfCarbon($d);
    }
}
