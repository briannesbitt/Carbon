<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon\Exceptions;

use Carbon\Exceptions\ParseErrorException;
use Tests\AbstractTestCase;

class ParseErrorExceptionTest extends AbstractTestCase
{
    public function testParseErrorException(): void
    {
        $exception = new ParseErrorException('string', '');

        $this->assertSame('Format expected string but data is missing', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }

    public function testParseErrorExceptionWithActualAndHelp(): void
    {
        $exception = new ParseErrorException('string', 'int', 'help message');

        $this->assertSame("Format expected string but get 'int'\nhelp message", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
