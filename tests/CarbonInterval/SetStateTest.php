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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class SetStateTest extends AbstractTestCase
{
    public function testEvaluatingVarExportReturnsCarbonIntervalInstance()
    {
        $export = var_export(CarbonInterval::minutes(3), true);

        $this->assertInstanceOfCarbonInterval(eval("return $export;"));
    }

    public function testStateIsPreserved()
    {
        $serializedInterval = CarbonInterval::minutes(3);
        $export = var_export($serializedInterval, true);

        /** @var CarbonInterval $deserializedInterval */
        $deserializedInterval = eval("return $export;");

        $this->assertTrue($deserializedInterval->eq($serializedInterval));
    }
}
