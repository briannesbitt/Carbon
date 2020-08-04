<?php

declare(strict_types=1);

namespace Tests\PHPStan;

use Carbon\Carbon;

Carbon::macro('foo', function (): string {
    return 'foo';
});

class BadFixture
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
