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
use Tests\AbstractTestCaseWithOldNow;

class MacroContextNestingTest extends AbstractTestCaseWithOldNow
{
    public function getMacroableClasses()
    {
        return [
            [Carbon::class, Carbon::parse('2010-05-23'), null],
            [CarbonImmutable::class, CarbonImmutable::parse('2010-05-23'), null],
            [CarbonInterval::class, CarbonInterval::make('P1M6D'), strval(CarbonInterval::second())],
            [CarbonPeriod::class, CarbonPeriod::create('2010-08-23', '2010-10-02'), null],
        ];
    }

    /**
     * @dataProvider getMacroableClasses
     *
     * @param string      $class
     * @param mixed       $sample
     * @param string|null $reference
     */
    public function testMacroContextNesting($class, $sample, $reference)
    {
        $macro1 = 'macro'.mt_rand(100, 999999);
        $class::macro($macro1, static function () {
            return self::this()->__toString();
        });

        $macro2 = 'macro'.mt_rand(100, 999999);
        $class::macro($macro2, static function () use ($macro1, $sample) {
            $dates = [self::this()->$macro1()];

            $dates[] = $sample->$macro1();
            $dates[] = self::this()->$macro1();

            return $dates;
        });

        $dates = $class::$macro2();

        $this->assertSame([
            $reference ?: strval(new $class),
            strval($sample),
            $reference ?: strval(new $class),
        ], $dates);
    }
}
