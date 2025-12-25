<?php

use Carbon\Carbon;
use eftec\bladeone\BladeOne;
use PhpParser\Error;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitor\NodeConnectingVisitor;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;

require __DIR__ . '/../../vendor/autoload.php';

Carbon::macro('getAvailableMacroLocales', static function () {
    $locales = [];

    foreach (Carbon::getAvailableLocales() as $locale) {
        $locales[explode('_', $locale)[0]] = 1;
    }

    return array_keys($locales);
});

Carbon::macro('describeIsoFormat', static function (string $code): string {
    return match ($code) {
        'D' => 'Day of month number (from 1 to 31)',
        'DD' => 'Day of month number with trailing zero (from 01 to 31)',
        'Do' => 'Day of month with ordinal suffix (from 1st to 31th), translatable',
        'd' => 'Day of week number (from 0 (Sunday) to 6 (Saturday))',
        'dd' => 'Minified day name (from Su to Sa), translatable',
        'ddd' => 'Short day name (from Sun to Sat), translatable',
        'dddd' => 'Day name (from Sunday to Saturday), translatable',
        'DDD' => 'Day of year number (from 1 to 366)',
        'DDDD' => 'Day of year number with trailing zeros (3 digits, from 001 to 366)',
        'DDDo' => 'Day of year number with ordinal suffix (from 1st to 366th), translatable',
        'e' => 'Day of week number (from 0 (Sunday) to 6 (Saturday)), similar to "d" but this one is translatable (takes first day of week of the current locale)',
        'E' => 'Day of week number (from 1 (Monday) to 7 (Sunday))',
        'H' => 'Hour from 0 to 23',
        'HH' => 'Hour with trailing zero from 00 to 23',
        'h' => 'Hour from 0 to 12',
        'hh' => 'Hour with trailing zero from 00 to 12',
        'k' => 'Hour from 1 to 24',
        'kk' => 'Hour with trailing zero from 01 to 24',
        'm' => 'Minute from 0 to 59',
        'mm' => 'Minute with trailing zero from 00 to 59',
        'a' => 'Meridiem am/pm',
        'A' => 'Meridiem AM/PM',
        's' => 'Second from 0 to 59',
        'ss' => 'Second with trailing zero from 00 to 59',
        'S' => 'Second tenth',
        'SS' => 'Second hundredth (on 2 digits with trailing zero)',
        'SSS' => 'Millisecond (on 3 digits with trailing zeros)',
        'SSSS' => 'Second ten thousandth (on 4 digits with trailing zeros)',
        'SSSSS' => 'Second hundred thousandth (on 5 digits with trailing zeros)',
        'SSSSSS' => 'Microsecond (on 6 digits with trailing zeros)',
        'SSSSSSS' => 'Second ten millionth (on 7 digits with trailing zeros)',
        'SSSSSSSS' => 'Second hundred millionth (on 8 digits with trailing zeros)',
        'SSSSSSSSS' => 'Nanosecond (on 9 digits with trailing zeros)',
        'M' => 'Month from 1 to 12',
        'MM' => 'Month with trailing zero from 01 to 12',
        'MMM' => 'Short month name, translatable',
        'MMMM' => 'Month name, translatable',
        'Mo' => 'Month with ordinal suffix from 1st to 12th, translatable',
        'OY' => 'Year number with alternative numbers such as ۱۹۹۸ for 1998 if locale is fa',
        'OM' => 'Month number with alternative numbers such as ၀၂ for 2 if locale is my_MM',
        'OD' => 'Day number with alternative numbers such as 三 for 3 if locale is ja_JP',
        'OH' => '24-hours number with alternative numbers such as ႑႓ for 13 if locale is shn_MM',
        'Oh' => '12-hours number with alternative numbers such as 十一 for 11 if locale is lzh_TW',
        'Om' => 'Minute number with alternative numbers such as ୫୭ for 57 if locale is or',
        'Os' => 'Second number with alternative numbers such as 十五 for 15 if locale is ja_JP',
        'Q' => 'Quarter from 1 to 4',
        'Qo' => 'Quarter with ordinal suffix from 1st to 4th, translatable',
        'G' => 'ISO week year (see <a href="https://en.wikipedia.org/wiki/ISO_week_date" target="_blank">ISO week date</a>)',
        'GG' => 'ISO week year (on 2 digits with trailing zero)',
        'GGG' => 'ISO week year (on 3 digits with trailing zeros)',
        'GGGG' => 'ISO week year (on 4 digits with trailing zeros)',
        'GGGGG' => 'ISO week year (on 5 digits with trailing zeros)',
        'g' => 'Week year according to locale settings, translatable',
        'gg' => 'Week year according to locale settings (on 2 digits with trailing zero), translatable',
        'ggg' => 'Week year according to locale settings (on 3 digits with trailing zeros), translatable',
        'gggg' => 'Week year according to locale settings (on 4 digits with trailing zeros), translatable',
        'ggggg' => 'Week year according to locale settings (on 5 digits with trailing zeros), translatable',
        'W' => 'ISO week number in the year (see <a href="https://en.wikipedia.org/wiki/ISO_week_date" target="_blank">ISO week date</a>)',
        'WW' => 'ISO week number in the year (on 2 digits with trailing zero)',
        'Wo' => 'ISO week number in the year with ordinal suffix, translatable',
        'w' => 'Week number in the year according to locale settings, translatable',
        'ww' => 'Week number in the year according to locale settings (on 2 digits with trailing zero)',
        'wo' => 'Week number in the year according to locale settings with ordinal suffix, translatable',
        'x' => 'Millisecond-precision timestamp (same as <code>date.getTime()</code> in JavaScript)',
        'X' => 'Timestamp (number of seconds since 1970-01-01)',
        'Y' => 'Full year from -9999 to 9999',
        'YY' => 'Year on 2 digits from 00 to 99',
        'YYYY' => 'Year on 4 digits from 0000 to 9999',
        'YYYYY' => 'Year on 5 digits from 00000 to 09999',
        'YYYYYY' => 'Year on 5 digits with sign from -09999 to +09999',
        'z' => 'Abbreviated time zone name',
        'zz' => 'Time zone name',
        'Z' => 'Time zone offset HH:mm',
        'ZZ' => 'Time zone offset HHmm',
        default => '',
    };
});

