<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Tests\AbstractTestCase;

class GenericMacroTest extends AbstractTestCase
{
    /**
     * @var \Carbon\Carbon
     */
    protected $now;

    public function setUp()
    {
        parent::setUp();

        Carbon::setTestNow($this->now = Carbon::create(2017, 6, 27, 13, 14, 15, 'UTC'));
    }

    public function tearDown()
    {
        Carbon::resetMacros();
        Carbon::setTestNow();
        Carbon::serializeUsing(null);

        parent::tearDown();
    }

    public function testGenericMacro()
    {
        Carbon::genericMacro(function ($method) {
            $time = preg_replace('/[A-Z]/', ' $0', $method);

            try {
                if (isset($this)) {
                    return $this->modify($time);
                }

                return new static($time);
            } catch (\Throwable $exception) {
                if (stripos($exception->getMessage(), 'Failed to parse') !== false) {
                    throw new \BadMethodCallException('Try next macro', 0, $exception);
                }

                throw $exception;
            }
        });

        $this->assertSame('2017-07-02', $this->now->nextSunday()->format('Y-m-d'));
        $this->assertSame('2017-06-26', Carbon::lastMonday()->format('Y-m-d'));

        $message = null;
        try {
            Carbon::fooBar();
        } catch (\BadMethodCallException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Method '.Carbon::class.'::fooBar does not exist.', $message);

        $message = null;
        try {
            $this->now->barBiz();
        } catch (\BadMethodCallException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Method barBiz does not exist.', $message);
    }

    public function testGenericMacroPriority()
    {
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 8) !== 'myPrefix') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'first';
        });
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 8) !== 'myPrefix') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'second';
        }, 1);
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 8) !== 'myPrefix') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'third';
        }, -1);
        Carbon::macro('myPrefixFooBar', function () {
            return 'myPrefixFooBar';
        });

        $this->assertSame('second', $this->now->myPrefixSomething());
        $this->assertSame('second', Carbon::myPrefixSomething());
        $this->assertSame('myPrefixFooBar', $this->now->myPrefixFooBar());
        $this->assertSame('myPrefixFooBar', Carbon::myPrefixFooBar());
    }

    public function testLocalGenericMacroPriority()
    {
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 3) !== 'mlp') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'first';
        });
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 3) !== 'mlp') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'second';
        }, 1);
        Carbon::genericMacro(function ($method) {
            if (substr($method, 0, 3) !== 'mlp') {
                throw new \BadMethodCallException('Try next macro', 0);
            }

            return 'third';
        }, -1);
        Carbon::macro('mlpFooBar', function () {
            return 'mlpFooBar';
        });
        $d = Carbon::now()->settings([
            'genericMacros' => [
                function ($method) {
                    if (substr($method, 0, 3) !== 'mlp') {
                        throw new \BadMethodCallException('Try next macro', 0);
                    }

                    return 'local-first';
                },
                function ($method) {
                    if (substr($method, 0, 3) !== 'mlp') {
                        throw new \BadMethodCallException('Try next macro', 0);
                    }

                    return 'local-second';
                },
            ],
        ]);

        $this->assertSame('local-first', $d->mlpSomething());
        $this->assertSame('second', $this->now->mlpSomething());
        $this->assertSame('second', Carbon::mlpSomething());
        $this->assertSame('mlpFooBar', $d->mlpFooBar());
        $this->assertSame('mlpFooBar', $this->now->mlpFooBar());
        $this->assertSame('mlpFooBar', Carbon::mlpFooBar());
    }
}
