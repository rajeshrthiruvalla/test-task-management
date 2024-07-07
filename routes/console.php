<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->everySecond();

Schedule::call(function () {
    DB::table('users')->where('status',false)->delete();
})->dailyAt('22:10');
