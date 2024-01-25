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

    public function testCreateFromFormatWithNamedArguments()
    {
        $d = Carbon::createFromFormat(
            format: 'Y-m-d H:i:s',
            time: '1975-05-21 22:32:11',
            timezone: 'Asia/tokyo',
        );
        $this->assertSame('1975-05-21 22:32:11 Asia/tokyo', $d->format('Y-m-d H:i:s e'));
    }

    public function testCreateFromFalseTimezone()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s.u', '1975-05-21 22:32:11.123456', false);
        $this->assertInstanceOfCarbon($d);
        $this->assertSame('1975-05-21 22:32:11.123456 America/Toronto', $d->format('Y-m-d H:i:s.u e'));
    }

    /**
     * Work-around for https://bugs.php.net/bug.php?id=80141
     */
    public function testCFormat()
    {
        $d = Carbon::createFromFormat('c', Carbon::parse('2020-02-02')->format('c'));
        $this->assertCarbon($d, 2020, 2, 2, 0, 0, 0, 0);
        $d = Carbon::createFromFormat('c', '2020-02-02T23:45:12+09:00');
        $this->assertSame('+09:00', $d->tzName);
        $this->assertCarbon($d, 2020, 2, 2, 23, 45, 12, 0);
        $d = Carbon::createFromFormat('l c', 'Sunday 2020-02-02T23:45:12+09:00');
        $this->assertSame('+09:00', $d->tzName);
        $this->assertCarbon($d, 2020, 2, 2, 23, 45, 12, 0);
        $d = Carbon::createFromFormat('l \\\\c', 'Sunday \\2020-02-02T23:45:12+09:00');
        $this->assertSame('+09:00', $d->tzName);
        $this->assertCarbon($d, 2020, 2, 2, 23, 45, 12, 0);
        $d = Carbon::createFromFormat('Y-m-d\\cH:i:s', '2020-02-02c23:45:12');
        $this->assertCarbon($d, 2020, 2, 2, 23, 45, 12, 0);
    }

    public function testCreateFromFormatWithMillisecondsAlone()
    {
        $d = Carbon::createFromFormat('Y-m-d H:i:s.v', '1975-05-21 22:32:11.321');
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11, 321000);
        $this->assertInstanceOfCarbon($d);
    }

    /**
     * Due to https://bugs.php.net/bug.php?id=75577, proper "v" format support can only work from PHP 7.3.0.
     */
    public function testCreateFromFormatWithMillisecondsMerged()
    {
        $d = Carbon::createFromFormat('Y-m-d H:s.vi', '1975-05-21 22:11.32132');
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 11, 321000);
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
}
