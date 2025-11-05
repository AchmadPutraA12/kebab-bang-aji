<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('stock:recommendations', function () {
    Artisan::call('stock:recommendation');
})->purpose('Recommendations for stock')->everyMinute();

// Artisan::command('stock:recommendations', function () {
//     Artisan::call('stock:recommendations');
// })->purpose('Recommendations for stock')->monthlyOn(1, '02:00');
