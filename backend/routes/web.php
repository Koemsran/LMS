<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;

Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::get('permissions/{id}/delete', [PermissionController::class,'destroy']);
Route::get('roles/{id}/delete', [RoleController::class,'destroy']);
Route::get('roles/{id}/give-permissions', [RoleController::class, 'addPermission']);
Route::put('roles/{id}/give-permissions', [RoleController::class, 'updatePermission']);

Route::get('/', function () {
    return view('menus.dashboard');
});

Route::get('/dashboard', function () {
    return view('menus.dashboard');
});



Route::post('/login', [LoginController::class, 'login']);
