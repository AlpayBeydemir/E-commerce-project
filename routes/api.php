<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderDetailController;

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

Route::get('OrderDetail', [OrderDetailController::class, 'index'])->name('OrderDetail');
Route::get('OrderDetail/{id}', [OrderDetailController::class, 'show'])->name('OrderDetailShow');
Route::post('OrderDetail', [OrderDetailController::class, 'store'])->name('OrderDetailStore');
Route::put('OrderDetail/{id}', [OrderDetailController::class, 'update'])->name('OrderDetailUpdate');
Route::delete('OrderDetail/{id}', [OrderDetailController::class, 'delete'])->name('OrderDetailDelete');

