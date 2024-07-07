<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\LogMiddleWare;


Route::post('/login',[AuthController::class,'login'])->middleware(LogMiddleWare::class);
Route::post('/register',[AuthController::class,'register']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->middleware(LogMiddleWare::class);
});
