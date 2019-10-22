<?php

declare(strict_types=1);

namespace Tests;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Output\BufferedOutput;

class PHPStanTest extends AbstractTestCase
{
    public function testAnalysesWithoutErrors(): void
    {
        if ($this->analyze(__DIR__ . '/Fixture.php') === 0) {
            $this->assertTrue(true);
        }
    }

    private function analyze(string $file)
    {
        $output =  shell_exec(
            'vendor/bin/phpstan'
            . ' --configuration ' . __DIR__ . '/../../extension.neon'
            . ' --no-progress'
            . ' --no-interaction'
            . ' ' . $file
        );

        return $output;
    }
}
