<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('beranda');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/lumbungsuite', function () {
    return view('lumbungsuite');
});

Route::get('/walekayusuite', function () {
    return view('walekayusuite');
});

Route::get('/walekayufamily', function () {
    return view('walekayufamily');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/post-artikel', function () {
    return view('post-artikel');
});

Route::get('/pesona', function () {
    return view('pesona');
});

Route::get('/tradisiharmoni', function () {
    return view('tradisiharmoni');
});

Route::get('/keajaiban', function () {
    return view('keajaiban');
});

Route::get('/post-portofolio', function () {
    return view('post-portofolio');
});

Route::get('/alam', function () {
    return view('alam');
});

Route::get('/bar', function () {
    return view('bar');
});

Route::get('/pesonatradisi', function () {
    return view('pesonatradisi');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

