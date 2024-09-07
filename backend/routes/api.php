<?php

use App\Http\Controllers\Api\LeaveController;
use App\Http\Controllers\Api\TypeLeaveController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//======================= Authentication ======================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::put('/customers/{id}/role', [AuthController::class, 'updateRole']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

// ========================= Roles =============================
Route::get('/roles/list', [RoleController::class, 'index']);
Route::post('/role/create', [RoleController::class, 'store']);
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy']);
Route::put('/role/update/{id}', [RoleController::class, 'update']);
Route::put('/roles/{roleId}/add-permissions', [RoleController::class, 'updatePermissions']);

// ========================= Permissions =============================
Route::get('/permissions/list', [PermissionController::class, 'index']);
Route::post('/permission/create', [PermissionController::class, 'store']);
Route::put('/permission/update/{id}', [PermissionController::class, 'update']);
Route::delete('/permission/delete/{id}', [PermissionController::class, 'destroy']);

// ========================= Users =============================
Route::get('/users/list', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'store']);
Route::get('/user/show/{id}', [UserController::class, 'show']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
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
Route::get('/leave/show/{userId}', [LeaveController::class, 'show']);
Route::put('/leave/update/{id}', [LeaveController::class, 'update']);
Route::delete('/leave/delete/{id}', [LeaveController::class, 'destroy']);

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

// ========================= Leave Balance =============================
Route::get('/balances/list', [LeaveBalanceController::class, 'index']);
Route::post('/balance/create', [LeaveBalanceController::class, 'store']);
Route::get('/balance/show/{id}', [LeaveBalanceController::class, 'show']);
// Route::put('/balance/update/{userId}', [LeaveBalanceController::class, 'update']);
Route::put('/balance/update/{userId}', [LeaveBalanceController::class, 'updateTokenBalance']);
Route::delete('/balance/delete/{id}', [LeaveBalanceController::class, 'destroy']);

// ========================= Leave Status  =============================
Route::post('/leave/approve/{id}', [LeaveController::class, 'approveLeave']);
Route::post('/leave/reject/{id}', [LeaveController::class, 'rejectLeave']);
Route::post('/leave/cancel-request/{id}', [LeaveController::class, 'cancelLeaveRequest']);

// ========================= Subodinate  =============================
Route::get('/subordinates/list', [SubordinateController::class, 'getSubordinates']);
Route::post('/subordinate/assign', [SubordinateController::class, 'assignSubordinate']);
Route::delete('/subordinate/remove/{id}', [SubordinateController::class, 'removeSubordinate']);
Route::put('/subordinate/update/{id}', [SubordinateController::class, 'updateSubordinate']);