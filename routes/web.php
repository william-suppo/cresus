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

Route::get('/', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'loginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'login'])
    ->middleware('guest');

Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::group(['middleware' => 'auth'],  function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('transactions', [\App\Http\Controllers\Bank\TransactionController::class, 'index'])->name('transactions.index');

    Route::get('transactions/getAllPaginate', [\App\Http\Controllers\Bank\TransactionController::class, 'getAllPaginate'])->name('transactions.getAllPaginate');
    Route::post('transactions', [\App\Http\Controllers\Bank\TransactionController::class, 'store'])->name('transactions.store');
    Route::put('transactions/{transaction}', [\App\Http\Controllers\Bank\TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('transactions/{transaction}', [\App\Http\Controllers\Bank\TransactionController::class, 'destroy'])->name('transactions.destroy');
});
