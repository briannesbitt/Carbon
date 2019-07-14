<?php

namespace Carbon\Cli;

class Invoker
{
    const CLI_CLASS_NAME = 'Carbon\\Cli';

    protected function runWithCli(string $className, array $parameters): bool
    {
        $cli = new $className();

        return $cli(...$parameters);
    }

    public function __invoke(...$parameters): bool
    {
        if (class_exists(self::CLI_CLASS_NAME)) {
            return $this->runWithCli(self::CLI_CLASS_NAME, $parameters);
        }

        shell_exec('composer require carbon-cli/carbon-cli --no-interaction');

        echo 'Installation succeeded.';

        return true;
    }
}
