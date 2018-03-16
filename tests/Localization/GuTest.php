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

class GuTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGujarati()
    {
        Carbon::setLocale('gu');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 સેકેન્ડ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 સેકેન્ડ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 મિનિટ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 મિનિટ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 કલાક પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 કલાકો પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 દિવસ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 દિવસો પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 અઠવાડિયું પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 અઠવાડિયા પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 મહિનો પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 મહિના પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 વર્ષ પહેલા', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 વર્ષો પહેલા', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 સેકેન્ડ અત્યારથી', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 સેકેન્ડ પછી', $d->diffForHumans($d2));
            $scope->assertSame('1 સેકેન્ડ પહેલા', $d2->diffForHumans($d));

            $scope->assertSame('1 સેકેન્ડ', $d->diffForHumans($d2, true));
            $scope->assertSame('2 સેકેન્ડ', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInShortGujarati()
    {
        Carbon::setLocale('gu');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1સે. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2સે. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1મિ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2મિ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1ક. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2ક. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1દિ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2દિ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1અઠ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2અઠ. પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1મહિનો પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2મહિના પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1વર્ષ પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2વર્ષો પહેલા', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1સે. અત્યારથી', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1સે. પછી', $d->diffForHumans($d2, false, true));
            $scope->assertSame('1સે. પહેલા', $d2->diffForHumans($d, false, true));

            $scope->assertSame('1સે.', $d->diffForHumans($d2, true, true));
            $scope->assertSame('2સે.', $d2->diffForHumans($d->addSecond(), true, true));
        });
    }
}
