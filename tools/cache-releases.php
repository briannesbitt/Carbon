<?php

$releases = [];
$page = 0;

do {
    $page++;
    $ch = curl_init("https://api.github.com/repos/briannesbitt/Carbon/releases?page=$page");
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $data = json_decode(curl_exec($ch), JSON_OBJECT_AS_ARRAY);
    curl_close($ch);
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

file_put_contents(__DIR__.'/../releases.json', json_encode($releases, JSON_PRETTY_PRINT));
