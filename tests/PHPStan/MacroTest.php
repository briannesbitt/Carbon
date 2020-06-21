<?php

declare(strict_types=1);

namespace Tests\PHPStan;

use Carbon\Carbon;
use Carbon\PHPStan\Macro;
use ReflectionFunction;
use Tests\AbstractTestCase;

class MacroTest extends AbstractTestCase
{
    public function testStatic()
    {
        $macro = new Macro(Carbon::class, 'calendarBerlin', new ReflectionFunction(static function (): string {
            return self::this()->tz('Europe/Berlin')->calendar();
        }));

        $this->assertTrue($macro->isStatic());

        $macro = new Macro(Carbon::class, 'calendarBerlin', new ReflectionFunction(function (): string {
            return $this->tz('Europe/Berlin')->calendar();
        }));

        $this->assertFalse($macro->isStatic());
    }
}
