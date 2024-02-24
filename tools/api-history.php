<?php

declare(strict_types=1);

namespace Carbon\Doc\ApiHistory;

use Carbon\CarbonInterface;
use ErrorException;
use Exception;
use ReflectionMethod;
use Throwable;

use function Carbon\Doc\Functions\writeFile;
use function Carbon\Doc\Functions\writeJson;
use function Carbon\Doc\Methods\convertType;
use function Carbon\Doc\Methods\methods;

use const Carbon\Doc\Config\BLACKLIST;
use const Carbon\Doc\Config\MASTER_BRANCH;

include_once __DIR__.'/config.php';
require_once __DIR__.'/functions.php';

set_time_limit(0);
chdir(__DIR__.'/..');
$arguments = $argv ?? [];
// $verbose = in_array('--verbose', $arguments, true);
$target = $arguments[1] ?? null;

function loadDependencies($baseDir = null): void
{
    $autoload = rtrim($baseDir ?: __DIR__.'/..', '\\/').'/vendor/autoload.php';

    try {
        require_once $autoload;
        require_once __DIR__.'/methods.php';
    } catch (Throwable $e) {
        echo "Catch\n";
        echo getcwd()."\n";
        echo $e->getMessage();
        echo realpath($autoload)."\n\n";
        echo (new Exception())->getTraceAsString();
        exit(1);
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

    error_reporting(E_ALL ^ (E_USER_DEPRECATED | E_DEPRECATED));

    loadDependencies($sandbox);

    try {
        /**
         * @var CarbonInterface               $carbonObject
         * @var class-string<CarbonInterface> $className
         * @var string                        $method
         * @var ?array                        $parameters
         */
        foreach (methods(false) as [$carbonObject, $className, $method, $parameters]) {
            if ($parameters === null) {
                $parameters = [];

                foreach ((new ReflectionMethod($carbonObject, $method))->getParameters() as $parameter) {
                    $defaultValue = '';
                    $type = '';

                    if ($hint = @$parameter->getType()) {
                        $type = ltrim((string) $hint, '\\').' ';
                    }

                    try {
                        if ($parameter->isDefaultValueAvailable()) {
                            $defaultValue .= ' = '.convertType(var_export($parameter->getDefaultValue(), true));
                        }
                    } catch (Throwable) {
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
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
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

function executeCommand($command): string
{
    $output = '';
    $handle = popen($command, 'r');

    while ($chunk = fread($handle, 2096)) {
        $output .= $chunk;
    }

    pclose($handle);

    return $output;
}

function removeDirectory($dir): bool
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

function requireCarbon($branch): string
{
    global $verbose;

    @unlink('composer.lock');

    if (!removeDirectory('vendor')) {
        throw new ErrorException('Cannot remove vendor directory.');
    }

    $path = realpath(__DIR__.'/../composer.phar');
    $path = $path ? 'php '.$path : 'composer';
    $suffix = $verbose ? '' : ' 2>&1';

    $result = executeCommand("$path require --no-plugins --no-interaction --ignore-platform-reqs --prefer-dist nesbot/carbon:$branch$suffix");

    $files = [
        'vendor/nesbot/carbon/src/Carbon/Carbon.php' => [
            'function setLastErrors(array $lastErrors)' =>
                'function setLastErrors(array|false $lastErrors)',
        ],
        'vendor/nesbot/carbon/src/Carbon/Traits/Creator.php' => [
            'function setLastErrors(array $lastErrors)' =>
                'function setLastErrors(array|false $lastErrors)',
        ],
        'vendor/nesbot/carbon/src/Carbon/CarbonPeriod.php' => [
            'return $this->toArray();' =>
                'return [static::class];',
        ],
        'vendor/nesbot/carbon/src/Carbon/CarbonInterface.php' => [
            'public function modify($modify);' =>
                '// public function modify($modify);',
            'public function setDate($year, $month, $day);' =>
                '// public function setDate($year, $month, $day);',
            'public function setISODate($year, $week, $day = 1);' =>
                '// public function setISODate($year, $week, $day = 1);',
            'public function setISODate($year, $week, $day);' =>
                '// public function setISODate($year, $week, $day);',
            'public function setTime($hour, $minute, $second = 0, $microseconds = 0);' =>
                '// public function setTime($hour, $minute, $second = 0, $microseconds = 0);',
            'public function setTime($hour, $minute, $second, $microseconds);' =>
                '// public function setTime($hour, $minute, $second, $microseconds);',
            'public function setTimestamp($unixtimestamp);' =>
                '// public function setTimestamp($unixtimestamp);',
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
    $baseDir = dirname(__DIR__);
    $sandboxDir = $baseDir . DIRECTORY_SEPARATOR . 'sandbox';
    removeDirectory($sandboxDir);
    mkdir($sandboxDir);
    chdir($sandboxDir);
    $output = requireCarbon($branch);
    chdir($baseDir);

    if (!file_exists($sandboxDir.'/vendor/autoload.php') || str_contains($output, 'Installation failed')) {
        writeFile('temp.txt', $output);
        echo "\nError on $version:\n$output\n";
        exit(1);
    }

    $output = shell_exec('php '.__FILE__.' current '.escapeshellarg($sandboxDir));

    if (!empty($output)) {
        writeFile('tools/cache/methods_of_version_'.$version.'.json', $output);
    }

    return $output;
}

foreach (array_reverse($versions) as $index => $version) {
    if (preg_match('/^\d+\.\d+\.\d+-/', $version)) {
        // Skip pre-releases
        continue;
    }

    echo round($index * 100 / $count)."% $version\n";

    foreach ([false, true] as $forceRebuild) {
        $output = getMethodsOfVersion($version, $forceRebuild);
        $data = is_string($output) ? @json_decode($output, true) : null;
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
