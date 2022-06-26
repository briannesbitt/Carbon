<?php

use Carbon\Carbon;

Carbon::macro('foo', static function (): string {
    return 'foo';
});
