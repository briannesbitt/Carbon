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

namespace Tests\PHPStan;

use PHPUnit\Framework\Attributes\RequiresPhp;
use RuntimeException;
use Tests\AbstractTestCase;

#[RequiresPhp('<8.4')]
class FeaturesTest extends AbstractTestCase
{
    /**
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    protected $phpStanPreviousDirectory = '.';

    protected function setUp(): void
    {
        parent::setUp();
        $this->phpStanPreviousDirectory = getcwd();
        chdir(__DIR__.'/../..');
    }

    protected function tearDown(): void
    {
        chdir($this->phpStanPreviousDirectory);
        parent::tearDown();
    }

    public function testAnalysesWithoutErrors(): void
    {
        $this->assertStringContainsString(
            '[OK] No errors',
            $this->analyze(__DIR__.'/project.neon'),
        );
    }

    public function testAnalysesWithAnError(): void
    {
        $this->assertStringContainsString(
            '22     Static call to instance method Carbon\Carbon::foo().',
            $this->analyze(__DIR__.'/bad-project.neon'),
        );
    }

    private function analyze(string $file): string
    {
        $output = shell_exec(implode(' ', [
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpstan']),
            'analyse',
            '--configuration='.escapeshellarg(realpath($file)),
            '--no-progress',
            '--no-interaction',
            '--level=0',
            escapeshellarg(realpath(__DIR__.'/Fixture.php')),
        ]));

        if (!\is_string($output)) {
            throw new RuntimeException('Executing phpstan returned '.var_export($output, true));
        }

        return $output;
    }
}
