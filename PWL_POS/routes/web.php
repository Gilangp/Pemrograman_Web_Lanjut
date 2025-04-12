<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KetegoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::pattern('id', '[0-9]+');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::get('/edit', [ProfileController::class, 'edit']);
        Route::put('/', [ProfileController::class, 'update']);
    });

    // Hak akses untuk role ADM
    Route::middleware(['authorize:ADM'])->group(function(){
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);
            Route::post('/list', [LevelController::class, 'list']);
            Route::get('/create', [LevelController::class, 'create']);
            Route::post('/', [LevelController::class, 'store']);
            Route::get('/{id}', [LevelController::class, 'show']);
            Route::get('/{id}/edit', [LevelController::class, 'edit']);
            Route::put('/{id}', [LevelController::class, 'update']);
            Route::get('/{id}/delete', [LevelController::class, 'confirm']);
            Route::delete('/{id}', [LevelController:: class, 'delete']);
        });
    });

    // Hak akses hanya admin dan manager
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/list', [UserController::class, 'list']);
            Route::get('/create', [UserController::class, 'create']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::get('/{id}/edit', [UserController::class, 'edit']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::get('/{id}/delete', [UserController::class, 'confirm']);
            Route::delete('/{id}', [UserController:: class, 'delete']);
        });

        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']);
            Route::post('/list', [BarangController::class, 'list']);
            Route::get('/create', [BarangController::class, 'create']);
            Route::post('/', [BarangController::class, 'store']);
            Route::get('/{id}', [BarangController::class, 'show']);
            Route::get('/{id}/edit', [BarangController::class, 'edit']);
            Route::put('/{id}', [BarangController::class, 'update']);
            Route::get('/{id}/delete', [BarangController::class, 'confirm']);
            Route::delete('/{id}', [BarangController:: class, 'delete']);
            Route::get('/import', [BarangController::class, 'import']);
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
            Route::get('/export_excel', [BarangController::class, 'export_excel']);
            Route::get('/export_pdf', [BarangController::class, 'export_pdf']);
        });
    });

    // Hak akses hanya admin, manager, dan staff
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/', [StokController::class, 'index']);
            Route::post('/list', [StokController::class, 'list']);
            Route::get('/create', [StokController::class, 'create']);
            Route::post('/', [StokController::class, 'store']);
            Route::get('/{id}', [StokController::class, 'show']);
            Route::get('/{id}/edit', [StokController::class, 'edit']);
            Route::put('/{id}', [StokController::class, 'update']);
            Route::get('/{id}/delete', [StokController::class, 'confirm']);
            Route::delete('/{id}', [StokController:: class, 'delete']);
        });
    });

    // Hak akses hanya admin, manager, staff, dan customer
    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
        Route::group(['prefix' => 'penjualan'], function () {
            Route::get('/', [PenjualanController::class, 'index']);
            Route::post('/list', [PenjualanController::class, 'list']);
            Route::get('/create', [PenjualanController::class, 'create']);
            Route::post('/', [PenjualanController::class, 'store']);
            Route::get('/{id}', [PenjualanController::class, 'show']);
            Route::get('/{id}/edit', [PenjualanController::class, 'edit']);
            Route::put('/{id}', [PenjualanController::class, 'update']);
            Route::get('/{id}/delete', [PenjualanController::class, 'confirm']);
            Route::delete('/{id}', [PenjualanController:: class, 'delete']);
        });
    });

    // Hak akses hanya admin, manager, staff, dan supplier
    Route::middleware(['authorize:ADM,MNG,STF,SUP'])->group(function(){
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index']);
            Route::post('/list', [SupplierController::class, 'list']);
            Route::get('/create', [SupplierController::class, 'create']);
            Route::post('/', [SupplierController::class, 'store']);
            Route::get('/{id}', [SupplierController::class, 'show']);
            Route::get('/{id}/edit', [SupplierController::class, 'edit']);
            Route::put('/{id}', [SupplierController::class, 'update']);
            Route::get('/{id}/delete', [SupplierController::class, 'confirm']);
            Route::delete('/{id}', [SupplierController:: class, 'delete']);
        });
    });

    // Hak akses untuk semua level
    Route::middleware(['authorize:ADM,MNG,STF,CUS,SUP'])->group(function(){
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KetegoriController::class, 'index']);
            Route::post('/list', [KetegoriController::class, 'list']);
            Route::get('/create', [KetegoriController::class, 'create']);
            Route::post('/', [KetegoriController::class, 'store']);
            Route::get('/{id}', [KetegoriController::class, 'show']);
            Route::get('/{id}/edit', [KetegoriController::class, 'edit']);
            Route::put('/{id}', [KetegoriController::class, 'update']);
            Route::get('/{id}/delete', [KetegoriController::class, 'confirm']);
            Route::delete('/{id}', [KetegoriController:: class, 'delete']);
        });
    });
});
