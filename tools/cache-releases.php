<?php

$releases = [];
$page = 0;

do {
    $page++;
    $ch = curl_init("https://api.github.com/repos/briannesbitt/Carbon/releases?page=$page");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $env = [];
    $envFile = __DIR__ . '/../.env';

    foreach (file_exists($envFile) ? file($envFile) : [] as $line) {
        [$key, $value] = array_pad(explode('=', trim($line), 2), 2, null);
        $env[$key] = $value;
    }

    if (isset($env['GITHUB_TOKEN'])) {
        curl_setopt($ch, CURLOPT_HEADER, 'Authorization: Bearer ' . $env['GITHUB_TOKEN']);
    }

    $json = curl_exec($ch);
    $data = json_decode($json, true);
    curl_close($ch);

    if (!(is_array($data) && array_is_list($data))) {
        echo 'Error (strlen = '.strlen($json).")\n";
        echo "$json\n";
        exit(1);
    }

    foreach ($data as $release) {
        $properties = [
            'tag_name' => $release['tag_name'],
            'created_at' => $release['created_at'],
            'body' => $release['tag_name'],
        ];

        if (isset($release['assets'], $release['assets'][0], $release['assets'][0]['asset_url'])) {
            $properties['asset_url'] = $release['assets'][0]['asset_url'];
        }

        $releases[] = $properties;
    }
} while (count($data));

require_once __DIR__.'/functions.php';

writeJson('releases.json', $releases);
