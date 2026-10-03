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

namespace Tests\CarbonImmutable;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Closure;
use NoDiscard;
use PHPUnit\Framework\Attributes\RequiresPhp;
use PHPUnit\Framework\Attributes\TestWith;
use ReflectionMethod;
use Tests\AbstractTestCase;

class NoDiscardTest extends AbstractTestCase
{
    #[TestWith(['modify'])]
    #[TestWith(['add'])]
    #[TestWith(['sub'])]
    #[TestWith(['setDate'])]
    #[TestWith(['setISODate'])]
    #[TestWith(['setTime'])]
    #[TestWith(['setTimestamp'])]
    #[TestWith(['setTimezone'])]
    #[TestWith(['next'])]
    #[TestWith(['previous'])]
    #[TestWith(['__call'])]
    public function testModifiersAreMarkedNoDiscard(string $method): void
    {
        $attributes = (new ReflectionMethod(CarbonImmutable::class, $method))->getAttributes(NoDiscard::class);

        $this->assertCount(1, $attributes);
    }

    #[RequiresPhp('>=8.5.0')]
    public function testDiscardedResultTriggersWarning(): void
    {
        $date = CarbonImmutable::parse('2024-01-01');
        $calls = [
            'modify' => ['+1 day'],
            'add' => ['day', 1],
            'sub' => ['day', 1],
            'setDate' => [2024, 2, 2],
            'setISODate' => [2024, 2],
            'setTime' => [12, 0],
            'setTimestamp' => [0],
            'setTimezone' => ['Europe/Paris'],
            'next' => [],
            'previous' => [],
            'addDays' => [2],
        ];

        // Dynamic calls, so static analysis does not report the result is discarded on purpose
        $this->assertSame(array_keys($calls), $this->getDiscardWarnings(static function () use ($date, $calls) {
            foreach ($calls as $method => $parameters) {
                $date->$method(...$parameters);
            }
        }));
        $this->assertSame('2024-01-01 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    #[RequiresPhp('>=8.5.0')]
    public function testMutableModifiersDoNotTriggerWarning(): void
    {
        $date = Carbon::parse('2024-01-01');
        $calls = [
            'modify' => ['+1 day'],
            'add' => ['day', 1],
            'next' => [],
            'addDays' => [2],
        ];

        $this->assertSame([], $this->getDiscardWarnings(static function () use ($date, $calls) {
            foreach ($calls as $method => $parameters) {
                $date->$method(...$parameters);
            }
        }));
        $this->assertSame('2024-01-12', $date->format('Y-m-d'));
    }

    /**
     * @return list<string>
     */
    private function getDiscardWarnings(Closure $callback): array
    {
        $warnings = [];

        set_error_handler(static function (int $level, string $message) use (&$warnings) {
            if (preg_match('/^The return value of method [^:]+::(\w+)\(\) should either be used/', $message, $match)) {
                $warnings[] = $match[1];

                return true;
            }

            return false;
        }, E_WARNING | E_USER_WARNING);

        try {
            $callback();
        } finally {
            restore_error_handler();
        }

        return $warnings;
    }
}
