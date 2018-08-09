<?php

namespace ApiHistory;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use Carbon\Laravel\ServiceProvider;

const MASTER_BRANCH = 'dev-master';
const MASTER_VERSION = '2.0.0';

$arguments = $argv ?? [];
$target = $arguments[1] ?? null;

require 'vendor/autoload.php';
require 'tools/methods.php';

$methods = [];

if ($target === 'current') {
    foreach (@methods() as list($carbonObject, $className, $method, $parameters)) {
        if ($parameters === null) {
            $parameters = [];
            foreach ((new \ReflectionMethod($carbonObject, $method))->getParameters() as $parameter) {
                $defaultValue = '';
                $type = '';
                if ($hint = @$parameter->getType()) {
                    $type = ' '.$hint;
                }
                try {
                    if ($value = $parameter->getDefaultValue()) {
                        $defaultValue .= ' = '.var_export($value, true);
                    }
                } catch (\Throwable $e) {
                }
                $parameters[] = $type.$parameter->getName().$defaultValue;
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

foreach (methods() as list($carbonObject, $className, $method, $parameters)) {
    $methods["$className::$method"] = [];
}

ksort($methods);

$versions = array_filter(array_map(function ($version) {
    return $version === MASTER_BRANCH ? MASTER_VERSION : $version;
}, array_keys(json_decode(file_get_contents('https://packagist.org/p/nesbot/carbon.json'), true)['packages']['nesbot/carbon'])), function ($version) {
    return !preg_match('/(dev-|-beta|-alpha)/', $version);
});

usort($versions, 'version_compare');

$classes = [
    Carbon::class,
    CarbonInterval::class,
    CarbonPeriod::class,
    CarbonTimeZone::class,
    ServiceProvider::class,
];

foreach (array_reverse($versions) as $version) {
    $branch = $version === MASTER_VERSION ? MASTER_BRANCH : $version;
    system("composer require --ignore-platform-reqs nesbot/carbon:$branch");
    $out = shell_exec('php '.__FILE__.' current');
    $data = json_decode($out);
    if (!is_array($data) && !is_object($data)) {
        var_dump($version, $data);
        exit;
    }
    $data = (array) $data;
    if (isset($data['error'])) {
        var_dump($version, $data);
        exit;
    }
    foreach ($data as $method => $parameters) {
        $methods[$method][$version] = $parameters;
    }
}

system('composer require nesbot/carbon:'.MASTER_BRANCH);

file_put_contents('history.json', json_encode($methods, JSON_PRETTY_PRINT));

exit;
