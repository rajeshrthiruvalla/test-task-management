<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\LogMiddleWare;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserRoleController;

Route::post('/login',[AuthController::class,'login'])->middleware(LogMiddleWare::class);
Route::post('/register',[AuthController::class,'register']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->middleware(LogMiddleWare::class);
    Route::apiResources([
        'users' => UserController::class,
        'tasks' => TaskController::class,
    ]);
    Route::post('/assign-role', [UserRoleController::class, 'assignRoles']);
    Route::post('/task-status', [TaskController::class, 'updateStatus']);
});
