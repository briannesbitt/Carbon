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

    protected $lastText = '';

    protected $currentCompletion = null;

    public function __construct(array $colors = null)
    {
        if ($colors) {
            $this->colors = $colors;
        }

        if (extension_loaded('readline') && function_exists('readline_completion_function')) {
            readline_completion_function([$this, 'autocomplete']);
        }
    }

    public function autocomplete(string $start = '')
    {
        if (is_array($this->currentCompletion)) {
            $length = strlen($start);

            return array_filter($this->currentCompletion, function ($suggestion) use ($length, $start) {
                return substr($suggestion, 0, $length) === $start;
            });
        }

        return $this->currentCompletion ? $this->currentCompletion($start) : [];
    }

    protected function colorize(string $text = '', string $color = null)
    {
        return "\033[${color}m$text\033[0m";
    }

    public function read($prompt, $completion = null)
    {
        $this->currentCompletion = $completion;

        return readline($prompt);
    }

    public function rewind(int $length = null): void
    {
        if ($length === null) {
            $length = strlen($this->lastText);
        }

        echo "\033[${length}D";
    }

    public function write(string $text = '', string $color = null): void
    {
        $this->lastText = $text;

        if ($color) {
            $text = $this->colorize($text, $color);
        }

        echo $text;
    }

    public function writeLine(string $text = '', string $color = null): void
    {
        $this->write("$text\n", $color);
    }

    public function rewrite(string $text = '', string $color = null): void
    {
        $this->rewind();
        $this->write($text, $color);
    }

    public function rewriteLine(string $text = '', string $color = null): void
    {
        $this->write("\r$text", $color);
    }

    public function __invoke(...$parameters)
    {
        var_dump($parameters);
    }
}
