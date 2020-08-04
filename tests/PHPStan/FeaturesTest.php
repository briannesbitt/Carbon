<?php

declare(strict_types=1);

namespace Tests\PHPStan;

use Tests\AbstractTestCase;

class FeaturesTest extends AbstractTestCase
{
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
        if (version_compare(PHP_VERSION, '8.0.0-dev', '>=')) {
            $this->markTestSkipped('PHPStan is not ready for PHP 8.');
        }

        $this->assertStringContainsString(
            '[OK] No errors',
            $this->analyze(__DIR__.'/Fixture.php')
        );
    }

    public function testAnalysesWithAnError(): void
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '>=')) {
            $this->markTestSkipped('PHPStan is not ready for PHP 8.');
        }

        $this->assertStringContainsString(
            '17     Static call to instance method Carbon\Carbon::foo().',
            $this->analyze(__DIR__.'/BadFixture.php')
        );
    }

    private function analyze(string $file)
    {
        return shell_exec(implode(' ', [
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpstan']),
            'analyse',
            '--configuration='.escapeshellarg(realpath(__DIR__.'/../../extension.neon')),
            '--no-progress',
            '--no-interaction',
            '--level=0',
            escapeshellarg(realpath($file)),
        ]));
    }
}
