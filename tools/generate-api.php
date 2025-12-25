<?php
require __DIR__ . '/../vendor/autoload.php';

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

$destination_file = __DIR__ . '/../docs/develop/reference.md';
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
				new class() extends BusinessTimeCarbon
				{
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

$docblocks = [];
$factory = DocBlockFactory::createInstance();

foreach (get_classes() as $data) {
	[$carbon_object, $date_time_object, $class_name, $info, $invoke, $trait_name] = array_pad($data, 6, null);
	$class_name = $class_name ?: get_class($carbon_object);
	$date_time_methods = get_class_methods($date_time_object);
	$reflection = new ReflectionClass($class_name);
	$methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

	foreach ($methods as $method) {
		$name = $reflection->getShortName() . '::' . $method->getName();
		$doc_comment = $method->getDocComment();
		if (!$doc_comment) {
			continue;
		}
		$docblock = $factory->create($doc_comment);
		$docblocks[$name] = $docblock;
	}
}

// sort
ksort($docblocks);

$markdown = "# Reference\n";
foreach ($docblocks as $name => $docblock) {
	$markdown .= "#### $name\n\n";
	$markdown .= $docblock->getSummary() . "\n\n";
	$markdown .= $docblock->getDescription() . "\n";

	$deprecated = $docblock->getTagsByName('deprecated');

    foreach ($deprecated as $tag) {
        $markdown .= "::: warning Deprectated \n$tag\n:::\n";
    }

	$params = $docblock->getTagsByName('param');

	if ($params !== []) {
		$markdown .= "##### Parameters\n";
		foreach ($params as $tag) {
			$markdown .= "- \${$tag->getVariableName()} `{$tag->getType()}`";
			$description = trim($tag->getDescription());

			// if description is multiline, indent lines
            $description = str_contains($description, "\n")
				? "\n\n" . str_replace("\n", "\n  ", $description)
                : " $description";
			$markdown .= "$description\n";
		}
	}

	$return = $docblock->getTagsByName('return');

    foreach ($return as $tag) {
        $markdown .= "returns `$tag`\n";
    }

	$examples = $docblock->getTagsByName('example');

	if ($examples !== []) {
		$markdown .= "##### Examples\n";
		foreach ($examples as $tag) {
			$value = trim($tag->__toString());

			// add ```php` if not specified
			$markdown .= preg_replace('/^```(\w*)/m', '```php', $value, 1) . "\n";
		}
	}

    $markdown .= "\n----------\n";
}

file_put_contents($destination_file, $markdown);
