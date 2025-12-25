---
title: Documentation
---

# How to Contribute to this documentation

The documentation resides in the [gh-pages branch of Carbon](https://github.com/briannesbitt/Carbon/tree/gh-pages).

*   [Fork Carbon](https://github.com/briannesbitt/Carbon/fork)
*   `git clone`
*   `git checkout gh-pages`
*   `git checkout -b [speaking-new-branch-name]`
*   Modify `.src.html` source files
*   `git commit`
*   `git push`
*   Create a pull request against the **gh-pages** branch


### Generators
Documentations uses few generators. They are inside 'tools' folder.
*   `tools/generate-api.php` : generate API documentation from source code and docblocks. It outputs data into `docs/develop/reference.md`
*   `tools/generate-changelog.php` : generate changelog from git tags and commit messages. It outputs data into `docs/develop/changelog.md`
*   `tools/generate-backers.php` : generate backers and sponsors list from Open Collective API. It outputs data into `docs/develop/contribution/backers.md` and `docs/public/backers.json`


### Writing code examples
When writing code examples in the documentation, php block are automatically rendered. All print and echo statements are captured and displayed. If output is multiline it will be displayed below code, otherwise it will be displayed inline.

For example:
````
```php
$mutable = Carbon::now();
$modifiedMutable = $mutable->add(1, 'day');

var_dump($modifiedMutable === $mutable);
```
````

will be rendered as:

```php
$mutable = Carbon::now();
$modifiedMutable = $mutable->add(1, 'day');

var_dump($modifiedMutable === $mutable);
```

if you want to avoid rendering output, you can use `{no-render}` after the opening php tag like `php{no-render}`

```php{no-render}
$mutable = Carbon::now();
$modifiedMutable = $mutable->add(1, 'day');
```

#### Sandbox
Sandbox link is also automatically generated for code blocks. It allows users to open the code example in an online PHP sandbox environment to test and modify it. If you want to avoid displaying the sandbox link, you can use `{no-sandbox}` after the opening php tag like `php{no-sandbox}`

```php{no-sandbox}
$mutable = Carbon::now();
$modifiedMutable = $mutable->add(1, 'day');
var_dump($modifiedMutable === $mutable);
```

You can combine both `{no-render}` and `{no-sandbox}` if needed, like `php{no-render}{no-sandbox}`


### Icons
Bootstrap icons are used in the documentation. You can find the list of available icons on the [Bootstrap Icons website](https://icons.getbootstrap.com/). To add an icon, use the following syntax:
```html
<i class="bi bi-icon-name"></i>
```
Replace `icon-name` with the desired icon's name from the Bootstrap Icons library. For example, to add a star icon, you would use:
```html
<i class="bi bi-star"></i>
```