---
order: 7
title: Symfony
---
# Symfony Configuration and Best-Practices

### Installation

Use composer from your Symfony project root directory to install Carbon:

```
composer require nesbot/carbon
```

### ORM configuration

Since its version 2.32.0, Carbon provides Doctrine types pre-configuration.

Add Carbon to datetime types in **config/packages/doctrine.yaml**:

```
doctrine:
    dbal:
        types:
            datetime_immutable: \Carbon\Doctrine\DateTimeImmutableType
            datetime: \Carbon\Doctrine\DateTimeType
```

Now when you will add a field in an ORM entity with the type **datetime** or **datetime\_immutable** (recommended) it will automatically enhance those properties with **Carbon** methods.

As Carbon is mostly compatible with DateTime, it should not break anything and you're still able to retrieve the raw DateTime object using `->toDateTime()` or `->toDateTimeImmutable()`.

It's still possible to use carbon types keeping original datetime/datetime\_immutable types using:

```
doctrine:
    dbal:
        types:
            carbon_immutable: \Carbon\Doctrine\CarbonImmutableType
            carbon: \Carbon\Doctrine\CarbonType
```

It also allows you to store microseconds in your database (see below why it's important).

### Time precision

As soon as you need to store a date (with or without time), you should store a full datetime. Even if it sounds like you don't need the time, timezone or anything more than the day-precision for a date such as `2020-07-26` but July the 26th is not the same day for everyone. July 26th is a precise period from 07-26 00:00:00 to 07-26 23:59:59.999... But if a person in New York says 26th July, a person in Auckland talking about the same period would consider it's 07-26 16:00:00 to 07-27 15:59:59.999... This means if you store only year-month-day dates, your app can only work in 1 timezone and will never be compatible with any other timezone.

The same way, you won't be able to re-use any date-related component of your app in any multi-timezones contexts. Nowadays, it make absolutely no sense to work on a mono-timezone basis. You're 99.99% sure someday your app or a part of your app will be used in more than 1 timezone, so you will need at least to add hour-minute to store worldwide day-precision (because some timezone have shifts like +4:30 or +8:45), so since you're there, there's no point to be stingy, you can also store second and then have a standard storing of any moment no matter the precision you want.

Last, when it comes to precise sorting or you want to take the 3 first people that sent a request, you will be embarrassed if you see 5 times the same datetime in your log because people sent requests in the same second.

So, store the maximum precision your engine can (microseconds with PHP and MySQL for instance) and forget it.

On the long term, this will free your mind, stop worrying about what precision you got, if you compare 2 moments, you will always have precise difference. Then if you want to round or truncate a difference, or display in a particular timezone, you still can because you have the complete data, while if you decide to store less data, it will be too late to change your mind later regarding existing data.

You can customize the precision from ORM annotations:

```php{no-render}
/**
 * @ORM\Column(type="datetime", precision=7)
 */
private $created_at;
```

But for consistency, we recommend setting it rather globally and use the maximum precision allowed by your DB engine(s).

`DateTimeImmutableType` and `DateTimeType` comes with microseconds precision (6) as default value used if precision is not set or set to 0. If you want to increase/decrease it, you can call `\Carbon\Doctrine\DateTimeDefaultPrecision::set(7)` from `registerBundles()` in **src/Kernel.php**,

We chose on purpose to set the precision to 6 by default (while default ORM precision for datetime is 0) because this is the precision you have from a carbon/datetime objects created with PHP. In many situation this precision is needed (to make proper sorting, accurate difference calculations, etc.) and we consider using defaults should be the safest option, not lead to precision loss.

Still if you want explicitly 0-precision (integer second), you can use:

```php{no-render}
/**
 * @ORM\Column(type="datetime", options={"secondPrecision"=true})
 */
private $created_at;
```

### Localization

When storing a datetime, you should also consider the location where this moment is considered, you can store it with any timezone. If a user buy an airplane flight ticket, you may want to display departure time (with origin timezone), arrival time (with destination timezone) and let's say also online check-in deadline and order time (with current browser timezone).

Here you can distinguish dates to be considered in a fixed timezone (departure and arrival) and the ones that can actually be displayed in any timezone.

Let's see the departure/arrival first. You may be tempted to just store date considered in each airport. So flying from Reykjavik (‏KEF)‏ to Athènes (‏ATH)‏, you can get 2020-11-04 10:00 and 2020-11-04 14:00, this would allow you to display the raw data: 10:00 (REK) -> 14:00 (ATH), great. But now to calculate the flight duration, you will need to convert one or the other to get the diff because the flight is 6-hour and not 4-hour long. And even more tricky, let's now output the 5 next flights. You have mixed timezones in your DB (database), so you can't rely on the DB optimizations to sort and limit the result. You can't even now which flight already took off or not without converting every date in a reference timezone. That's a shame.

That's why, in your DB, **every dates** should be stored in the same timezone. This way, you can sort, compare, sub/add with no conversion.

### Which timezone to choose?

Many businesses/organizations made the mistake of taking their business or server location as the reference timezone. You should think bigger! Someday you may move your server, become an international company, or you may simply want to reuse a part of your app or your DB. Then the timezone your originally picked will make absolutely no sense, and if you have to merge with an other DB, it will no longer be consistent.

Even worse, if you choose a timezone with DST as reference (USA, Europe, etc.) then you will have calculation errors (for instance, the given flight above will give you 5 or 7 hours instead of 6 when there is a DST change in your reference timezone during the flight).

### UTC is the reference

The worldwide time system standard is UTC, it defines each timezone from GMT (Greenwich Mean Time) +/- a given time shift. So to maximize your compatibility and avoid painful issues, use `'UTC'` as the default timezone of your app and to store any moment in your DB or any other storage.

This is also the timezone you should choose for your APIs. For instance, in a JSON API, a date should looks like `"2020-03-19T08:44:40.593Z"`, Browser will understand `Z` as Zulu timezone (an other synonym for `GMT+0` or `UTC+0`) and for instance, if you call `new Date("2020-03-19T08:44:40.593Z")` in Paris, you'll get `Thu Mar 19 2020 09:44:40 GMT+0100 (Central European Standard Time)`, if you call it in New York: `Thu Mar 19 2020 04:44:40 GMT-0400 (Eastern Daylight Time)`. This would actually be the better way for check-in deadline and order time in the example above.

This actually means you will convert dates to an other timezone server-side very rarely, only if you have to display it in a view.

In the previous example, the timezone could be calculated from airport localization, if you need a fixed timezone but don't have the needed data stored to retrieve it, then you should simply add a `text` column in your DB table to store `"Europe/Paris"` or `"America/New_York"`. Use the city timezones and not the shift (like `UTC+08`) else you won't be able to know which DST rules to apply if you have to modify the date or calculate a new date based on the first one.

Last, you don't need to store a timezone string for each timezone-fixed date, you should apply the logic relation/grouping according to your need. For instance, if you want to send e-mails with dates to your users, you can't access the browsers when sending mails so you have to pick a timezone, you can use the last known timezone of the user (supposing you update some users table field with the browser timezone when a user log in your app). In this case, you obviously don't need to store the timezone for each stored date, you can simply save one and reuse it for every dates in all e-mails for a given user.

You can check your default timezone running the PHP function `date_default_timezone_get()`. If it's not `'UTC'` in any of your environment, you should use `date_default_timezone_set('UTC')` in some global place like `registerBundles()` in **src/Kernel.php** to ensure it's always UTC.