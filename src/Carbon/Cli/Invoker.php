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

        shell_exec('composer require carbon-cli/carbon-cli --no-interaction');

        echo 'Installation succeeded.';

        return true;
    }
}
