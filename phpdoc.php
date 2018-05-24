<?php

$tags = [
    'property',
    'property-read',
    PHP_EOL,
    ['call', 'isSameUnit'],
    ['call', 'setUnit'],
    ['call', 'addUnit'],
    ['call', 'addRealUnit'],
];
$maxLength = max(array_map('strlen', array_map(function ($tag) {
    return is_array($tag) ? $tag[0] : $tag;
}, $tags)));
$autoDoc = '';
$carbon = __DIR__.'/src/Carbon/Carbon.php';
include_once $carbon;
$code = file_get_contents($carbon);

function pluralize($word)
{
    if (preg_match('/(millenni)um$/i', $word)) {
        return preg_replace('/(millenni)um$/i', '$1a', $word);
    }

    return preg_replace('/(centur)y$/i', '$1ie', $word).'s';
}

foreach ($tags as $tag) {
    if (is_array($tag)) {
        list($tag, $pattern) = $tag;
    }
    $pattern = isset($pattern) ? $pattern : '\S+';
    if ($tag === PHP_EOL) {
        $autoDoc .= "\n *";

        continue;
    }

    preg_match_all('/\/\/ @'.$tag.'\s+(?<type>'.$pattern.')(?:\s+\$(?<name>\S+)(?:[^\S\n](?<description>.*))?\n|(?:[^\S\n](?<description2>.*))?\n[^\']*\'(?<name2>[^\']+)\')/', $code, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $vars = (object) $match;
        $vars->name = $vars->name ?: $vars->name2;
        $vars->description = $vars->description ?: $vars->description2;
        if ($tag === 'call') {
            switch ($vars->type) {
                case 'isSameUnit':
                    $unit = $vars->name;
                    $method = 'isSame'.ucFirst($unit);
                    if (!method_exists(\Carbon\Carbon::class, $method)) {
                        $autoDoc .= "\n * @method bool $method".
                            '(\DateTimeInterface $date = null) '.
                            "Checks if the given date is in the same $unit as the instance. If null passed, compare to now (with the same timezone).";
                    }
                    $autoDoc .= "\n * @method bool isCurrent".
                        ucFirst($unit).'() '.
                        "Checks if the instance is in the same $unit as the current moment.";
                    break;
                case 'setUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDoc .= "\n * @method \$this $plUnit(int \$value) ".
                        "Set current instance $unit to the given value.";
                    $autoDoc .= "\n * @method \$this $unit(int \$value) ".
                        "Set current instance $unit to the given value.";
                    $autoDoc .= "\n * @method \$this set".
                        ucfirst($plUnit).'(int $value) '.
                        "Set current instance $unit to the given value.";
                    $autoDoc .= "\n * @method \$this set".
                        ucfirst($unit).'(int $value) '.
                        "Set current instance $unit to the given value.";
                    break;
                case 'addUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDoc .= "\n * @method \$this add".
                        ucFirst($plUnit).'(int $value = 1) '.
                        "Add $plUnit (the \$value count passed in) to the instance (using date interval).";
                    $autoDoc .= "\n * @method \$this add".
                        ucFirst($unit).'() '.
                        "Add one $unit to the instance (using date interval).";
                    $autoDoc .= "\n * @method \$this sub".
                        ucFirst($plUnit).'(int $value = 1) '.
                        "Sub $plUnit (the \$value count passed in) to the instance (using date interval).";
                    $autoDoc .= "\n * @method \$this sub".
                        ucFirst($unit).'() '.
                        "Sub one $unit to the instance (using date interval).";
                    if (in_array($unit, [
                        'month',
                        'quarter',
                        'year',
                        'decade',
                        'century',
                        'millennium',
                    ])) {
                        $autoDoc .= "\n * @method \$this add".
                            ucFirst($plUnit).'WithOverflow(int $value = 1) '.
                            "Add $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.";
                        $autoDoc .= "\n * @method \$this add".
                            ucFirst($unit).'WithOverflow() '.
                            "Add one $unit to the instance (using date interval) with overflow explicitly allowed.";
                        $autoDoc .= "\n * @method \$this sub".
                            ucFirst($plUnit).'WithOverflow(int $value = 1) '.
                            "Sub $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly allowed.";
                        $autoDoc .= "\n * @method \$this sub".
                            ucFirst($unit).'WithOverflow() '.
                            "Sub one $unit to the instance (using date interval) with overflow explicitly allowed.";
                        foreach (['WithoutOverflow', 'WithNoOverflow', 'NoOverflow'] as $alias) {
                            $autoDoc .= "\n * @method \$this add".
                                ucFirst($plUnit)."$alias(int \$value = 1) ".
                                "Add $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.";
                            $autoDoc .= "\n * @method \$this add".
                                ucFirst($unit)."$alias() ".
                                "Add one $unit to the instance (using date interval) with overflow explicitly forbidden.";
                            $autoDoc .= "\n * @method \$this sub".
                                ucFirst($plUnit)."$alias(int \$value = 1) ".
                                "Sub $plUnit (the \$value count passed in) to the instance (using date interval) with overflow explicitly forbidden.";
                            $autoDoc .= "\n * @method \$this sub".
                                ucFirst($unit)."$alias() ".
                                "Sub one $unit to the instance (using date interval) with overflow explicitly forbidden.";
                        }
                        break;
                    }
                    break;
                case 'addRealUnit':
                    $unit = $vars->name;
                    $plUnit = pluralize($unit);
                    $autoDoc .= "\n * @method \$this addReal".
                        ucFirst($plUnit).'(int $value = 1) '.
                        "Add $plUnit (the \$value count passed in) to the instance (using timestamp).";
                    $autoDoc .= "\n * @method \$this addReal".
                        ucFirst($unit).'() '.
                        "Add one $unit to the instance (using timestamp).";
                    $autoDoc .= "\n * @method \$this subReal".
                        ucFirst($plUnit).'(int $value = 1) '.
                        "Sub $plUnit (the \$value count passed in) to the instance (using timestamp).";
                    $autoDoc .= "\n * @method \$this subReal".
                        ucFirst($unit).'() '.
                        "Sub one $unit to the instance (using timestamp).";
                    break;
            }

            continue;
        }

        $description = trim($vars->description);
        $variable = $vars->name;
        if (substr($description, 0, 1) === '$') {
            list($variable, $description) = explode(' ', $description, 2);
            $variable = ltrim($variable, '$');
            $description = ltrim($description);
        }
        $description = empty($description) ? '' : " $description";
        $autoDoc .= "\n * @".
            str_pad($tag, $maxLength + 1, ' ', STR_PAD_RIGHT).
            $vars->type.' $'.
            $variable.$description;
    }
}
$doc = "/**
 * A simple API extension for DateTime.
 *$autoDoc
 */";

file_put_contents($carbon, preg_replace_callback('/^\/\*\*\n[\s\S]*\*\//mU', function () use ($doc) {
    return $doc;
}, $code, 1));
