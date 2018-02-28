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

class ArShaklTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInArb()
    {
        Carbon::setLocale('ar_Shakl');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('مُنْذُ ثَانِيَتَيْن', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(3);
            $scope->assertSame('مُنْذُ 3 ثَوَان', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(10);
            $scope->assertSame('مُنْذُ 10 ثَوَان', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(11);
            $scope->assertSame('مُنْذُ 11 ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('مُنْذُ دَقِيقَة', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('مُنْذُ دَقِيقَتَيْن', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(3);
            $scope->assertSame('مُنْذُ 3 دَقَائِق', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(10);
            $scope->assertSame('مُنْذُ 10 دَقَائِق', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(11);
            $scope->assertSame('مُنْذُ 11 دَقِيقَة', $d->diffForHumans());

            $d = Carbon::now()->subHours(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('مُنْذُ سَاعَة', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('مُنْذُ سَاعَتَيْن', $d->diffForHumans());

            $d = Carbon::now()->subHours(3);
            $scope->assertSame('مُنْذُ 3 سَاعَات', $d->diffForHumans());

            $d = Carbon::now()->subHours(10);
            $scope->assertSame('مُنْذُ 10 سَاعَات', $d->diffForHumans());

            $d = Carbon::now()->subHours(11);
            $scope->assertSame('مُنْذُ 11 سَاعَة', $d->diffForHumans());

            $d = Carbon::now()->subDays(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('مُنْذُ يَوْم', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('مُنْذُ يَوْمَيْن', $d->diffForHumans());

            $d = Carbon::now()->subDays(3);
            $scope->assertSame('مُنْذُ 3 أَيَّام', $d->diffForHumans());

            $d = Carbon::now()->subDays(10);
            $scope->assertSame('مُنْذُ أُسْبُوع', $d->diffForHumans());

            $d = Carbon::now()->subDays(11);
            $scope->assertSame('مُنْذُ أُسْبُوع', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('مُنْذُ أُسْبُوع', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('مُنْذُ أُسْبُوعَيْن', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(3);
            $scope->assertSame('مُنْذُ 3 أَسَابِيع', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(10);
            $scope->assertSame('مُنْذُ شَهْرَيْن', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(11);
            $scope->assertSame('مُنْذُ شَهْرَيْن', $d->diffForHumans());

            $d = Carbon::now()->subMonths(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('مُنْذُ شَهْرَ', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('مُنْذُ شَهْرَيْن', $d->diffForHumans());

            $d = Carbon::now()->subMonths(3);
            $scope->assertSame('مُنْذُ 3 أَشْهُر', $d->diffForHumans());

            $d = Carbon::now()->subMonths(10);
            $scope->assertSame('مُنْذُ 10 أَشْهُر', $d->diffForHumans());

            $d = Carbon::now()->subMonths(11);
            $scope->assertSame('مُنْذُ 11 شَهْرَ', $d->diffForHumans());

            $d = Carbon::now()->subYears(0);
            $scope->assertSame('مُنْذُ ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('مُنْذُ سَنَة', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('مُنْذُ سَنَتَيْن', $d->diffForHumans());

            $d = Carbon::now()->subYears(3);
            $scope->assertSame('مُنْذُ 3 سَنَوَات', $d->diffForHumans());

            $d = Carbon::now()->subYears(10);
            $scope->assertSame('مُنْذُ 10 سَنَوَات', $d->diffForHumans());

            $d = Carbon::now()->subYears(11);
            $scope->assertSame('مُنْذُ 11 سَنَة', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('مِنَ الْآن ثَانِيَة', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('بَعْدَ ثَانِيَة', $d->diffForHumans($d2));
            $scope->assertSame('قَبْلَ ثَانِيَة', $d2->diffForHumans($d));

            $scope->assertSame('ثَانِيَة', $d->diffForHumans($d2, true));
            $scope->assertSame('ثَانِيَتَيْن', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
