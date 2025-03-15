<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KetegoriController;

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

Route::get('/', function () {
    return view('welcome');
});

// Level
Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/tambah', [LevelController::class, 'tambah']);
Route::post('/level/tambah_simpan', [LevelController::class, 'tambah_simpan']);
Route::get('/level/ubah/{id}', [LevelController::class, 'ubah']);
Route::put('/level/ubah_simpan/{id}', [LevelController::class, 'ubah_simpan']);
Route::get('/level/hapus/{id}', [LevelController::class, 'hapus']);

// Kategori
Route::get('/kategori', [KetegoriController::class, 'index']);
Route::get('/kategori/tambah', [KetegoriController::class, 'tambah']);
Route::post('/kategori/tambah_simpan', [KetegoriController::class, 'tambah_simpan']);
Route::get('/kategori/ubah/{id}', [KetegoriController::class, 'ubah']);
Route::put('/kategori/ubah_simpan/{id}', [KetegoriController::class, 'ubah_simpan']);
Route::get('/kategori/hapus/{id}', [KetegoriController::class, 'hapus']);

// User
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/tambah', [BarangController::class, 'tambah']);
Route::post('/barang/tambah_simpan', [BarangController::class, 'tambah_simpan']);
Route::get('/barang/ubah/{id}', [BarangController::class, 'ubah']);
Route::put('/barang/ubah_simpan/{id}', [BarangController::class, 'ubah_simpan']);
Route::get('/barang/hapus/{id}', [BarangController::class, 'hapus']);


// Stok
Route::get('/stok', [StokController::class, 'index']);
Route::get('/stok/tambah', [StokController::class, 'tambah']);
Route::post('/stok/tambah_simpan', [StokController::class, 'tambah_simpan']);
Route::get('/stok/ubah/{id}', [StokController::class, 'ubah']);
Route::put('/stok/ubah_simpan/{id}', [StokController::class, 'ubah_simpan']);
Route::get('/stok/hapus/{id}', [StokController::class, 'hapus']);
