<?php

use Carbon\Carbon;

include __DIR__ . '/vendor/autoload.php';

$date = new Carbon('2014-03-30 01:00:00', 'Europe/London');
echo $date->floatDiffInRealHours('2014-03-30 02:30:00');          // 2.5
echo "\n";
echo $date->floatDiffInHours('2014-03-30 02:30:00');              // 2.5
echo "\n";
echo $date->floatDiffInRealMinutes('2014-03-30 03:00:30');        // 120.5
echo "\n";
echo $date->floatDiffInMinutes('2014-03-30 03:00:30');            // 120.5
echo "\n";
echo $date->floatDiffInRealSeconds('2014-03-30 03:00:00.5');      // 7200.5
echo "\n";
echo $date->floatDiffInSeconds('2014-03-30 03:00:00.5');          // 7200.5
echo "\n";
// above day unit, "real" will affect the decimal part based on hours and smaller units
echo $date->floatDiffInRealDays('2014-03-31 03:30:00');           // 1.0833333333333
echo "\n";
echo $date->floatDiffInDays('2014-03-31 03:30:00');               // 1.125
echo "\n";
echo $date->floatDiffInRealMonths('2014-04-30 03:30:00') - 1;     // 0.0041666666666667
echo "\n";
echo $date->floatDiffInMonths('2014-04-30 03:30:00') - 1;         // 0.0041666666666667
echo "\n";
echo $date->floatDiffInRealYears('2015-03-30 03:30:00') - 1;      // 0.00034246575342456
echo "\n";
echo $date->floatDiffInYears('2015-03-30 03:30:00') - 1;          // 0.00034246575342456
echo "\n";