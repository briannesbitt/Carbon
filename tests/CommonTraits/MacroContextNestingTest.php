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

namespace Tests\CommonTraits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCaseWithOldNow;

class MacroContextNestingTest extends AbstractTestCaseWithOldNow
{
    public static function dataForMacroableClasses(): Generator
    {
        yield [Carbon::class, Carbon::parse('2010-05-23'), null];
        yield [CarbonImmutable::class, CarbonImmutable::parse('2010-05-23'), null];
        yield [CarbonInterval::class, CarbonInterval::make('P1M6D'), (string) (CarbonInterval::seconds(0))];
        yield [CarbonPeriod::class, CarbonPeriod::create('2010-08-23', '2010-10-02'), null];
    }

    #[DataProvider('dataForMacroableClasses')]
    public function testMacroContextNesting(string $class, mixed $sample, ?string $reference): void
    {
        $macro1 = 'macro'.(mt_rand(100, 999999) * 2);
        $class::macro($macro1, static function () {
            return self::this()->__toString();
        });

        $macro2 = 'macro'.(mt_rand(100, 999999) * 2 + 1);
        $class::macro($macro2, static function () use ($macro1, $sample) {
            $dates = [self::this()->$macro1()];

            $dates[] = $sample->$macro1();
            $dates[] = self::this()->$macro1();

            return $dates;
        });

        $dates = $class::$macro2();

        $this->assertSame([
            $reference ?: (string) (new $class()),
            (string) $sample,
            $reference ?: (string) (new $class()),
        ], $dates);
    }

    /**
     * @param class-string $class
     */
    #[DataProvider('dataForMacroableClasses')]
    public function testMacroContextDetectionNesting(string $class, mixed $sample)
    {
        $macro1 = 'macro'.(mt_rand(100, 999999) * 2);
        $class::macro($macro1, static function () {
            $context = self::context();

            return $context ? \get_class($context) : 'null';
        });

        $macro2 = 'macro'.(mt_rand(100, 999999) * 2 + 1);
        $class::macro($macro2, static function () use ($macro1, $sample) {
            $dump = [self::$macro1(), self::this()->$macro1()];

            $dump[] = $sample->$macro1();
            $dump[] = self::$macro1();

            return $dump;
        });

        $dump = $class::$macro2();

        $this->assertSame([
            'null',
            $class,
            $class,
            'null',
        ], $dump);
    }
}
