<?php

use App\Http\Controllers\ControllerEmployess;
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
Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/employees',[ControllerEmployess::class, 'index']);
Route::post('/employees',[ControllerEmployess::class, 'store']);
Route::post('/employees',[ControllerEmployess::class, 'store']);
Route::put('/employees/{id}',[ControllerEmployess::class, 'update']);
Route::get('/employees/{id}',[ControllerEmployess::class, 'show']);
Route::delete('/employees/{id}',[ControllerEmployess::class, 'destroy']);
Route::get('/employees/search/{name}',[ControllerEmployess::class, 'search']);
Route::get('/employees/status/active',[ControllerEmployess::class, 'active']);
Route::get('/employees/status/inactive',[ControllerEmployess::class, 'inactive']);
Route::get('/employees/status/terminated',[ControllerEmployess::class, 'terminated']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
