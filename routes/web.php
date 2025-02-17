<?php

use Illuminate\Support\Facades\Route; // Mengimpor kelas Route dari Laravel untuk mendefinisikan rute
use App\Http\Controllers\ItemController; // Mengimpor ItemController agar bisa digunakan dalam rute

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

Route::get('/', function () { // Membuat rute GET yang menampilkan halaman utama(welcome.blade.php)
    return view('welcome');
});

Route::resource('items', ItemController::class); // Mendefinisikan rute resource untuk items, yang otomatis untuk membuat rute CRUD
// Rute:
// GET          /items ->            Menampilkan daftar item (index).
// GET          /items/create ->     Menampilkan form tambah item (create).
// POST         /items ->            Menyimpan item baru ke database (store).
// GET          /items/{id} ->       Menampilkan detail item tertentu (show).
// GET          /items/{id}/edit ->  Menampilkan form edit item (edit).
// PUT/PATCH    /items/{id} ->       Memperbarui item tertentu (update).
// DELETE       /items/{id} ->       Menghapus item tertentu (destroy).
