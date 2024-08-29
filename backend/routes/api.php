<?php

use App\Http\Controllers\Api\TypeLeaveController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ========================= Users =============================
Route::get('/users/list', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'store']);
Route::get('/user/show/{id}', [UserController::class, 'show']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

// ===================== Type of Leave  =========================
Route::get('/type-leave/list', [TypeLeaveController::class, 'index']);
Route::post('/type-leave/create', [TypeLeaveController::class, 'store']);
Route::get('/type-leave/show/{id}', [TypeLeaveController::class, 'show']);
Route::put('/type-leave/update/{id}', [TypeLeaveController::class, 'update']);
Route::delete('/type-leave/delete/{id}', [TypeLeaveController::class, 'destroy']);

// ===================== Leave Request  =========================

Route::get('/leaves/list', [LeaveController::class, 'index']);
Route::post('/leave/request', [LeaveController::class, 'store']);
Route::get('/leave/show/{id}', [LeaveController::class, 'show']);
Route::put('/leave/update/{id}', [LeaveController::class, 'update']);
Route::delete('/leave/delete/{id}', [LeaveController::class, 'destroy']);