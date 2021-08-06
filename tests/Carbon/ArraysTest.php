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
use Carbon\Translator;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\DumpCarbon;

class ArraysTest extends AbstractTestCase
{
    public function testToArray()
    {
        $dt = Carbon::now();
        $dtToArray = $dt->toArray();

        $this->assertIsArray($dtToArray);

        $this->assertArrayHasKey('year', $dtToArray);
        $this->assertSame($dt->year, $dtToArray['year']);

        $this->assertArrayHasKey('month', $dtToArray);
        $this->assertSame($dt->month, $dtToArray['month']);

        $this->assertArrayHasKey('day', $dtToArray);
        $this->assertSame($dt->day, $dtToArray['day']);

        $this->assertArrayHasKey('dayOfWeek', $dtToArray);
        $this->assertSame($dt->dayOfWeek, $dtToArray['dayOfWeek']);

        $this->assertArrayHasKey('dayOfYear', $dtToArray);
        $this->assertSame($dt->dayOfYear, $dtToArray['dayOfYear']);

        $this->assertArrayHasKey('hour', $dtToArray);
        $this->assertSame($dt->hour, $dtToArray['hour']);

        $this->assertArrayHasKey('minute', $dtToArray);
        $this->assertSame($dt->minute, $dtToArray['minute']);

        $this->assertArrayHasKey('second', $dtToArray);
        $this->assertSame($dt->second, $dtToArray['second']);

        $this->assertArrayHasKey('micro', $dtToArray);
        $this->assertSame($dt->micro, $dtToArray['micro']);

        $this->assertArrayHasKey('timestamp', $dtToArray);
        $this->assertSame($dt->timestamp, $dtToArray['timestamp']);

        $this->assertArrayHasKey('timezone', $dtToArray);
        $this->assertEquals($dt->timezone, $dtToArray['timezone']);

        $this->assertArrayHasKey('formatted', $dtToArray);
        $this->assertSame($dt->format(Carbon::DEFAULT_TO_STRING_FORMAT), $dtToArray['formatted']);
    }

    public function testDebugInfo()
    {
        $dt = Carbon::parse('2019-04-09 11:10:10.667952');
        $debug = $dt->__debugInfo();

        // Ignored as not in PHP 8
        if (isset($debug['timezone_type'])) {
            unset($debug['timezone_type']);
        }

        $this->assertSame([
            'date' => '2019-04-09 11:10:10.667952',
            'timezone' => 'America/Toronto',
        ], $debug);

        $dt = Carbon::parse('2019-04-09 11:10:10.667952')->locale('fr_FR');
        $debug = $dt->__debugInfo();

        // Ignored as not in PHP 8
        if (isset($debug['timezone_type'])) {
            unset($debug['timezone_type']);
        }

        $this->assertSame([
            'localTranslator' => Translator::get('fr_FR'),
            'date' => '2019-04-09 11:10:10.667952',
            'timezone' => 'America/Toronto',
        ], $debug);
    }

    public function testDebuggingWithFormatException()
    {
        $date = new DumpCarbon();
        $date->breakFormat();
        $this->assertIsArray($date->__debugInfo());
    }

    public function testDebuggingUninitializedInstances()
    {
        $date = new DumpCarbon();
        $this->assertStringContainsString(DumpCarbon::class, $date->getDump());
    }
}
