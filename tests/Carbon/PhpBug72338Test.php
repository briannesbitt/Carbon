<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Igor Deyashkin <igor_deyawka@mail.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

/**
 * The problem is, that $date->setTimezone($tz) with $tz in 'HH:MM' notation (["timezone_type"]=>int(1)) put DateTime object
 *   on inconsistent state. It looks like internal timestamp becomes changed and it affects to such functions:
 *
 * * $date->modify() uses changed timestamp and result is wrong
 *
 * * $date->setTimezone($tz) settle this changed timestamp, even in case if $tz is not in 'HH:MM' format
 *
 * * $date->format('U') returns changed timestamp
 *
 * @link https://bugs.php.net/bug.php?id=72338 This bug on bugs.php.net
 *
 * @internal I use days changing in tests because using seconds|minute|hours may run setTimezone within.
 */
class PhpBug72338Test extends AbstractTestCase
{
    protected function setUp()
    {
        parent::setUp();

        // In versions <= 5.5.5 setTimezone doesn't accept timezone in 'HH:MM' format.
        // I don't know about versions between 5.5.5 and 5.5.18, but 5.5.18 accept it.
        $this->requirePhpVersion('5.5.18');
    }

    /**
     * Ensures that modify don't use changed timestamp
     */
    public function testModify()
    {
        $date = Carbon::createFromTimestamp(0);
        $date->setTimezone('+02:00');
        $date->modify('+1 day');
        $this->assertSame('86400', $date->format('U'));
    }

    /**
     * Ensures that $date->format('U') returns unchanged timestamp
     */
    public function testTimestamp()
    {
        $date = Carbon::createFromTimestamp(0);
        $date->setTimezone('+02:00');
        $this->assertSame('0', $date->format('U'));
    }

    /**
     * Ensures that date created from string with timezone and with same timezone set by setTimezone() is equal
     */
    public function testEqualSetAndCreate()
    {
        $date = Carbon::createFromTimestamp(0);
        $date->setTimezone('+02:00');
        $date1 = new Carbon('1970-01-01T02:00:00+02:00');
        $this->assertSame($date->format('U'), $date1->format('U'));
    }

    /**
     * Ensures that second call to setTimezone() don't changing timestamp
     */
    public function testSecondSetTimezone()
    {
        $date = Carbon::createFromTimestamp(0);
        $date->setTimezone('+02:00');
        $date->setTimezone('Europe/Moscow');
        $this->assertSame('0', $date->format('U'));
    }
}
