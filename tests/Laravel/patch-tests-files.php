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

/**
 * This file should be removed once https://github.com/laravel/framework/pull/41824 is merged.
 */
$file = 'tests/Cache/CacheRepositoryTest.php';

file_put_contents($file, strtr(file_get_contents($file), [
    "class CacheRepositoryTest extends TestCase\n{" => <<<'CODE'
        class CacheRepositoryTest extends TestCase
        {
            protected function setUp(): void
            {
                parent::setUp();

                Carbon::setTestNow(Carbon::parse($this->getTestDate()));
            }

        CODE,
]));
