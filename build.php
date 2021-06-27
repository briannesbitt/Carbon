<?php

chdir(__DIR__);
$currentBranch = 'master';
if (preg_match('/On branch ([^\n]+)\n/', shell_exec('git status'), $match)) {
    $currentBranch = $match[1];
}
shell_exec('git fetch --all --tags --prune');
$remotes = explode("\n", trim(shell_exec('git remote')));
$tagsCommand = \count($remotes)
    ? 'git ls-remote --tags '.(\in_array('upstream', $remotes) ? 'upstream' : (\in_array('origin', $remotes) ? 'origin' : $remotes[0]))
    : 'git tag';
$tags = array_map(function ($ref) {
    $ref = explode('refs/tags/', $ref);

    return isset($ref[1]) ? $ref[1] : $ref[0];
}, array_filter(explode("\n", trim(shell_exec($tagsCommand))), function ($ref) {
    return substr($ref, -3) !== '^{}';
}));
usort($tags, 'version_compare');

$tag = isset($argv[1]) && !\in_array($argv[1], ['last', 'latest']) ? $argv[1] : end($tags);

if (strtolower($tag) !== 'all') {
    if (!\in_array($tag, $tags)) {
        echo "Tag must be one of remote tags available:\n";
        foreach ($tags as $_tag) {
            echo "  - $_tag\n";
        }
        echo "\"$tag\" does not match.\n";

        exit(1);
    }

    $tags = [$tag];
}

foreach ($tags as $tag) {
    $archive = "Carbon-$tag.zip";
    if (isset($argv[2]) && $argv[2] === 'missing' && file_exists($archive)) {
        continue;
    }

    $branch = "build-$tag";
    shell_exec('git stash');
    shell_exec("git branch -d $branch");
    shell_exec("git checkout tags/$tag -b $branch");
    $phpVersion = version_compare($tag, '2.0.0-dev', '<') ? '5.3.9' : '7.1.8';
    shell_exec("composer config platform.php $phpVersion");
    shell_exec('composer remove friendsofphp/php-cs-fixer --dev');
    shell_exec('composer remove kylekatarnls/multi-tester --dev');
    shell_exec('composer remove phpmd/phpmd --dev');
    shell_exec('composer remove phpstan/phpstan --dev');
    shell_exec('composer remove phpunit/phpunit --dev');
    shell_exec('composer remove squizlabs/php_codesniffer --dev');
    shell_exec('composer update --no-interaction --no-dev --optimize-autoloader');
    $zip = new ZipArchive();

    $zip->open($archive, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    foreach (['src', 'vendor', 'Carbon'] as $directory) {
        if (is_dir($directory)) {
            $directory = realpath($directory);
            $base = \dirname($directory);

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();

                    $zip->addFile($filePath, substr($filePath, \strlen($base) + 1));
                }
            }
        }
    }

    $autoload = 'autoload.php';
    file_put_contents($autoload, "<?php\n\n/**\n * @version $tag\n */\n\nrequire __DIR__.'/vendor/autoload.php';\n");
    $zip->addFile($autoload, $autoload);
    $zip->close();
    unlink($autoload);

    shell_exec('git checkout .');
    shell_exec("git checkout $currentBranch");
    shell_exec("git branch -d $branch");
    shell_exec('git stash pop');
    shell_exec('composer config platform.php 7.1.8');
    shell_exec('composer update --no-interaction');
}

exit(0);
