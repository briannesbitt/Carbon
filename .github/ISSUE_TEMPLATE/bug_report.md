---
name: Bug report
about: Create a report to help us improve
title: ''
labels: bug
assignees: kylekatarnls

---

**Describe the bug**
A clear and concise description of what the bug is.

**To Reproduce**
A stand-alone chunk of code (with no dependences to other packages, user-land function nor variables with unknow values), for example:
```php
echo Carbon::parse('2018-06-01')->subDay()->month;
```

**Expected behavior**
A clear and concise description of what you expected to happen.

**Actual behavior**
Show the value(s) you get. If you get an error or exception, provide the whole stack trace of it.

**Versions**
 - PHP: [e.g. 8.4.11] (use `echo phpversion();` to get it)
 - Carbon: [e.g. 3.10.2] (run `composer show nesbot/carbon` to find it)

**Additional context**
Add any other context about the problem here. If some default timezone or other php.ini settings are in use for instance.
