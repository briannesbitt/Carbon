# String Formatting

All of the available `toXXXString()` methods rely on the base class method [DateTime::format()](https://www.php.net/manual/en/datetime.format.php). You'll notice the `__toString()` method is defined which allows a Carbon instance to be printed as a pretty date time string when used in a string context.

```php
$dt = Carbon::create(1975, 12, 25, 14, 15, 16);

var_dump($dt->toDateTimeString() == $dt); // => uses __toString()
echo $dt->toDateString();
echo $dt->toFormattedDateString();
echo $dt->toFormattedDayDateString();
echo $dt->toTimeString();
echo $dt->toDateTimeString();
echo $dt->toDayDateTimeString();

// ... of course format() is still available
echo $dt->format('l jS \\of F Y h:i:s A');

// The reverse hasFormat method allows you to test if a string looks like a given format
var_dump(Carbon::hasFormat('Thursday 25th December 1975 02:15:16 PM', 'l jS F Y h:i:s A'));

```

You can also set the default \_\_toString() format (which defaults to `Y-m-d H:i:s`) that's used when [type juggling](https://www.php.net/manual/en/language.types.type-juggling.php) occurs.

```php
$dt = Carbon::create(1975, 12, 25, 14, 15, 16);
echo $dt;
echo "\n";

$dt->settings([
	'toStringFormat' => 'jS \o\f F, Y g:i:s a',
]);

echo $dt;

// As any setting, you can get the current value for a given date using:
var_dump($dt->getSettings());

```

As part of the settings `'toStringFormat'` can be used in factories too. It also may be a closure, so you can run any code on string cast.

If you use Carbon 1 or want to apply it globally as default format, you can use:

```php

$dt = Carbon::create(1975, 12, 25, 14, 15, 16);
Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');

echo $dt;
echo "\n";

Carbon::resetToStringFormat();

echo $dt;

```

Note: For localization support see the [Localization](../getting-started/localization.html) section.
