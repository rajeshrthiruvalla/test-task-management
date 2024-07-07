<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-role', [App\Http\Controllers\UserRoleController::class, 'index'])->name('user-role.index');
Route::post('/user-role/save', [App\Http\Controllers\UserRoleController::class, 'assignRoles'])->name('user-role.save');
