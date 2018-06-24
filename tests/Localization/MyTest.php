<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class MyTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInMyanmar()
    {
        Carbon::setLocale('my');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('လွန်ခဲ့သော 1 စက္ကန့် က', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('လွန်ခဲ့သော 2 စက္ကန့် က', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('လွန်ခဲ့သော 1 မိနစ် က', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('လွန်ခဲ့သော 2 မိနစ် က', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('လွန်ခဲ့သော 1 နာရီ က', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('လွန်ခဲ့သော 2 နာရီ က', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('လွန်ခဲ့သော 1 ရက် က', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('လွန်ခဲ့သော 2 ရက် က', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('လွန်ခဲ့သော 1 ပတ် က', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('လွန်ခဲ့သော 2 ပတ် က', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('လွန်ခဲ့သော 1 လ က', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('လွန်ခဲ့သော 2 လ က', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('လွန်ခဲ့သော 1 နှစ် က', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('လွန်ခဲ့သော 2 နှစ် က', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('ယခုမှစ၍နောက် 1 စက္ကန့် အကြာ', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 စက္ကန့် ကြာပြီးနောက်', $d->diffForHumans($d2));
            $scope->assertSame('1 စက္ကန့် မတိုင်ခင်', $d2->diffForHumans($d));

            $scope->assertSame('1 စက္ကန့်', $d->diffForHumans($d2, true));
            $scope->assertSame('2 စက္ကန့်', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
