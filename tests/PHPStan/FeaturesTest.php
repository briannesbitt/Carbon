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
        if ($this->analyze(__DIR__.'/Fixture.php') === 0) {
            $this->assertTrue(true);
        }
    }

    private function analyze(string $file)
    {
        $output = shell_exec(implode(' ', [
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpstan']),
            'analyse',
            '--configuration='.escapeshellarg(realpath(__DIR__.'/../../extension.neon')),
            '--no-progress',
            '--no-interaction',
            '--level=0',
            escapeshellarg(realpath($file)),
        ]));
        var_dump($output);

        return $output;
    }
}
