<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnalyzeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'checkAuth']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('auth/login', [AuthController::class, 'auth']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);
    Route::post('products/add', [ProductController::class, 'insert']);
    Route::get('products/delete/{id}', [ProductController::class, 'delete']);
    Route::get('products/all', [ProductController::class, 'all_product']);
    Route::get('products/view/{id}', [ProductController::class, 'view']);
    Route::post('products/update', [ProductController::class, 'update']);

    Route::get('transaction', [TransactionController::class, 'index']);
    Route::post('transaction/add', [TransactionController::class, 'add_transaction']);
    Route::post('transaction/upload-csv', [TransactionController::class, 'upload_csv']);
    Route::get('transaction/product/{id}', [TransactionController::class, 'get_product_in_transaction']);
    Route::get('transaction/delete/{id}', [TransactionController::class, 'delete']);
    Route::get('analyze', [AnalyzeController::class, 'index']);
    Route::get('analyze/count_support', [AnalyzeController::class, 'count_support']);
    Route::get('analyze/get_item_to_analyze', [AnalyzeController::class, 'get_item_to_analyze']);
    Route::get('transaction/include', [AnalyzeController::class, 'get_include']);
});