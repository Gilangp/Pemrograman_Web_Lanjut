<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WelcomeController;

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

// Route::get('/hello', function () {
//     return 'Hello World';
// });
Route::get('/hello', [WelcomeController::class,'hello']);


Route::get('/world', function () {
    return 'World';
});

// Route::get('/', function () {
//     return 'Selamat Datang';
// });
// Route::get('/', [PageController::class, 'index']);
Route::get('/', HomeController::class);

// Route::get('/about', function () {
//     return 'Nama : Gilang Purnomo <br> NIM  : 2341720042';
// });

// Route::get('/user/{name}', function ($name) {
//     return 'Nama saya '.$name;
// });
// Route::get('/about', [PageController::class, 'about']);
Route::get('/about', AboutController::class);

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-' . $postId . " Komentar ke-: " . $commentId;
});

// Route::get('/articles/{id}', function ($id) {
//     return 'Halaman Artikel dengan ID ' . $id;
// });
// Route::get('/articles/{id}', [PageController::class, 'articles']);
Route::get('/articles/{id}', ArticleController::class);

Route::get('/user/{name?}', function ($name = 'John') {
    return 'Nama saya ' . $name;
});

Route::resource('photos', PhotoController::class);

// Route::get('/greeting', function () {
//     return view('hello', ['name' => 'Gilang Purnomo']);
// });
Route::get('/greeting', [WelcomeController::class, 'greeting']);
