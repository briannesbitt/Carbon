<?php

declare(strict_types=1);

namespace Tests\PHPStan;

use Carbon\Carbon;

Carbon::macro('foo', static function (): string {
    return 'foo';
});

class Fixture
{
    public function testCarbonMacroCalledStatically(): string
    {
        return Carbon::foo();
    }

    public function testCarbonMacroCalledDynamically(): string
    {
        return Carbon::now()->foo();
    }
}
