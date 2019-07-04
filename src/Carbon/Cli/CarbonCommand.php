<?php

namespace Carbon\Cli;

use Carbon\Cli\Command\Macro;

class CarbonCommand extends Command
{
    public function getCommands(): array {
        return [
            'macro' => Macro::class,
        ];
    }
}