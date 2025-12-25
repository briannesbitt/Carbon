# Serialization

The Carbon instances can be serialized (including CarbonImmutable, CarbonInterval and CarbonPeriod).

```php

$dt = Carbon::create(2012, 12, 25, 20, 30, 00, 'Europe/Moscow');

echo serialize($dt);
// same as:
echo $dt->serialize();

$dt = 'O:13:"Carbon\Carbon":3:{s:4:"date";s:26:"2012-12-25 20:30:00.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:13:"Europe/Moscow";}';

echo unserialize($dt)->format('Y-m-d\TH:i:s.uP T');
// same as:
echo Carbon::fromSerialized($dt)->format('Y-m-d\TH:i:s.uP T');

// you can pass options to Carbon::fromSerialized the same way as you can with unserialize
echo Carbon::fromSerialized(
    $dt,
    ['allowed_classes' => [Carbon::class]],
)->format('Y-m-d\TH:i:s.uP T');

```
