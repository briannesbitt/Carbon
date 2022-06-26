<?php

use Carbon\Carbon;

Carbon::macro('foo', function (): string {
    return 'foo';
});
