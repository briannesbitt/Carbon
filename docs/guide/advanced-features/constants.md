# Constants

The following constants are defined in the Carbon class.

```php
// These getters specifically return integers, ie intval()
var_dump(Carbon::SUNDAY);
var_dump(Carbon::MONDAY);
var_dump(Carbon::TUESDAY);
var_dump(Carbon::WEDNESDAY);
var_dump(Carbon::THURSDAY);
var_dump(Carbon::FRIDAY);
var_dump(Carbon::SATURDAY);

var_dump(Carbon::YEARS_PER_CENTURY);
var_dump(Carbon::YEARS_PER_DECADE);
var_dump(Carbon::MONTHS_PER_YEAR);
var_dump(Carbon::WEEKS_PER_YEAR);
var_dump(Carbon::DAYS_PER_WEEK);
var_dump(Carbon::HOURS_PER_DAY);
var_dump(Carbon::MINUTES_PER_HOUR);
var_dump(Carbon::SECONDS_PER_MINUTE);

```

```php
$dt = Carbon::createFromDate(2012, 10, 6);
if ($dt->dayOfWeek === Carbon::SATURDAY) {
    echo 'Place bets on Ottawa Senators Winning!';
}

```
