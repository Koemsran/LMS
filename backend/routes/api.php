<?php

use App\Http\Controllers\Api\LeaveController as ApiLeaveController;
use App\Http\Controllers\Api\TypeLeaveController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SubordinateController;
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
Route::get('/leaves/list', [ApiLeaveController::class, 'index']);
Route::post('/leave/request', [ApiLeaveController::class, 'store']);
Route::get('/leave/show/{id}', [ApiLeaveController::class, 'show']);
Route::put('/leave/update/{id}', [ApiLeaveController::class, 'update']);
Route::delete('/leave/delete/{id}', [ApiLeaveController::class, 'destroy']);

// ===================== Departement  =========================
Route::get('/departements/list', [DepartementController::class, 'index']);
Route::post('/departement/create', [DepartementController::class, 'store']);
Route::get('/departement/show/{id}', [DepartementController::class, 'show']);
Route::put('/departement/update/{id}', [DepartementController::class, 'update']);
Route::delete('/departement/delete/{id}', [DepartementController::class, 'destroy']);

// ========================= Leave History =============================
Route::get('/histories/list', [HistoryController::class, 'index']);
Route::post('/history/create', [HistoryController::class, 'store']);
Route::delete('/history/delete/{id}', [HistoryController::class, 'destroy']);

// ========================= Leave Status  =============================
Route::post('/leave/approve/{id}', [ApiLeaveController::class, 'approveLeave']);
Route::post('/leave/reject/{id}', [ApiLeaveController::class, 'rejectLeave']);
Route::post('/leave/cancel-request/{id}', [ApiLeaveController::class, 'cancelLeaveRequest']);


// ========================= Subodinate  =============================
Route::get('/subordinates/list', [SubordinateController::class, 'getSubordinates']);
Route::post('/subordinate/assign', [SubordinateController::class, 'assignSubordinate']);
Route::delete('/subordinate/remove', [SubordinateController::class, 'removeSubordinate']);