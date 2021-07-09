<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\AuthenticatedSessionController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [App\Http\Controllers\AuthenticatedSessionController::class, 'login'])
    ->middleware('guest');

Route::post('logout', [App\Http\Controllers\AuthenticatedSessionController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::group(['middleware' => 'auth'],  function () {
    Route::get('transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');

    Route::get('ajax/transactions', [\App\Http\Controllers\Ajax\TransactionController::class, 'index']);
    Route::post('ajax/transactions', [\App\Http\Controllers\Ajax\TransactionController::class, 'store']);
    Route::put('ajax/transactions/{transaction}', [\App\Http\Controllers\Ajax\TransactionController::class, 'update']);
    Route::delete('ajax/transactions/{transaction}', [\App\Http\Controllers\Ajax\TransactionController::class, 'destroy']);
});