$is_inline = in_array('inline', $argv);
$is_blade = in_array('blade', $argv);

$code = file_get_contents(__DIR__ . '/temp.php');

$uses = array(
	'Carbon\Carbon',
	'Carbon\CarbonImmutable',
	'Carbon\CarbonInterval',
	'Carbon\CarbonPeriod',
	'Carbon\Carbonite',
	'Carbon\Translator',
	'Carbon\CarbonInterface',
	'Carbon\Language',
	'Carbon\Factory',
	'Carbon\CarbonTimeZone',
);

if ($is_inline) {
	// execute and return output directly
	ob_start();
	$uses_for_inline = array_map(static fn (string $use) => "use $use;", $uses);

	try {
		eval(implode(' ', $uses_for_inline) . " $code");

		echo ob_get_clean();
	} catch (Throwable $error) {
		echo "\n\nError during eval: " . $error->getMessage() . "\n";
	}

	return;
}

if ($is_blade) {
	$blade = new BladeOne();
	$uses_for_blade = array_map(static fn (string $use) => "@use($use)", $uses);

	$uses_string = implode(' ', $uses_for_blade);
	$string = "{$uses_string} $code";

	try {
		$output = $blade->runString($string, array());
	} catch (Throwable $error) {
		echo "\n\nError during Blade rendering: " . $error->getMessage() . "\n";

		return;
	}

	echo $output;

	return;
}

$code = "<?php {$code}";

$parser_factory = new ParserFactory();
$parser = $parser_factory->createForNewestSupportedVersion();

try {
	$ast = $parser->parse($code);
} catch (Error $error) {
	echo "Parse error: {$error->getMessage()}\n";

	return;
}

$nodeVisitor = new class extends NodeVisitorAbstract {
    private array $statements = [];

    public function enterNode(Node $node): int
    {
        $type = $node->getType();
        if ($node instanceof Node\Stmt\Expression) {
            $type = $node->expr->getType();
        }

        $this->statements[] = [
            'start' => $node->getAttribute('startFilePos'),
            'end' => $node->getAttribute('endFilePos'),
            'type' => $type,
            'length' => $node->getAttribute('endFilePos') - $node->getAttribute('startFilePos') + 1,
        ];

        // Stop traversing further into this node's children
        return NodeVisitor::DONT_TRAVERSE_CHILDREN;
    }

    public function getStatements(): array
    {
        return $this->statements;
    }
};
$traverser = new NodeTraverser(new NodeConnectingVisitor());
$traverser->addVisitor($nodeVisitor);

$modified_stmts = $traverser->traverse($ast);
$statements = $nodeVisitor->getStatements();

function get_longest_length(array $statements): int
{
	// get only echo and var_dump statements
	$statements = array_filter($statements, static fn (array $statement) => in_array(
        $statement['type'],
        ['Stmt_Echo', 'Expr_VarDump'],
    ));

	usort($statements, static fn ($a, $b) => $b['length'] <=> $a['length']);

	if (empty($statements)) {
		return 0;
	}

	return $statements[0]['length'] + 3;
}

$longest_length = get_longest_length($statements);

$output = $code;
$last_offset = 0;

$uses_for_block = array_map(static fn (string $use) => "use $use;", $uses);

foreach ($statements as $stmt) {
	ob_start();
	$statement = substr($code, $stmt['start'], $stmt['length']);

	try {
		eval(implode(' ', $uses_for_block) . " $statement");
		$captured_output = ob_get_clean();

		if (!in_array($stmt['type'], ['Stmt_Echo', 'Expr_StaticCall', 'Expr_FuncCall', 'Stmt_TryCatch', 'Stmt_Foreach', 'Stmt_While'])) {
			continue;
		}

		// add value as a comment next to the line in $code if single line
		// or after the line if multi line
		$trimmed_output = trim($captured_output);

        $comment = str_contains($trimmed_output, "\n")
            ? "\n/*\n$trimmed_output\n*/"
            : " // $trimmed_output";

		$padded_statement = str_pad($statement, $longest_length);

		// replace with padded statement
		$output = substr_replace($output, $padded_statement, $stmt['start'] + $last_offset, $stmt['length']);
		$last_offset += strlen($padded_statement) - $stmt['length'];

		// insert comment after the statement
		if ($trimmed_output) {
			$output = substr_replace($output, $comment, $stmt['end'] + 1 + $last_offset, 0);
			$last_offset += strlen($comment);
		}
	} catch (Throwable $error) {
		echo "\n\nError during eval: " . $error->getMessage() . "\n";
	}
}

// remove <?php tag
$output = preg_replace('/^<\?php\s*/', '', $output);

echo $output;
