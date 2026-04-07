# PHPStan

We provide a PHPStan extension out of the box you can include in your **phpstan.neon**:

```yaml
includes:
	- vendor/nesbot/carbon/extension.neon
parameters:
	bootstrapFiles:
		# You will also need to add here the file
		# that enable your macros and mixins:
		- config/bootstrap.php
```

If you're using Laravel, you can consider using [larastan](https://github.com/nunomaduro/larastan) which provides a complete support of Laravel features in PHPStan (including Carbon macros). Alternatively to include the neon file, you can install **phpstan/extension-installer**:

```
composer require --dev phpstan/phpstan phpstan/extension-installer
```

Then add the file where your Carbon macros and mixins are defined in the **bootstrapFiles** entry:

```yaml
parameters:
	bootstrapFiles:
		- config/bootstrap.php
```
