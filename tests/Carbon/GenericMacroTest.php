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

use BadMethodCallException;
use Carbon\Carbon;
use Tests\AbstractTestCaseWithOldNow;
use Throwable;

class GenericMacroTest extends AbstractTestCaseWithOldNow
{
    public function testGenericMacro()
    {
        Carbon::genericMacro(function ($method) {
            $time = preg_replace('/[A-Z]/', ' $0', $method);

            try {
                return self::this()->modify($time);
            } catch (Throwable $exception) {
                if (preg_match('(Could not modify with|Failed to parse)', $exception->getMessage())) {
                    throw new BadMethodCallException('Try next macro', 0, $exception);
                }

                throw $exception;
            }
        });

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame('2017-07-02', $now->nextSunday()->format('Y-m-d'));
        $this->assertSame('2017-06-26', Carbon::lastMonday()->format('Y-m-d'));

        $message = null;

        try {
            Carbon::fooBar();
        } catch (BadMethodCallException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Method '.Carbon::class.'::fooBar does not exist.', $message);

        $message = null;

        try {
            $now->barBiz();
        } catch (BadMethodCallException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Method barBiz does not exist.', $message);
    }

    public function testGenericMacroPriority()
    {
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'myPrefix')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'first';
        });
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'myPrefix')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'second';
        }, 1);
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'myPrefix')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'third';
        }, -1);
        Carbon::macro('myPrefixFooBar', function () {
            return 'myPrefixFooBar';
        });

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame('second', $now->myPrefixSomething());
        $this->assertSame('second', Carbon::myPrefixSomething());
        $this->assertSame('myPrefixFooBar', $now->myPrefixFooBar());
        $this->assertSame('myPrefixFooBar', Carbon::myPrefixFooBar());
    }

    public function testLocalGenericMacroPriority()
    {
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'mlp')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'first';
        });
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'mlp')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'second';
        }, 1);
        Carbon::genericMacro(function ($method) {
            if (!str_starts_with($method, 'mlp')) {
                throw new BadMethodCallException('Try next macro', 0);
            }

            return 'third';
        }, -1);
        Carbon::macro('mlpFooBar', function () {
            return 'mlpFooBar';
        });

        /** @var mixed $date */
        $date = Carbon::now()->settings([
            'genericMacros' => [
                function ($method) {
                    if (!str_starts_with($method, 'mlp')) {
                        throw new BadMethodCallException('Try next macro', 0);
                    }

                    return 'local-first';
                },
                function ($method) {
                    if (!str_starts_with($method, 'mlp')) {
                        throw new BadMethodCallException('Try next macro', 0);
                    }

                    return 'local-second';
                },
            ],
        ]);

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame('local-first', $date->mlpSomething());
        $this->assertSame('second', $now->mlpSomething());
        $this->assertSame('second', Carbon::mlpSomething());
        $this->assertSame('mlpFooBar', $date->mlpFooBar());
        $this->assertSame('mlpFooBar', $now->mlpFooBar());
        $this->assertSame('mlpFooBar', Carbon::mlpFooBar());
    }
}
