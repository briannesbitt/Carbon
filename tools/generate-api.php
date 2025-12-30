<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use Carbon\FactoryImmutable;
use Carbon\Language;
use Carbon\Translator;
use Cmixin\BusinessTime;
use Cmixin\SeasonMixin;
use phpDocumentor\Reflection\DocBlockFactory;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

use function Carbon\Doc\Methods\methods;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/methods.php';

$destination_file = __DIR__.'/../docs/develop/reference.md';

trait MacroExposer
{
    public function getMacros()
    {
        $class = get_called_class();

        return $class::$global_macros ?? FactoryImmutable::getDefaultInstance()->getSettings()['macros'];
    }
}

class BusinessTimeCarbon extends Carbon
{
    use MacroExposer;
}

function history_line($event, $version, $ref): array
{
    $ref = empty($ref) ? '*no arguments*' : "`$ref`";

    return [$event, $version, $ref];
}

function table_markdown(array $table, ?array $header = null): string
{
    $table = array_map(
        static fn (array $row) => array_map(
            static fn (string $cell) => str_replace('|', '\\|', $cell),
            $row,
        ),
        $table,
    );
    $header ??= array_fill(0, count($table[0]), '');
    $sizes = array_map(
        static fn (int $index) => max(array_map(strlen(...), [$header[$index], ...array_column($table, $index)])),
        array_keys($table[0]),
    );

    return implode("\n", array_map(
        static fn (array $row) => '|'.(str_starts_with($row[0], '--') ? ':' : ' ').implode(' | ', array_map(
            static fn (string $cell, int $size) => str_pad($cell, $size),
            $row,
            $sizes,
        )).' |',
        [
            $header,
            array_map(static fn (int $size) => str_repeat('-', $size), $sizes),
            ...$table,
        ],
    ));
}

function get_classes(): Generator
{
    if (class_exists(Carbon::class)) {
        yield [
            new Carbon(),
            new DateTime(),
        ];

        if (class_exists(BusinessTime::class)) {
            yield [
                BusinessTime::enable(BusinessTimeCarbon::class),
                new Carbon(),
                Carbon::class,
                'Requires <a href="https://github.com/kylekatarnls/business-time">cmixin/business-time</a>',
                new BusinessTimeCarbon(),
            ];
        }

        if (trait_exists(SeasonMixin::class)) {
            BusinessTimeCarbon::mixin(SeasonMixin::class);

            yield [
                new BusinessTimeCarbon(),
                new Carbon(),
                Carbon::class,
                'Requires <a href="https://github.com/kylekatarnls/season">cmixin/season</a>',
                new class() extends BusinessTimeCarbon {
                    use SeasonMixin;
                },
                SeasonMixin::class,
            ];
        }
    }

    if (class_exists(CarbonInterval::class)) {
        yield [
            new CarbonInterval(0, 0, 0, 1),
            new DateInterval('P1D'),
        ];
    }

    if (class_exists(CarbonPeriod::class)) {
        yield [
            new CarbonPeriod(),
            new stdClass(),
        ];
    }

    if (class_exists(CarbonTimeZone::class)) {
        yield [
            new CarbonTimeZone('Europe/Paris'),
            new DateTimeZone('Europe/Paris'),
        ];
    }

    if (class_exists(Translator::class)) {
        yield [
            new Translator('en'),
            new SymfonyTranslator('en'),
        ];
    }

    if (class_exists(Language::class)) {
        yield [
            new Language('en'),
            new stdClass(),
        ];
    }
}

function get_doc_blocks(): array
{
    $docblocks = [];
    $factory = DocBlockFactory::createInstance();
    $classes = [];

    /**
     * @var string $class_name
     * @var string $method
     */
    foreach (methods(false, false) as [$carbon_object, $class_name, $method, $parameters, $return, $description, $dateTimeObject, $info]) {
        $classes[$class_name] ??= new ReflectionClass($class_name);

        $name = $classes[$class_name]->getShortName().'::'.$method;

        try {
            $doc_comment = $classes[$class_name]->getMethod($method)->getDocComment();
        } catch (ReflectionException) {
            $doc_comment = null;
        }

        $docblocks[$name] = $doc_comment
            ? $factory->create($doc_comment)
            : [$description, $parameters, $return, $info];
    }

    // sort
    ksort($docblocks);

    return $docblocks;
}

$markdown = "# Reference\n\n";
$global_history = @json_decode(file_get_contents('history.json'), true);

foreach (get_doc_blocks() as $name => $docblock) {
    $markdown .= "#### $name\n\n";

    if (is_array($docblock)) {
        [$description, $parameters, $return, $info] = $docblock;

        if (!$description) {
            continue;
        }

        $description = strtr($description, ['$open' => '`$open`']);
        $markdown .= "$description\n\n";

        if ($info) {
            $info = strtr($info, ["\n" => "\n> "]);
            $markdown .= "> [!NOTE]\n> $info\n\n";
        }

        if (($parameters ?? []) !== []) {
            $markdown .= "##### Parameters\n";

            foreach ($parameters as $parameter) {
                $markdown .= "- `$parameter`\n";
            }

            $markdown .= "\n";
        }

        if ($return) {
            $markdown .= "returns `$return`\n\n";
        }

        continue;
    }

    foreach ([$docblock->getSummary(), (string) $docblock->getDescription()] as $block) {
        if ($block !== '') {
            $markdown .= "$block\n\n";
        }
    }

    $deprecated = $docblock->getTagsByName('deprecated');

    foreach ($deprecated as $tag) {
        $markdown .= "::: warning Deprectated \n$tag\n:::\n";
    }

    $parameters = $docblock->getTagsByName('param');

    if ($parameters !== []) {
        $markdown .= "##### Parameters\n";

        foreach ($parameters as $tag) {
            $markdown .= "- \${$tag->getVariableName()} `{$tag->getType()}`";
            $description = trim($tag->getDescription());

            // if description is multiline, indent lines
            $description = str_contains($description, "\n")
                ? "\n  ".str_replace("\n", "\n  ", $description)
                : " $description";
            $markdown .= "$description\n";
        }

        $markdown .= "\n";
    }

    $return = $docblock->getTagsByName('return');

    foreach ($return as $tag) {
        $markdown .= "returns `$tag`\n\n";
    }

    $examples = $docblock->getTagsByName('example');

    if ($examples !== []) {
        $markdown .= "##### Examples\n";

        foreach ($examples as $tag) {
            $value = trim($tag->__toString());

            // add ```php` if not specified
            $markdown .= preg_replace('/^```(?!\w)/m', '```php', $value, 1)."\n";
        }

        $markdown .= "\n";
    }

    $history = [];
    [$class_name, $method] = explode('::', $name);
    $fqcn = 'Carbon\\'.$class_name;

    $key = class_exists($fqcn) ? "$fqcn::$method" : $name;
    $parameters = implode(', ', $parameters ?: []);

    if (is_array($global_history) && isset($global_history[$key])) {
        $ref = implode(', ', reset($global_history[$key]) ?: ['']);
        $parameters = $ref;
        $version = key($global_history[$key]);

        while (($prototype = next($global_history[$key])) !== false) {
            $prototype = implode(', ', $prototype);

            if ($prototype !== $ref) {
                $history[] = history_line('Prototype changed', $version, $ref);
                $ref = $prototype;
            }

            $version = key($global_history[$key]);
        }

        $history[] = history_line('Method added', $version, $ref);
    }

    if ($history !== []) {
        $markdown .= table_markdown($history, ['History', 'Version', 'Description'])."\n\n";
    }

    $markdown .= "----------\n\n";
}

file_put_contents($destination_file, $markdown);
