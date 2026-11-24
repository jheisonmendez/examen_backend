<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReviewController;
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
Route::apiResource('cliente', ClientController::class)->except(['update']);
Route::put('cliente/{cliente}', [ClientController::class, 'update'])->name('cliente.update');

Route::apiResource('coche', CarController::class)->except(['update']);
Route::put('coche/{coche}', [CarController::class, 'update'])->name('coche.update');

Route::apiResource('revision', ReviewController::class)->except(['update']);
Route::put('revision/{revision}', [ReviewController::class, 'update'])->name('revision.update');
