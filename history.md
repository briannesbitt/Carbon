1.14.0 / 2015-02-06
===================
* Added isBirthday()
* Various refactorings
* Merged MonthsNoOverflow helpers
* Added 2nd param to diffForHumans() to remove string modifier text
* Improved readme for installation
* Simplified __get method
* timezone support for method formatLocalized
* Added helpers secondsSinceMidnight() / secondsUntilEndOfDay()

1.13.0 / 2014-09-25
===================
* Fixed diffInDaysFiltered() bug.
* Removed default param from formatLocalized() (thanks @vlakoff)
* Various refactorings (thanks @lucasmichot @euromark)
* Updated toXXXString() methods to be camel cased (thanks @euromark)
* Now using 4 spaces for indent. (thanks @lucasmichot @euromark)

1.12.0 / 2014-09-09
===================
* Add new functions diffInDaysFiltered(), diffInWeekdays() and diffInWeekendDays() (thanks @m4tthumphrey)
* Fixed XofQuarter methods when moving to a month that doesn't have that day it jumps forward #168
* Support for microseconds during instantiation and copy.  Be aware that microseconds are ignored for doing any of the math.
* Microsecond getter.
* Various refactorings (thanks @lucasmichot @lorenzo)

1.11.0 / 2014-08-25
===================
* Added isSameDay() (thanks @enkelmedia)
* Added diffInWeeks(), maxValue() and minValue() (thanks @lucasmichot)
* Improved accuracy of diffForHumans() by using 30/7 for weeks and moving the floor() call to outside the loop.  Fixed tests that just look better now as a result.
* Improved readme with common formats example output (thanks @troyharvey)
* Various internal refactors (thanks @lucasmichot)

1.10.0 / 2014-07-17
===================
* Changed @return Carbon phpdocs to static for better IDE typehint when extending Carbon
* Fixed Carbon.php download link
* Added 5.6 and HHVM to test coverage
* Fixed issue with isPast() returning true for now()
* Added getter for weekOfMonth

1.9.0 / 2014-05-12
==================
* Changed self references to static to allow for easier child classes
* Fixed a couple of tests to account for London DST
* Fixed a test that failed due to inconsistent DateTime COOKIE strings

1.8.0 / 2014-01-06
==================
* Added .gitattributes file to to ignore some files on export (thanks @lucasmichot)
* Removed unnecessary __set tz/timezone switch
* Added min() / max() (thanks @lucasmichot)
* Fixed startOfWeek() / endOfWeek() when crossing year boundary.
* Fixed bug in detecting relative keywords in ctor parameter when using a test now

1.7.0 / 2013-12-04
==================
* Added startOfYear() / endOfYear() (thanks @semalead)
* Added average() (thanks @semalead)

1.6.0 / 2013-11-23
==================
* Fixed "Cannot access property ::$toStringFormat" when extending Carbon and type juggling to a string occurs

1.5.0 / 2013-11-21
==================
* Diff for humans now shows 2 weeks ago instead of 14 days ago
* Added a local getter to test if the instance is in the local timezone
* Added a utc getter to check if the instance is in UTC timezone
* Fixed dst comment / phpdoc and psr issues
* Optimize timezone getters (thanks @semalead)
* Added static __toString formatting (thanks @cviebrock and @anlutro)

1.4.0 / 2013-09-08
==================
* Corrected various PHPdocs
* formatLocalized() is now more OS independent
* Improved diff methods
* Test now can be mocked using a relative term

1.3.0 / 2013-08-21
==================

  * Added modifier methods firstOfMonth(), lastOfMonth(), nthOfMonth(), next(), previous(), and so on
  * Added modifiers startOfWeek() and endOfWeek()
  * Added testing helpers to allow mocking of new Carbon(), new Carbon('now') and Carbon::now()
  * Added formatLocalized() to format a string using strftime() with the current locale
  * Improved diffInSeconds()
  * Improved [add|sub][Years|Months|Days|Hours|Minutes|Seconds|Weeks]
  * Docblocks everywhere ;(
  * Magic class properties
  * Added PHP 5.5 to travis test coverage
  * General Code cleanup

1.2.0 / 2012-10-14
==================

  * Added history.md
  * Implemented __isset() (thanks @flevour)
  * Simplified tomorrow()/yesterday() to rely on today()... more DRY
  * Simplified __set() and fixed exception text
  * Updated readme

1.1.0 / 2012-09-16
==================

  * Updated composer.json
  * Added better error messaging for failed readme generation
  * Fixed readme typos
  * Added static helpers `today()`, `tomorrow()`, `yesterday()`
  * Simplified `now()` code

1.0.1 / 2012-09-10
==================

  * Added travis-ci.org

1.0.0 / 2012-09-10
==================

  * Initial release
