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
use Tests\AbstractTestCase;

class LastErrorTest extends AbstractTestCase
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
            'warnings' => array('11' => 'The parsed date was invalid'),
            'error_count' => 0,
            'errors' => array(),
        );
    }

    public function testCreateHandlesLastErrors()
    {
        $carbon = new Carbon('2017-02-30');
        $datetime = new DateTime('2017-02-30');

        $this->assertSame($this->lastErrors, $carbon->getLastErrors());
        $this->assertSame($carbon->getLastErrors(), $datetime->getLastErrors());

        $carbon = new Carbon('2017-02-15');
        $datetime = new DateTime('2017-02-15');

        $this->assertSame($this->noErrors, $carbon->getLastErrors());
        $this->assertSame($carbon->getLastErrors(), $datetime->getLastErrors());
    }
}
