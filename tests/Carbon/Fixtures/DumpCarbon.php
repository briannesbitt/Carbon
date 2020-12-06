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
namespace Tests\Carbon\Fixtures;

use Carbon\Carbon;
use Exception;

final class DumpCarbon extends Carbon
{
    private $dump;

    private $formatBroken = false;

    public function __construct($time = null, $tz = null)
    {
        ob_start();
        var_dump($this);
        $this->dump = ob_get_contents() ?: '';
        ob_end_clean();

        parent::__construct($time, $tz);
    }

    public function getDump(): string
    {
        return $this->dump;
    }

    public function breakFormat(): void
    {
        $this->formatBroken = true;
    }

    public function format($format)
    {
        if ($this->formatBroken) {
            throw new Exception('Broken');
        }

        return parent::format($format);
    }
}
