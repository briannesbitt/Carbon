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

namespace Tests\Cli;

use Carbon\Cli;
use Carbon\Cli\Invoker;
use Tests\AbstractTestCase;

class InvokerTest extends AbstractTestCase
{
    public function testInvoke()
    {
        $invoker = new Invoker();
        $lastCommand = null;
        $exec = function ($command) use (&$lastCommand) {
            $lastCommand = $command;
        };

        ob_start();
        $return = $invoker('file', 'install', $exec);
        $contents = ob_get_contents();
        ob_end_clean();

        $this->assertSame('composer require carbon-cli/carbon-cli --no-interaction', $lastCommand);
        $this->assertSame('Installation succeeded.', $contents);
        $this->assertTrue($return);

        include_once __DIR__.'/Cli.php';

        $invoker = new Invoker();
        $lastCommand = null;

        ob_start();
        $return = $invoker('file', 'install', $exec);
        $contents = ob_get_contents();
        ob_end_clean();

        $this->assertNull($lastCommand);
        $this->assertSame('', $contents);
        $this->assertTrue($return);
        $this->assertSame(['file', 'install', $exec], Cli::$lastParameters);
    }
}
