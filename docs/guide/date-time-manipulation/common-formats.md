# Common Formats

The following are wrappers for the common formats provided in the [DateTime class](https://www.php.net/manual/en/class.datetime.php).

```php
$dt = Carbon::createFromFormat('Y-m-d H:i:s.u', '2019-02-01 03:45:27.612584');

// $dt->toAtomString() is the same as $dt->format(\DateTime::ATOM);
echo $dt->toAtomString();
echo $dt->toCookieString();

echo $dt->toIso8601String();
// Be aware we chose to use the full-extended format of the ISO 8601 norm
// Natively, \DateTime::ISO8601 format is not compatible with ISO-8601 as it
// is explained here in the PHP documentation:
// https://php.net/manual/class.datetime.php#datetime.constants.iso8601
// We consider it as a PHP mistake and chose not to provide method for this
// format, but you still can use it this way:
echo $dt->format(\DateTime::ISO8601);

echo $dt->toISOString();
echo $dt->toJSON();

echo $dt->toIso8601ZuluString();
echo $dt->toDateTimeLocalString();
echo $dt->toRfc822String();
echo $dt->toRfc850String();
echo $dt->toRfc1036String();
echo $dt->toRfc1123String();
echo $dt->toRfc2822String();
echo $dt->toRfc3339String();
echo $dt->toRfc7231String();
echo $dt->toRssString();
echo $dt->toW3cString();

```
