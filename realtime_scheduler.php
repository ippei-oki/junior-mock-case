<?php

require __DIR__.'/src/vendor/autoload.php';

$app = require_once __DIR__.'/src/bootstrap/app.php';

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

while (true) {
    $current_time = Carbon::now()->format('H:i:s');

    if ($current_time == '11:31:59') {
        Artisan::call('attendance:work_end');
        \Log::info("Executed attendance:work_end at " . $current_time);
    }

    if ($current_time == '11:32:00') {
        Artisan::call('attendance:work_start');
        \Log::info("Executed attendance:work_start at " . $current_time);
    }

    sleep(1);
}
