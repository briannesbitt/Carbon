<?php

$releases = json_decode(file_get_contents(__DIR__.'/../releases.json'));

$composer = file_get_contents(__DIR__.'/../composer.json');

$regExp = '/"nesbot\/carbon":\s*"[^"]+"/';

if (!preg_match($regExp, $composer)) {
    echo "nesbot/carbon not found in composer.json.\n";
    exit(1);
}

$newComposer = preg_replace(
    $regExp,
    '"nesbot/carbon": "dev-master as '.$releases[0]->tag_name.'"',
    $composer
);

echo $newComposer === $composer
    ? 'nesbot/carbon is already on '
    : 'Upgraded nesbot/carbon to ';

echo $releases[0]->tag_name.".\n";

exit(0);
