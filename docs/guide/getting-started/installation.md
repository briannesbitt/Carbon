---
order: 2
---

# Installation
### With Composer
Use the following command to install with composer.

```
composer require nesbot/carbon
```

This will automatically get the latest version and configure a `composer.json` file.

```php{no-render}
<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());
```

If you wish you can create the following `composer.json` file and run `composer install` to install it.

```
{
    "require": {
        "nesbot/carbon": "^3.0"
    }
}
```

### Direct
Why not using [composer](https://getcomposer.org/)?

Download the last release (or any other you want) here: [releases](https://github.com/briannesbitt/Carbon/releases).

Release package is the asset named **Carbon-x.y.z.zip** where **x.y.z** is the version number.

Extract the zip in a directory in your project, then require the **autoload.php** file to make any Carbon class available:

```php{no-render}
<?php
require 'path/to/Carbon/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;

printf("Now: %s", Carbon::now());

printf("1 day: %s", CarbonInterval::day()->forHumans());
```

Those packages contain **symfony/translation** to make `diffForHumans` method vailable in different languages.

Install with composer is still a better option since it allows you to get the **symfony/translation** (and possible future dependencies) version that suit the best your PHP version and keep the whole think up-to-date via `composer update` command.