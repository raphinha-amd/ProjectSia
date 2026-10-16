<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasKeluarController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('auth.login.post');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

    Route::controller(KasMasukController::class)->group(function () {
        Route::get('/kas-masuk', 'index')->name('kasmasuk.index');
        Route::get('/kas-masuk/create', 'create')->name('kasmasuk.create');
        Route::post('/kas-masuk', 'store')->name('kasmasuk.store');
        Route::get('/kas-masuk/{kasMasuk}', 'edit')->name('kasmasuk.edit');
        Route::put('/kas-masuk/{kasMasuk}', 'update')->name('kasmasuk.update');
        Route::delete('/kas-masuk/{kasMasuk}', 'destroy')->name('kasmasuk.destroy');
    });

    Route::controller(KasKeluarController::class)->group(function () {
        Route::get('/kas-keluar', 'index')->name('kaskeluar.index');
        Route::get('/kas-keluar/create', 'create')->name('kaskeluar.create');
        Route::post('/kas-keluar/store', 'store')->name('kaskeluar.store');
        Route::get('/kas-keluar/{kasKeluar}', 'edit')->name('kaskeluar.edit');
        Route::put('/kas-keluar/{kasKeluar}', 'update')->name('kaskeluar.update');
        Route::delete('/kas-keluar/{kasKeluar}', 'destroy')->name('kaskeluar.destroy');
    });

    Route::controller(BukuBesarController::class)->group(function () {
        Route::get('/buku-besar', 'index')->name('bukubesar.index');
        Route::get('/buku-besar/export-excel', 'exportExcel')->name('bukubesar.export.excel');
    });
});
