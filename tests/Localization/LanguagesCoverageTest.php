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

namespace Tests\Localization;

use Tests\AbstractTestCase;

class LanguagesCoverageTest extends AbstractTestCase
{
    public function testAllLanguagesAreTested()
    {
        $languages = glob(__DIR__.'/../../src/Carbon/Lang/*.php');
        $tests = array_map(function ($file) {
            return strtolower(substr(basename($file), 0, -8));
        }, glob(__DIR__.'/*Test.php'));
        $tester = $this;
        $missingLanguages = array_filter($languages, function ($language) use ($tester, $tests) {
            $file = basename($language);
            $covered = \in_array(
                str_replace(['_', '-', '@'], '', strtolower(substr($file, 0, -4))),
                $tests,
                true,
            );
            $tester->assertTrue($covered, "Expect $file language file to be covered.");

            return !$covered;
        });

        $this->assertCount(0, $missingLanguages, 'Expect to have 0 languages uncovered.');
    }
}
