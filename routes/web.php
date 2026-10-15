<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasMasukController;
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

Route::get('/login', function () {
    return view('auth.login');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
});

Route::controller(AkunController::class)->group(function () {
    Route::get('/akun', 'index')->name('akun.index');
    Route::post('/akun', 'store')->name('akun.store');
    Route::put('/akun/{id}', 'update')->name('akun.update');
    Route::delete('/akun/{id}', 'destroy')->name('akun.destroy');
});

Route::controller(KasMasukController::class)->group(function () {
    Route::get('/kas-masuk', 'index')->name('kasmasuk.index');
    Route::post('/kas-masuk', 'store')->name('kasmasuk.store');
    Route::put('/kas-masuk/{kasMasuk}', 'update')->name('kasmasuk.update');
    Route::delete('/kas-masuk/{kasMasuk}', 'destroy')->name('kasmasuk.destroy');
});

Route::get('/kas-keluar', function () {
    return view('kasKeluar.index');
})->name('kaskeluar.index');

Route::get('/buku-besar', function () {
    return view('bukuBesar.index');
});
