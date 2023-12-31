<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OrderDetailController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductInventoryController;
use App\Http\Controllers\API\ShoppingCartController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

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
Route::post('User/Login', [UserController::class, 'loginUser'])->name('UserLogin');

Route::get('Categories', [CategoryController::class, 'index'])->name('Categories');
Route::get('Category/{id}', [CategoryController::class, 'show'])->name('CategoryShow');
Route::post('Category/Store', [CategoryController::class, 'store'])->name('CategoryStore');
Route::put('Category/Update/{id}', [CategoryController::class, 'update'])->name('CategoryUpdate');
Route::delete('Category/Delete/{id}', [CategoryController::class, 'destroy'])->name('CategoryDelete');

Route::get('Products', [ProductController::class, 'index'])->name('Products');
Route::post('Product/Store', [ProductController::class, 'store'])->name('ProductStore');
Route::get('Product/{id}', [ProductController::class, 'show'])->name('ProductDetail');
Route::put('Product/Update/{id}', [ProductController::class, 'update'])->name('ProductUpdate');
Route::delete('Product/Delete/{id}', [ProductController::class, 'destroy'])->name('ProductDelete');
Route::get('Product/Category/{id}', [ProductController::class, 'categoryProduct'])->name('ProductCategory');

Route::get('ProductInventory/{id}', [ProductInventoryController::class, 'index'])->name('ProductInventory');
Route::post('ProductInventory/Store', [ProductInventoryController::class, 'store'])->name('ProductInventoryStore');
Route::put('ProductInventory/Update/{id}', [ProductInventoryController::class, 'update'])->name('ProductInventoryUpdate');
Route::delete('ProductInventory/Delete/{id}', [ProductInventoryController::class, 'destroy'])->name('ProductInventoryDelete');

Route::get('ShoppingCarts', [ShoppingCartController::class, 'index'])->name('ShoppingCarts');
Route::post('ShoppingCart/Store', [ShoppingCartController::class, 'store'])->name('ShoppingCartStore');
Route::get('ShoppingCart/{id}', [ShoppingCartController::class, 'show'])->name('ShoppingCartShow');
Route::put('ShoppingCart/Update/{id}', [ShoppingCartController::class, 'update'])->name('ShoppingCartShow');
