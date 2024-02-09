<?php

namespace ApiHistory;

use Throwable;

include_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

set_time_limit(0);
chdir(__DIR__.'/..');
$arguments = $argv ?? [];
// $arguments = ['tools/api-history.php', 'current', 'sandbox'];
$verbose = in_array('--verbose', $arguments, true);
$target = $arguments[1] ?? null;

function loadDependencies()
{
    try {
        // Use relative path to follow chdir() location
        $autoload = file_exists('vendor/autoload.php')
            ? 'vendor/autoload.php'
            : __DIR__.'/../vendor/autoload.php';
        require_once $autoload;
        require_once __DIR__.'/methods.php';
    } catch (\Throwable $e) {
        echo "Catch\n";
        echo getcwd() . "\n";
        echo $e->getMessage();
        echo realpath('vendor/autoload.php') . "\n\n";
        exit((new \Exception())->getTraceAsString());
    }
}

function nameAlias($name)
{
    return [
        'dt' => 'date',
        'abs' => 'absolute',
    ][$name] ?? $name;
}

$methods = [];

if ($target === 'current') {
    $sandbox = $arguments[2] ?? null;

    if ($sandbox) {
        chdir($sandbox);
    }

    error_reporting(E_ERROR | E_PARSE);

    loadDependencies();

    try {
        foreach (methods(false) as [$carbonObject, $className, $method, $parameters]) {
            if ($parameters === null) {
                $parameters = [];

                foreach ((new \ReflectionMethod($carbonObject, $method))->getParameters() as $parameter) {
                    $defaultValue = '';
                    $type = '';

                    if ($hint = @$parameter->getType()) {
                        $type = ltrim($hint, '\\').' ';
                    }

                    try {
                        if ($parameter->isDefaultValueAvailable()) {
                            $defaultValue .= ' = '.convertType(var_export($parameter->getDefaultValue(), true));
                        }
                    } catch (\Throwable $e) {
                    }

                    $parameters[] = $type.'$'.nameAlias($parameter->getName()).$defaultValue;
                }
            }
            $methods["$className::$method"] = $parameters;
        }
    } catch (Throwable $exception) {
        $methods = [
            'error' => $exception::class,
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line'=> $exception->getLine(),
            'trace'=> $exception->getTrace(),
        ];
    }

    if (json_last_error()) {
        $methods = [
            'error' => json_last_error(),
            'message' => json_last_error_msg(),
        ];
    }

    $data = \is_array($methods) ? @json_encode($methods) : null;

    if (!\is_string($data) || \strlen($data) < 24) {
        var_dump($methods);
        exit;
    }

    echo $data;

    exit;
}

loadDependencies();

$versions = array_filter(array_map(function ($version) {
    return $version === MASTER_BRANCH ? MASTER_VERSION : $version;
}, array_keys(json_decode(file_get_contents('https://packagist.org/p/nesbot/carbon.json'), true)['packages']['nesbot/carbon'])), function ($version) {
    return !preg_match('/(dev-|-beta|-alpha|-dev)/', $version) && !in_array($version, BLACKLIST);
});

usort($versions, 'version_compare');

function executeCommand($command)
{
    $output = '';
    $handle = popen($command, 'r');

    while ($chunk = fread($handle, 2096)) {
        $output .= $chunk;
    }

    pclose($handle);

    return $output;
}

function removeDirectory($dir)
{
    if (!is_dir($dir)) {
        return true;
    }

    foreach (scandir($dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $path = $dir.'/'.$file;

            if (is_dir($path)) {
                removeDirectory($path);

                continue;
            }

            unlink($path);
        }
    }

    return rmdir($dir);
}

function requireCarbon($branch)
{
    global $verbose;

    @unlink('composer.lock');

    if (!removeDirectory('vendor')) {
        throw new \ErrorException('Cannot remove vendor directory.');
    }

    $path = realpath(__DIR__.'/../composer.phar');
    $path = $path ? 'php '.$path : 'composer';
    $suffix = $verbose ? '' : ' 2>&1';

    $result = executeCommand("$path require --no-interaction --ignore-platform-reqs --prefer-dist nesbot/carbon:$branch$suffix");

    $files = [
        'vendor/nesbot/carbon/src/Carbon/Traits/Creator.php' => [
            'function setLastErrors(array $lastErrors)' =>
                'function setLastErrors(array|false $lastErrors)',
        ],
        'vendor/nesbot/carbon/src/Carbon/CarbonPeriod.php' => [
            'return $this->toArray();' =>
                'return [static::class];',
        ],
    ];

    foreach ($files as $file => $replacements) {
        $contents = @file_get_contents($file);

        if ($contents) {
            $newContents = strtr($contents, $replacements);

            if ($contents !== $newContents) {
                file_put_contents($file, $newContents);
            }
        }
    }

    return $result;
}

foreach (methods() as [$carbonObject, $className, $method]) {
    $methods["$className::$method"] = [];
}

ksort($methods);

$count = count($versions);

function getMethodsOfVersion($version, bool $forceRebuild = false)
{
    $cache = __DIR__.'/cache/methods_of_version_'.$version.'.json';

    if (!$forceRebuild && file_exists($cache)) {
        return file_get_contents($cache);
    }

    $branch = $version === MASTER_VERSION ? MASTER_BRANCH : $version;
    removeDirectory('sandbox');
    mkdir('sandbox');
    chdir('sandbox');
    $output = requireCarbon($branch);
    chdir('..');

    if (str_contains($output, 'Installation failed')) {
        writeFile('temp.txt', $output);
        echo "\nError on $version:\n$output\n";
        exit(1);
    }

    $output = shell_exec('php '.__FILE__.' current '.escapeshellarg('sandbox'));

    if (!empty($output)) {
        writeFile('tools/cache/methods_of_version_'.$version.'.json', $output);
    }

    return $output;
}

foreach (array_reverse($versions) as $index => $version) {
    echo round($index * 100 / $count)."% $version\n";

    foreach ([false, true] as $forceRebuild) {
        $output = getMethodsOfVersion($version, $forceRebuild);
        $data = @json_decode($output, true);
        $decodable = is_array($data);
        $error = $decodable ? ($data['error'] ?? null) : ($output ?? 'Missing output');

        if ($error === null) {
            break;
        }
    }

    if ($error !== null) {
        $display = ($decodable ? var_export($data, true) : $output)
            ?? json_encode($error, JSON_PRETTY_PRINT);
        writeFile('temp2.txt', $display);
        echo "\nError on $version:\n$display";
        exit(1);
    }

    foreach ($data as $method => $parameters) {
        $methods[$method][$version] = $parameters;
    }
}

echo "100%\nDumping results.\n";

writeJson('history.json', $methods);

echo "Done\n";

exit;
