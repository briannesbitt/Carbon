<?php

$tags = [
    'property',
    'property-read',
    PHP_EOL,
    'call',
];
$maxLength = max(array_map('strlen', $tags));
$autoDoc = '';
$carbon = __DIR__.'/src/Carbon/Carbon.php';
$code = file_get_contents($carbon);
foreach ($tags as $tag) {
    if ($tag === PHP_EOL) {
        $autoDoc .= "\n *";

        continue;
    }

    preg_match_all('/\/\/ @'.preg_quote($tag, '/').'\s+(\S+)(?:[^\S\n](.*))?\n[^\']*\'([^\']+)\'/', $code, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        if ($tag === 'call') {
            if ($match[1] === 'isSameUnit') {
                $unit = $match[3];
                $autoDoc .= "\n * @method bool isSame".
                    ucFirst($unit)."(\DateTimeInterface \$date = Carbon::now()) ".
                    "Checks if the passed in date is in the same $unit as the instance.";
            }

            continue;
        }

        $autoDoc .= "\n * @".
            str_pad($tag, $maxLength + 1, ' ', STR_PAD_RIGHT).
            $match[1].' $'.
            $match[3].(empty($match[2]) ? '' : ' '.$match[2]);
    }
}
$doc = "/**
 * A simple API extension for DateTime.
 *$autoDoc
 */";

file_put_contents($carbon, preg_replace_callback('/^\/\*\*\n[\s\S]*\*\//mU', function () use ($doc) {
    return $doc;
}, $code, 1));
