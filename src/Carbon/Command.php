<?php

namespace Carbon;


class Command
{
    protected $colors = [
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'yellow' => '1;33',
    ];

    public function __construct(array $colors = null)
    {
        if ($colors) {
            $this->colors = $colors;
        }

        foreach ($this->colors as $name => $color) {
            echo $this->colorize($name, $color)."\n";
        }
    }

    protected function colorize($text, $color)
    {
        return "\033[${color}m$text\033[0m";
    }

    public function __invoke(...$parameters)
    {
        var_dump($parameters);
    }
}
