<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderDetailController;
use App\Http\Controllers\API\UserController;

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
Route::post('OrderDetail/Store', [OrderDetailController::class, 'store'])->name('OrderDetailStore');
Route::put('OrderDetail/{id}', [OrderDetailController::class, 'update'])->name('OrderDetailUpdate');
Route::delete('OrderDetail/{id}', [OrderDetailController::class, 'delete'])->name('OrderDetailDelete');

Route::get('Users', [UserController::class, 'index'])->name('Users');
Route::get('User/{id}', [UserController::class, 'show'])->name('UserDetail');
Route::post('User/Store', [UserController::class, 'store'])->name('UserStore');
Route::put('User/Update/{id}', [UserController::class, 'update'])->name('UserUpdate');
Route::delete('User/Delete/{id}', [UserController::class, 'destroy'])->name('UserDelete');
