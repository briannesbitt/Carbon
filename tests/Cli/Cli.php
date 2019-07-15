<?php

namespace Carbon;

class Cli
{
    public static $lastParameters = [];

    public function __invoke(...$parameters)
    {
        static::$lastParameters = $parameters;

        return true;
    }
}
