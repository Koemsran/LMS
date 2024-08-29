<?php

use App\Http\Controllers\Api\TypeLeaveController;
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

// ===================== Type of Leave  =========================
Route::get('/type-leave/list', [TypeLeaveController::class, 'index']);
Route::post('/type-leave/create', [TypeLeaveController::class, 'store']);
Route::get('/type-leave/show/{id}', [TypeLeaveController::class, 'show']);
Route::put('/type-leave/update/{id}', [TypeLeaveController::class, 'update']);
Route::delete('/type-leave/delete/{id}', [TypeLeaveController::class, 'destroy']);

