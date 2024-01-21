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
use Carbon\Traits\Creator;
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
            'warnings' => ['11' => 'The parsed date was invalid'],
            'error_count' => 0,
            'errors' => [],
        ];
    }

    public function testCreateHandlesLastErrors()
    {
        $carbon = new Carbon('2017-02-30');
        $datetime = new DateTime('2017-02-30');

        $this->assertSame($this->lastErrors, $carbon->getLastErrors());
        $this->assertSame($carbon->getLastErrors(), $datetime->getLastErrors());

        $carbon = new Carbon('2017-02-15');

        $this->assertSame($this->noErrors, $carbon->getLastErrors());
    }

    public function testLastErrorsInitialization()
    {
        $obj = new class() {
            use Creator;

            /** @phpstan-ignore-next-line */
            public function __construct($time = null, $tz = null)
            {
            }

            public function triggerError()
            {
                self::setLastErrors(false);
            }
        };
        $this->assertFalse($obj::getLastErrors());
        $obj->triggerError();
        $this->assertSame([
            'warning_count' => 0,
            'warnings' => [],
            'error_count' => 0,
            'errors' => [],
        ], $obj::getLastErrors());
    }
}
