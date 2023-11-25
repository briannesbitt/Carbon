<?php

namespace ApiHistory;

include_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

set_time_limit(0);
chdir(__DIR__.'/..');
$arguments = $argv ?? [];
$verbose = in_array('--verbose', $arguments, true);
$target = $arguments[1] ?? null;

function loadDependencies()
{
    try {
        require_once __DIR__.'/../vendor/autoload.php';
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

    foreach (@methods(false) as [$carbonObject, $className, $method, $parameters]) {
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

    $data = @json_encode($methods);

    if (json_last_error()) {
        $data = json_encode([
            'error' => json_last_error(),
            'message' => json_last_error_msg(),
        ]);
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

    return executeCommand("$path require --no-interaction --ignore-platform-reqs --prefer-dist nesbot/carbon:$branch$suffix");
}

foreach (methods() as [$carbonObject, $className, $method]) {
    $methods["$className::$method"] = [];
}

ksort($methods);

$count = count($versions);

function getMethodsOfVersion($version)
{
    $cache = __DIR__.'/cache/methods_of_version_'.$version.'.json';

    if (file_exists($cache)) {
        return file_get_contents($cache);
    }

    $branch = $version === MASTER_VERSION ? MASTER_BRANCH : $version;
    removeDirectory('sandbox');
    mkdir('sandbox');
    chdir('sandbox');
    $output = requireCarbon($branch);
    chdir('..');

    if (strpos($output, 'Installation failed') !== false) {
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
    $output = getMethodsOfVersion($version);
    $data = json_decode($output);

    if (!is_array($data) && !is_object($data)) {
        writeFile('temp2.txt', $output);
        echo "\nError on $version:\n$output\n";
        exit(1);
    }

    $data = (array) $data;

    if (isset($data['error'])) {
        writeFile('temp3.txt', var_export($data, true));
        echo "\nError on $version:\n";
        print_r($data);
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
