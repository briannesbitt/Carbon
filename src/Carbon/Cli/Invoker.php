<?php

namespace Carbon\Cli;

class Invoker
{
    public function __invoke(...$parameters)
    {
        $className = \Carbon\Cli::class;

        if (class_exists($className)) {
            $cli = new $className();

            return $cli(...$parameters);
        }

        shell_exec('composer require carbon-cli/carbon-cli');
        shell_exec(__DIR__.'/../../../bin/carbon-completion.bash');

        $cli = new $className();
        $command = $parameters[1] ?? '';

        if ($command === 'install') {
            $cli->write('Installation succeeded.');

            return true;
        }

        return $cli(...$parameters);
    }
}
