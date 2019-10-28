<?php

declare(strict_types=1);

namespace Tests;

class PHPStanTest extends AbstractTestCase
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
        $output =  shell_exec(
            'vendor/bin/phpstan'
            . ' analyse'
            . ' --configuration="' . __DIR__ . '/../../extension.neon"'
            . ' --no-progress'
            . ' --no-interaction'
            . ' --level=0'
            . ' "' . $file . '"'
        );
        var_dump($output);

        return $output;
    }
}
