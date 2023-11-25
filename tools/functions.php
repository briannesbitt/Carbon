<?php

function writeFileAtPath(string $path, string $content): bool
{
    return file_put_contents($path, str_replace("\r", '', $content)) > 0;
}

function writeFile(string $path, string $content): bool
{
    return writeFileAtPath(__DIR__ . '/../' . $path, $content);
}

function writeJson(string $path, mixed $data): bool
{
    return writeFile($path, json_encode($data, JSON_PRETTY_PRINT));
}
