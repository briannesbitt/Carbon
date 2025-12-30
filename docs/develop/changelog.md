<!-- This file is auto generated using tools/generate-changelog.php -->

# Changelog

## Version 3.x

#### 3.11.0 (6 September 2025)
* Fix grammar mistakes in lt.php localization by @sammyaxe in [briannesbitt/Carbon#3215](https://github.com/briannesbitt/Carbon/pull/3215)
* Fix resetMessages memory consumption by @kylekatarnls in [CarbonPHP/carbon#58](https://github.com/CarbonPHP/carbon/pull/58)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.10.2...3.10.3)

New contributors:
* @sammyaxe made their first contribution in [briannesbitt/Carbon#3215](https://github.com/briannesbitt/Carbon/pull/3215)


#### 3.10.3 (2 August 2025)
* Replace `]1,Inf[` with `[-Inf,Inf]` generic catch-all (fallback) by @kylekatarnls in [CarbonPHP/carbon#54](https://github.com/CarbonPHP/carbon/pull/54)
* Change `?self` return type to `?static` in Creator Trait by @Disservin in [briannesbitt/Carbon#3213](https://github.com/briannesbitt/Carbon/pull/3213)
* Fix 0 second diff edge case in translations by @Joeb454 in [briannesbitt/Carbon#3218](https://github.com/briannesbitt/Carbon/pull/3218)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.10.1...3.10.2)

New contributors:
* @Disservin made their first contribution in [briannesbitt/Carbon#3213](https://github.com/briannesbitt/Carbon/pull/3213)
* @Joeb454 made their first contribution in [briannesbitt/Carbon#3218](https://github.com/briannesbitt/Carbon/pull/3218)


#### 3.10.2 (21 June 2025)
* Fix rounding issue in `CarbonInterval::make()` by @kylekatarnls in [CarbonPHP/carbon#51](https://github.com/CarbonPHP/carbon/pull/51)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.10.0...3.10.1)


#### 3.10.1 (12 June 2025)
* Allow passing `$options` to `fromSerialized()` by @kylekatarnls in [CarbonPHP/carbon#33](https://github.com/CarbonPHP/carbon/pull/33)
* Limit the number of recurrences by @kylekatarnls in [CarbonPHP/carbon#34](https://github.com/CarbonPHP/carbon/pull/34)
* Make CarbonPeriod serialization compatible with v2 by @kylekatarnls in [CarbonPHP/carbon#37](https://github.com/CarbonPHP/carbon/pull/37)
* fix: add dynamic return type for `tz()` by @nesl247 in [CarbonPHP/carbon#42](https://github.com/CarbonPHP/carbon/pull/42)
* Simplify period unserialization process by @kylekatarnls in [CarbonPHP/carbon#44](https://github.com/CarbonPHP/carbon/pull/44)
* Use serialization to set days property on intervals by @kylekatarnls in [CarbonPHP/carbon#43](https://github.com/CarbonPHP/carbon/pull/43)
* Fix undefined constant self::DEFAULT_LOCALE error by @aavtukhovich in [CarbonPHP/carbon#45](https://github.com/CarbonPHP/carbon/pull/45)
* Update Divehi months by @kylekatarnls in [CarbonPHP/carbon#46](https://github.com/CarbonPHP/carbon/pull/46)
* Prioritize timezones matching ->format('T') for getAbbreviatedName() by @kylekatarnls in [CarbonPHP/carbon#47](https://github.com/CarbonPHP/carbon/pull/47)
* Update month abbreviation for Latin Serbian by @kylekatarnls in [CarbonPHP/carbon#49](https://github.com/CarbonPHP/carbon/pull/49)
* Fix plural for Urdu, Sindhi and Arab Panjabi by @kylekatarnls in [briannesbitt/Carbon#3201](https://github.com/briannesbitt/Carbon/pull/3201)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.9.1...3.10.0)

New contributors:
* @nesl247 made their first contribution in [CarbonPHP/carbon#42](https://github.com/CarbonPHP/carbon/pull/42)
* @aavtukhovich made their first contribution in [CarbonPHP/carbon#45](https://github.com/CarbonPHP/carbon/pull/45)


#### 3.10.0 (1 May 2025)
* Localization: added milliseconds and microseconds to Russian locale by @daniser in [briannesbitt/Carbon#3169](https://github.com/briannesbitt/Carbon/pull/3169)
* Fix overflow issue for is-month by @kylekatarnls in [briannesbitt/Carbon#3170](https://github.com/briannesbitt/Carbon/pull/3170)
* Fix ->is('02-29') by @kylekatarnls in [briannesbitt/Carbon#3171](https://github.com/briannesbitt/Carbon/pull/3171)
* Fix Incorrect Type Inference when Declaring Macros by @liamduckett in [briannesbitt/Carbon#3174](https://github.com/briannesbitt/Carbon/pull/3174)
* feat: Apply Laravel fallback locale by @daniser in [briannesbitt/Carbon#3168](https://github.com/briannesbitt/Carbon/pull/3168)
* Add missing @param-closure-this by @kylekatarnls in [briannesbitt/Carbon#3175](https://github.com/briannesbitt/Carbon/pull/3175)
* Add missing type for method parameter by @riesjart in [briannesbitt/Carbon#3176](https://github.com/briannesbitt/Carbon/pull/3176)
* Update sponsors by @github-actions in [briannesbitt/Carbon#3177](https://github.com/briannesbitt/Carbon/pull/3177)
* [Danish] 2-letter day abbreviations + 3-letter abbreviation of ‘May’ by @kokoshneta in [briannesbitt/Carbon#3183](https://github.com/briannesbitt/Carbon/pull/3183)
* Update sponsors by @github-actions in [briannesbitt/Carbon#3186](https://github.com/briannesbitt/Carbon/pull/3186)
* Reduce segfault risk in PHP 8.3.20 by @kylekatarnls in [briannesbitt/Carbon#3187](https://github.com/briannesbitt/Carbon/pull/3187)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.9.0...3.9.1)

New contributors:
* @daniser made their first contribution in [briannesbitt/Carbon#3169](https://github.com/briannesbitt/Carbon/pull/3169)
* @liamduckett made their first contribution in [briannesbitt/Carbon#3174](https://github.com/briannesbitt/Carbon/pull/3174)
* @riesjart made their first contribution in [briannesbitt/Carbon#3176](https://github.com/briannesbitt/Carbon/pull/3176)


#### 3.9.1 (27 March 2025)
* Add `isNowOrFuture()` and `isNowOrPast()` methods by @AndrewMast in [CarbonPHP/carbon#27](https://github.com/CarbonPHP/carbon/pull/27)
* Add ReturnTypeWillChange to createFromTimestamp by @cdburgess in [CarbonPHP/carbon#22](https://github.com/CarbonPHP/carbon/pull/22)

[Complete commits list](https://github.com/CarbonPHP/carbon/compare/3.8.6...3.9.0)

New contributors:
* @cdburgess made their first contribution in [CarbonPHP/carbon#22](https://github.com/CarbonPHP/carbon/pull/22)
* @AndrewMast made their first contribution in [CarbonPHP/carbon#27](https://github.com/CarbonPHP/carbon/pull/27)


#### 3.9.0 (20 February 2025)
* Fix Turkmen week day name order by @kylekatarnls in [briannesbitt/Carbon#3152](https://github.com/briannesbitt/Carbon/pull/3152)
* Test Laravel ongoing v13 by @kylekatarnls in [briannesbitt/Carbon#3155](https://github.com/briannesbitt/Carbon/pull/3155)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.5...3.8.6)


#### 3.8.6 (11 February 2025)
* Fix CarbonInterval PHPDoc by @kylekatarnls in [briannesbitt/Carbon#3130](https://github.com/briannesbitt/Carbon/pull/3130)
* Fix time unit abbreviations and format mismatches for Azerbaijani translation by @novruzrhmv in [briannesbitt/Carbon#3144](https://github.com/briannesbitt/Carbon/pull/3144)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.4...3.8.5)

New contributors:
* @novruzrhmv made their first contribution in [briannesbitt/Carbon#3144](https://github.com/briannesbitt/Carbon/pull/3144)


#### 3.8.5 (27 December 2024)
- Validate locale earlier

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.3...3.8.4)


#### 3.8.4 (21 December 2024)
* Fix month abbreviations for fr_BE/fr_LU by @c-Rolland in [briannesbitt/Carbon#3110](https://github.com/briannesbitt/Carbon/pull/3110)
* Update Occitan locale: small correction by @Mejans in [briannesbitt/Carbon#3115](https://github.com/briannesbitt/Carbon/pull/3115)
* Fix month names by @koprivan in [briannesbitt/Carbon#3122](https://github.com/briannesbitt/Carbon/pull/3122)
* Add Psalm config by @kylekatarnls in [briannesbitt/Carbon#3125](https://github.com/briannesbitt/Carbon/pull/3125)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.2...3.8.3)

New contributors:
* @c-Rolland made their first contribution in [briannesbitt/Carbon#3110](https://github.com/briannesbitt/Carbon/pull/3110)
* @Mejans made their first contribution in [briannesbitt/Carbon#3115](https://github.com/briannesbitt/Carbon/pull/3115)
* @koprivan made their first contribution in [briannesbitt/Carbon#3122](https://github.com/briannesbitt/Carbon/pull/3122)


#### 3.8.3 (7 November 2024)
* Fix immutable return for `setUnitNoOverflow` by @kylekatarnls in [briannesbitt/Carbon#3103](https://github.com/briannesbitt/Carbon/pull/3103)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.1...3.8.2)


#### 3.8.2 (3 November 2024)
* Consider absolute flag when comparing intervals by @kylekatarnls in [briannesbitt/Carbon#3073](https://github.com/briannesbitt/Carbon/pull/3073)
* Optimize `setUnitNoOverflow()` by @takaram in [briannesbitt/Carbon#3071](https://github.com/briannesbitt/Carbon/pull/3071)
* Fix timezone issue when add/sub with overflow by @kylekatarnls in [briannesbitt/Carbon#3074](https://github.com/briannesbitt/Carbon/pull/3074)
* Automate documentation update by @kylekatarnls in [briannesbitt/Carbon#3079](https://github.com/briannesbitt/Carbon/pull/3079)
* Parse microseconds as integer when making from specs by @kylekatarnls in [briannesbitt/Carbon#3098](https://github.com/briannesbitt/Carbon/pull/3098)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.8.0...3.8.1)


#### 3.8.1 (19 August 2024)
* Accept Unit enum in `startOf` and `endOf` by @kylekatarnls in [briannesbitt/Carbon#3052](https://github.com/briannesbitt/Carbon/pull/3052)
* Add test for German period translation by @kylekatarnls in [briannesbitt/Carbon#3054](https://github.com/briannesbitt/Carbon/pull/3054)
* Add tests for `CarbonInterval` and `CarbonPeriod` by @kylekatarnls in [briannesbitt/Carbon#3055](https://github.com/briannesbitt/Carbon/pull/3055)
* Add generic methods `isStartOfUnit` and `isEndOfUnit` by @kylekatarnls in [briannesbitt/Carbon#3053](https://github.com/briannesbitt/Carbon/pull/3053)
* Implement `isStartOf*` and `isEndOf*` for all units by @kylekatarnls in [briannesbitt/Carbon#3056](https://github.com/briannesbitt/Carbon/pull/3056)
* Update Spanish translations by @DannyJJK in [briannesbitt/Carbon#3060](https://github.com/briannesbitt/Carbon/pull/3060)
* Optimize `getIntervalDayDiff` by @kylekatarnls in [briannesbitt/Carbon#3061](https://github.com/briannesbitt/Carbon/pull/3061)
* Optimize `diffInDays` by @kylekatarnls in [briannesbitt/Carbon#3062](https://github.com/briannesbitt/Carbon/pull/3062)
* Use arrow functions to `getIsoUnits` by @kylekatarnls in [briannesbitt/Carbon#3064](https://github.com/briannesbitt/Carbon/pull/3064)
* Simplify PHPStan extension by @ondrejmirtes in [briannesbitt/Carbon#3065](https://github.com/briannesbitt/Carbon/pull/3065)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.7.0...3.8.0)

New contributors:
* @DannyJJK made their first contribution in [briannesbitt/Carbon#3060](https://github.com/briannesbitt/Carbon/pull/3060)


#### 3.8.0 (16 July 2024)
* Use static instead of `CarbonInterface` return type in doclocks by @philbates35 in [briannesbitt/Carbon#3047](https://github.com/briannesbitt/Carbon/pull/3047)
* Added period German translations by @marcheffels in [briannesbitt/Carbon#3045](https://github.com/briannesbitt/Carbon/pull/3045)
* Use pro rata to calculate decimal part of month/year diffs by @kylekatarnls in [briannesbitt/Carbon#3051](https://github.com/briannesbitt/Carbon/pull/3051)
* Add more `between()` / `isBetween()` tests by @faissaloux in [briannesbitt/Carbon#3043](https://github.com/briannesbitt/Carbon/pull/3043)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.6.0...3.7.0)

New contributors:
* @faissaloux made their first contribution in [briannesbitt/Carbon#3043](https://github.com/briannesbitt/Carbon/pull/3043)
* @philbates35 made their first contribution in [briannesbitt/Carbon#3047](https://github.com/briannesbitt/Carbon/pull/3047)
* @marcheffels made their first contribution in [briannesbitt/Carbon#3045](https://github.com/briannesbitt/Carbon/pull/3045)


#### 3.7.0 (20 June 2024)
* Add support for `Month` and `WeekDay` enums in `is()` method @kylekatarnls #3036
* Build period with given timezone @kylekatarnls #3041
* Unserialize carbon interval created by v2 @kylekatarnls #3042

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.5.0...3.6.0)


#### 3.6.0 (3 June 2024)
* Fix New Zealand daylight saving time format to pass hasFormat v3 @Luoti #3031
* Split CarbonPeriod construction into multiple steps @kylekatarnls #3024
* Make CarbonPeriod compatible with PHP 8.4 @kylekatarnls #3023
* Fix diffInDays DST bug @kylekatarnls #3026
* Fix issue with is month check @kylekatarnls #3033

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.4.0...3.5.0)

New contributors:
* @Luoti made their first contribution in #3031


#### 3.5.0 (24 May 2024)
* Unserialize `CarbonInterval` from v2 @kylekatarnls #3016
* Remove overridden `EXCLUDE_START_DATE` constant @iluuu1994 #3022

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.3.1...3.4.0)

New contributors:
* @iluuu1994 made their first contribution in #3022


#### 3.4.0 (1 May 2024)
* Fix days for `diffForHumans` for slovak @edvordo #3007
* Support `%a` format #3013
* Fix translator and interval serialization #3005
* Fallback to default timezone for mocked now #3014

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.3.0...3.3.1)

New contributors:
* @edvordo made their first contribution in #3007


#### 3.3.1 (18 April 2024)
* Create a dedicated method for each step of the magic `__call` process #2992
* Update Bosnian translations #2994
* Handle `null` in `canBeCreatedFromFormat` #2997
* Allow carbon instance to be rounded by a `CarbonInterval`, which is not in default language @kohlerdominik #2999
* Update Slovak translations @pkundis #2995
* Add `locale` and `translator` options to `forHumans` and `diffForHumans` #3001

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.2.4...3.3.0)

New contributors:
* @kohlerdominik made their first contribution in #2999
* @pkundis made their first contribution in #2995


#### 3.3.0 (5 April 2024)
* Re-allow macro with names starting with diff #2991

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.2.3...3.2.4)


#### 3.2.4 (30 March 2024)
* Update Docs for `diffIn` methods that return float @Nathanjms #2988
* Fix deprecation notice for diffInReal* (prefer diffInUTC*, or for any unit smaller than day, simply diffIn*)

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.2.2...3.2.3)


#### 3.2.3 (28 March 2024)
* Fallback to default parameters if period construction fails #2987

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.2.1...3.2.2)


#### 3.2.2 (27 March 2024)
* Make start and end period properties correct at creation #2984

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.2.0...3.2.1)


#### 3.2.1 (27 March 2024)
* Fix PHP 8.4 implicit nullability deprecation @Ayesh #2969
* Use current timezone if identical to compared value for diff #2972
* Correction of Months' Names In CKB language #2973
* Stop using start/end on interval if they are changed after creation #2981
* Deprecate Real diff in favor of UTC diff #2975
* Allow integer in createFromFormat() #2983

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.1.1...3.2.0)

New contributors:
* @kawan97 made their first contribution in #2973


#### 3.2.0 (13 March 2024)
* Fixed Persian translation for before and after #2963
* Cleaned up region list and add warranty notice on methods relying on it #2964
* Fixed incomplete type for create method PHPDoc #2962

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.1.0...3.1.1)

New contributors:
* @shane-zeng made their first contribution in #2962


#### 3.1.1 (6 March 2024)
* Fixed Persian translation for before and after #2941
* Allowed to pass Unit enum for unit name #2944
* Updated PHPDoc #2946
* Removed suffix to Taiwan name  #2957

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.2...3.1.0)

New contributors:
* @azim-kordpour made their first contribution in #2941


#### 3.1.0 (6 February 2024)
* Fixed PHP 8.1 issue "Enum case value must be compile-time evaluatable": Use static values for enums until dropping PHP 8.1 #2938

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.1...3.0.2)


#### 3.0.2 (5 February 2024)
* Allowed to remove macro by passing `null` value #2935 #2936 #2937

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.0...3.0.1)


#### 3.0.1 (31 January 2024)
- Dropped PHP < 8.1 #2810 #2385 #2346
- Dropped Symfony < 4.4 #2070
- Added enums for week days, months and units #2701
- Added generic `unitOfUnit` and `unitsInUnit` getters #2885
- ⚠ Changed `diffIn*` methods to return `float` and relative diff (`$absolute = false` by default) #2119
  - diffIn* will use the floatDiffInReal* behavior, all other variants will be removed
- Changed `CarbonPeriod` to extend `DatePeriod` #1752
- Changed `create*` method to return `null` instead of `false` #2340
- Changed `forHumans()` to show `0 seconds` y default for empty intervals #2035
- Changed `CarbonInterval` to be empty by default #2079
- Changed week methods to work with current global locale #1967
- Allowed to add and subtract decimal numbers of any unit #2347 #2519
- Changed factories to have isolated settings, locale, testNow, macros and default timezone #2345
- Changed `$tz` with `$timezone` for named argument #2925
- Changed `parse()` return type to non-nullable `static` #2931 — @jnoordsij
- Fixed short year Ukrainian plural #2923 
- Fixed `resolve*` method return type so to allow sub-classes to take other sub-classes as parameters
- Fixed fallback from setter to macro #2922

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/2.72.2...3.0.0)


#### 3.0.0 (31 January 2024)


[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.0-rc.1...3.0.0-rc.3)


#### 3.0.0-rc.3 (26 January 2024)


[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.0-beta.3...3.0.0-rc.1)


#### 3.0.0-rc.1 (24 January 2024)
- Fixed fallback from setter to macro #2922

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.0-beta.2...3.0.0-beta.3)


#### 3.0.0-beta.3 (23 January 2024)
- Fixed `resolve*` method return type so to allow sub-classes to take other sub-classes as parameters

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/3.0.0-beta.1...3.0.0-beta.2)


#### 3.0.0-beta.2 (22 January 2024)
- Dropped PHP < 8.1 #2810 #2385 #2346
- Dropped Symfony < 4.4 #2070
- Added enums for week days, months and units #2701

[Complete commits list](https://github.com/briannesbitt/Carbon/compare/2.72.2...3.0.0-beta.1)



## Version 2.x

::: tip Info
Only release dates are listed here.
:::

- 2.73.0 (8 January 2025)
- 2.72.6 (27 December 2024)
- 2.72.5 (3 June 2024)
- 2.72.4 (3 June 2024)
- 2.72.3 (25 January 2024)
- 2.72.2 (19 January 2024)
- 2.72.1 (8 December 2023)
- 2.72.0 (28 November 2023)
- 2.71.0 (25 September 2023)
- 2.70.0 (7 September 2023)
- 2.69.0 (3 August 2023)
- 2.68.1 (20 June 2023)
- 2.68.0 (15 June 2023)
- 2.67.0 (25 May 2023)
- 2.66.0 (29 January 2023)
- 2.65.0 (6 January 2023)
- 2.64.1 (1 January 2023)
- 2.64.0 (26 November 2022)
- 2.63.0 (30 October 2022)
- 2.62.1 (2 September 2022)
- 2.62.0 (28 August 2022)
- 2.61.0 (6 August 2022)
- 2.60.0 (27 July 2022)
- 2.59.1 (29 June 2022)
- 2.59.0 (26 June 2022)
- 2.58.0 (25 April 2022)
- 2.57.0 (13 February 2022)
- 2.56.0 (21 January 2022)
- 2.55.2 (3 December 2021)
- 2.55.1 (3 December 2021)
- 2.55.0 (2 December 2021)
- 2.54.0 (1 November 2021)
- 2.53.1 (6 September 2021)
- 2.53.0 (6 September 2021)
- 2.52.0 (14 August 2021)
- 2.51.1 (28 July 2021)
- 2.51.0 (28 July 2021)
- 2.50.0 (28 June 2021)
- 2.49.0 (2 June 2021)
- 2.48.1 (26 May 2021)
- 2.48.0 (7 May 2021)
- 2.47.1 (26 May 2021)
- 2.47.0 (13 April 2021)
- 2.46.0 (24 February 2021)
- 2.45.1 (11 February 2021)
- 2.45.0 (7 February 2021)
- 2.44.0 (26 January 2021)
- 2.43.0 (17 December 2020)
- 2.42.0 (28 November 2020)
- 2.41.5 (23 October 2020)
- 2.41.4 (22 October 2020)
- 2.41.3 (12 October 2020)
- 2.41.2 (10 October 2020)
- 2.41.1 (10 October 2020)
- 2.41.0 (4 October 2020)
- 2.40.1 (23 September 2020)
- 2.40.0 (11 September 2020)
- 2.39.2 (10 September 2020)
- 2.39.1 (4 September 2020)
- 2.39.0 (24 August 2020)
- 2.38.0 (4 August 2020)
- 2.37.0 (28 July 2020)
- 2.36.1 (4 July 2020)
- 2.36.0 (25 June 2020)
- 2.35.0 (24 May 2020)
- 2.34.2 (19 May 2020)
- 2.34.1 (19 May 2020)
- 2.34.0 (12 May 2020)
- 2.33.0 (20 April 2020)
- 2.32.2 (31 March 2020)
- 2.32.1 (26 March 2020)
- 2.32.0 (24 March 2020)
- 2.31.0 (1 March 2020)
- 2.30.0 (7 February 2020)
- 2.29.1 (21 January 2020)
- 2.29.0 (21 January 2020)
- 2.28.0 (16 December 2019)
- 2.28.0-beta.1 (12 December 2019)
- 2.27.0 (20 November 2019)
- 2.26.0 (21 October 2019)
- 2.25.3 (20 October 2019)
- 2.25.2 (14 October 2019)
- 2.25.1 (5 October 2019)
- 2.25.0 (30 September 2019)
- 2.25.0-beta.3 (30 September 2019)
- 2.25.0-beta.2 (13 September 2019)
- 2.25.0-beta.1 (9 September 2019)
- 2.24.0 (31 August 2019)
- 2.24.0-beta.4 (31 August 2019)
- 2.24.0-beta.3 (28 August 2019)
- 2.24.0-beta.2 (27 August 2019)
- 2.24.0-beta.1 (23 August 2019)
- 2.23.1 (17 August 2019)
- 2.23.0 (12 August 2019)
- 2.23.0-beta.4 (12 August 2019)
- 2.23.0-beta.3 (7 August 2019)
- 2.23.0-beta.2 (4 August 2019)
- 2.23.0-beta.1 (3 August 2019)
- 2.22.3 (7 August 2019)
- 2.22.1 (6 August 2019)
- 2.22.0 (28 July 2019)
- 2.22.0-beta.3 (28 July 2019)
- 2.22.0-beta.2 (25 July 2019)
- 2.22.0-beta.1 (19 July 2019)
- 2.21.3 (18 July 2019)
- 2.21.2 (17 July 2019)
- 2.21.0 (14 July 2019)
- 2.20.0 (25 June 2019)
- 2.19.2 (7 June 2019)
- 2.19.1 (4 June 2019)
- 2.19.0 (30 May 2019)
- 2.18.0 (16 May 2019)
- 2.17.1 (27 April 2019)
- 2.17.0 (17 April 2019)
- 2.16.3 (6 April 2019)
- 2.16.2 (29 March 2019)
- 2.16.1 (20 March 2019)
- 2.16.0 (12 March 2019)
- 2.15.0 (7 March 2019)
- 2.14.2 (28 February 2019)
- 2.14.1 (27 February 2019)
- 2.14.0 (25 February 2019)
- 2.13.0 (20 February 2019)
- 2.12.0 (6 February 2019)
- 2.11.0 (29 January 2019)
- 2.10.1 (14 January 2019)
- 2.10.0 (2 January 2019)
- 2.9.1 (25 December 2018)
- 2.9.0 (25 December 2018)
- 2.8.0 (18 December 2018)
- 2.7.0 (2 December 2018)
- 2.6.1 (22 November 2018)
- 2.6.0 (19 November 2018)
- 2.5.4 (15 November 2018)
- 2.5.3 (13 November 2018)
- 2.5.2 (12 November 2018)
- 2.5.1 (8 November 2018)
- 2.5.0 (26 October 2018)
- 2.4.1 (17 October 2018)
- 2.4.0 (16 October 2018)
- 2.3.1 (17 October 2018)
- 2.3.0 (27 September 2018)
- 2.2.1 (17 October 2018)
- 2.2.0 (20 September 2018)
- 2.1.1 (17 October 2018)
- 2.1.0 (3 September 2018)
- 2.0.1 (17 October 2018)
- 2.0.0 (23 August 2018)
- 2.0.0-beta.6 (23 August 2018)
- 2.0.0-beta.5 (23 August 2018)
- 2.0.0-beta.4 (23 August 2018)
- 2.0.0-beta.3 (20 August 2018)
- 2.0.0-beta.2 (13 August 2018)
- 2.0.0-beta.1 (8 August 2018)

## Version 1.x

::: tip Info
Only release dates are listed here.
:::

- 1.39.1 (14 October 2019)
- 1.39.0 (11 June 2019)
- 1.38.4 (3 June 2019)
- 1.38.2 (30 May 2019)
- 1.38.1 (30 May 2019)
- 1.38.0 (30 May 2019)
- 1.37.1 (19 April 2019)
- 1.36.2 (28 December 2018)
- 1.36.1 (22 November 2018)
- 1.36.0 (16 November 2018)
- 1.35.1 (14 November 2018)
- 1.35.0 (14 November 2018)
- 1.34.4 (13 November 2018)
- 1.34.3 (13 November 2018)
- 1.34.2 (12 November 2018)
- 1.34.1 (8 November 2018)
- 1.34.0 (20 September 2018)
- 1.33.0 (7 August 2018)
- 1.32.0 (5 July 2018)
- 1.31.1 (25 June 2018)
- 1.31.0 (24 June 2018)
- 1.30.0 (15 June 2018)
- 1.29.2 (29 May 2018)
- 1.29.1 (24 May 2018)
- 1.29.0 (24 May 2018)
- 1.28.0 (18 May 2018)
- 1.27.0 (23 April 2018)
- 1.26.6 (3 June 2019)
- 1.26.5 (30 May 2019)
- 1.26.4 (17 April 2018)
- 1.26.3 (16 April 2018)
- 1.26.2 (16 April 2018)
- 1.26.1 (16 April 2018)
- 1.26.0 (16 April 2018)
- 1.25.3 (3 June 2019)
- 1.25.1 (31 May 2019)
- 1.25.0 (19 March 2018)
- 1.24.2 (10 March 2018)
- 1.24.1 (9 March 2018)
- 1.24.0 (9 March 2018)
- 1.23.0 (28 February 2018)
- 1.22.1 (16 January 2017)
- 1.22.0 (15 January 2017)
- 1.21.0 (4 November 2015)
- 1.20.0 (25 June 2015)
- 1.19.0 (9 May 2015)
- 1.18.0 (26 March 2015)
- 1.17.0 (8 March 2015)
- 1.16.0 (4 March 2015)
- 1.15.0 (3 March 2015)
- 1.14.0 (6 February 2015)
- 1.13.0 (26 September 2014)
- 1.12.0 (10 September 2014)
- 1.11.0 (26 August 2014)
- 1.10.0 (18 July 2014)
- 1.9.0 (13 May 2014)
- 1.8.0 (7 January 2014)
- 1.7.0 (5 December 2013)
- 1.6.0 (23 November 2013)
- 1.5.0 (21 November 2013)
- 1.4.0 (9 September 2013)
- 1.3.0 (21 August 2013)
- 1.2.0 (15 October 2012)
- 1.1.0 (17 September 2012)
- 1.0.1 (11 September 2012)
- 1.0.0 (11 September 2012)
