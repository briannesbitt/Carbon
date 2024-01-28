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

use Carbon\Exceptions\NotLocaleAwareException;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use stdClass;
use Tests\AbstractTestCase;

class NotLocaleAwareExceptionTest extends AbstractTestCase
{
    public static function dataForTestNotAPeriodException(): Generator
    {
        yield [
            new stdClass(),
            'stdClass does neither implements Symfony\Contracts\Translation\LocaleAwareInterface nor getLocale() method.',
        ];
        yield [
            'foo',
            'string does neither implements Symfony\Contracts\Translation\LocaleAwareInterface nor getLocale() method.',
        ];
    }

    #[DataProvider('dataForTestNotAPeriodException')]
    public function testNotAPeriodException(mixed $object, string $message): void
    {
        $exception = new NotLocaleAwareException($object);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
